<?php
// Include connection details securely (avoid relative paths)
require '../connection/connection.php';

// Sanitize user inputs using prepared statements
$user = mysqli_real_escape_string($conn, $_POST["Username"]);
$pass = mysqli_real_escape_string($conn, $_POST["Password"]);

// Prepare the statement with parameter binding to prevent SQL injection
$stmt = $conn->prepare("SELECT * FROM `user_details_data` WHERE Username=?");
$stmt->bind_param("s", $user);
$stmt->execute();
$result = $stmt->get_result();

// Check for successful query execution
  if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $first_login = $row['reset_password_flag'];

    if ($first_login == 1) {
      // Use password_hash for secure password comparison
      if (password_verify($pass, $row['Password'])) {
        // Set session variables
        $_SESSION['user_id'] = $row['User_ID'];
        $_SESSION['password_token'] = $first_login; 

        // Prepare another statement for data retrieval (avoid nested prepared statements)
        $stmt = $conn->prepare("SELECT * FROM `user_account` WHERE EmployeeID=?");
        $stmt->bind_param("s", $row['EmployeeID']);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
          $user_data = $result->fetch_assoc();
          $_SESSION['user_data'] = $user_data;
        } else {
          $_SESSION['error-message'] = "No user found for EmployeeID: " . $row['EmployeeID'];
        }

          switch ($row['Role']) {
            case 0:
              header("Location: ../admin/zp.php#dashboard");
              break;
            case 15:
              header("Location: ../Employee/Empl_panel.php");
              break;
            case 2:
              header("Location: ../Principal/pri_panel.php");
              break;
          }
        } 
        else {
          $_SESSION['error-message'] = "Incorrect Password! Passowrd Didn't Match";
          header('Location: ../login.php');
          exit();
        }
      } else {
          header('Location: ../modules/reset_password_form.php');
          exit();
      }
    } 
   else {
    $_SESSION['error-message'] = "Username not Found";
    header("Location: ../login.php");
    exit();
  } 

// Close resources (ensure proper closing even in case of errors)
$stmt->close();
$result->close();
$conn->close();

?>
