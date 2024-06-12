<!DOCTYPE html>
<html lang="en">

<?php

include("../connection/connection.php");
include("../includes/error-handler.php");

function sanitizeInput($input)
{
  $clean_input = trim($input);
  $clean_input = stripslashes($clean_input);
  $clean_input = htmlspecialchars($clean_input);
  return $clean_input;
}

if (!isset($_SESSION["user_id"]) || $_SESSION['flag'] == 1) {
  echo "You cannot access this page.";
  exit();
} else {
  $response = array();

  if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $password = sanitizeInput($_POST['new-password']);
    $confirmPassword = sanitizeInput($_POST['confirm-password']);

    if ($password !== $confirmPassword) {
      $response['success'] = false;
      $response['message'] = "Passwords do not match";
    } else if (strlen($password) < 8) {
      $response['success'] = false;
      $response['message'] = "Password must be at least 8 characters long";
    } else if (!preg_match('/^(?=.*[A-Z])(?=.*[!@#$%^&*])(?=.*[0-9]).{8,}$/', $password)) {
      $response['success'] = false;
      $response['message'] = "Password must contain at least one uppercase, lower case, and number";
    } else {
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
      echo $hashedPassword;
      $stmt = $conn->prepare("UPDATE 
      `user_details_data`
       SET
      `Password` = ?,
      `reset_password_flag` = 1 
      WHERE 
      User_ID = ?");
      $stmt->bind_param("ss", $hashedPassword, $_SESSION['user_id']);
      if ($stmt->execute()) {
        $response['success'] = true;
        $response['message'] = "Password updated successfully!";
        header("Location: ../logout.php");
      } else {
        $response['success'] = false;
        $response['message'] = "Error updating password: " . $stmt->error;
      }
      $stmt->close();
    }
    $conn->close();
  }
}
?>

<head>
  <meta charset="UTF-8">
  <?php include_once '../bundler/bootstrap_framework.php'; ?>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>RESET PASSWORD PAGE</title>
  <link rel="stylesheet" href="../assets/css/style.css">
  <link rel="stylesheet" href="reset_password.css">
</head>

<body>
  <section class="container d-flex justify-content-center align-items-center h-100 flex-column">
    <div class="displayMessage">
      <?php
      if (isset($response['success']) && $response['success'] === true) {
        display_success($response['message']);
      } else if (isset($response['success']) && $response['success'] === false) {
        display_error($response['message']);
      }
      ?>
    </div>
    <div class="inner col-xl-5 col-lg-6 col-md-8 col-sm-12 p-4 ">
      <div class="icon position-relative mx-auto mb-5 text-center">
        <svg width="50px" height="50px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path
            d="M14 6V5C14 3.89543 13.1046 3 12 3C10.8954 3 10 3.89543 10 5V6M9 11H15C15.5523 11 16 10.5523 16 10V7C16 6.44772 15.5523 6 15 6H9C8.44772 6 8 6.44772 8 7V10C8 10.5523 8.44772 11 9 11ZM5 21H19C20.1046 21 21 20.1046 21 19V16C21 14.8954 20.1046 14 19 14H5C3.89543 14 3 14.8954 3 16V19C3 20.1046 3.89543 21 5 21Z"
            stroke="#7b39ed" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
          <circle cx="7.5" cy="17.5" r="1.5" fill="#37078a" />
          <circle cx="12" cy="17.5" r="1.5" fill="#37078a" />
          <circle cx="16.5" cy="17.5" r="1.5" fill="#37078a" />
        </svg>
      </div>
      <h2 class="fw-bold text-center">Change Your Password</h2>
      <p class="text-muted text-center">Enter a new password to change your password.</p>
      <form action="" id="reset-password-form" method="POST">
        <div class="form-group mb-4">
          <label for="password">Password</label>
          <input type="password" name="new-password" class="shadow-sm form-control border border-2 rounded-md py-2"
            id="password" name="password">
          <p class="text-danger fs-6">
          </p>
        </div>
        <div class="form-group mb-4">
          <label for="confirm-password">Confirm Password</label>
          <input type="password" name="confirm-password" class=" shadow-sm form-control border border-2 rounded-md py-2"
            id="confirm-password" name="confirm-password">
        </div>
        <button type="submit" name="submit" class="w-100 btn btn-color py-2">Reset Password</button>
      </form>
    </div>
  </section>
</body>
<script defer>
  $(document).ready(function () {

    $("#reset-password-form").submit(function (e) {
      try {
        var password = $("#password").val();
        var confirmPassword = $("#confirm-password").val();
        var hasErrors = false;

        if (password !== confirmPassword) {
          $(".text-danger").text("Passwords do not match");
          hasErrors = true;
        }

        else if (password.length < 8) {
          $(".text-danger").text("Password must be at least 8 characters long");
          hasErrors = true;
        }
        else if (!/^(?=.*[A-Z])(?=.*[!@#$%^&*])(?=.*[0-9]).{8,}$/.test(password)) {
          $(".text-danger").text("Password must contain at least one uppercase, lower case and number");
          hasErrors = true;
        }
        else {
          $(".text-danger").text("");
        }
        if (hasErrors) {
          e.preventDefault(); // Prevent form submission only if there are errors
        }
      }
      catch (error) {
        console.log(error);
      }
    })
  });

</script>

</html>