<?php

include '../connection/connection.php';

if (!isset($_SESSION['user_data'])) {
  echo json_encode(array('status' => 'error', 'message' => 'Unauthorized access'));
  exit;
}

function dataSuccess($message) {
  echo json_encode(array('status' => 'success', 'message' => $message));
  exit;
}

function dataFailure($message) {
  echo json_encode(array('status' => 'error', 'message' => $message));
  exit;
}
if(isset($_GET['editId'])){
  global $conn;
  if (isset($_GET['editId'])) {
      $id = $_GET['editId'];
      $stmt = $conn->prepare("SELECT * FROM user_account WHERE EmployeeID = ?");
      $stmt->bind_param("s", $id);
      $stmt->execute();
      $result = $stmt->get_result();
      
      if ($result->num_rows > 0) {
          $data = $result->fetch_assoc();
          echo json_encode($data);
      }
  }
}

if(isset($_GET['deleteId'])) {
  global $conn;
  if (isset($_GET['deleteId'])) {
      $id = $_GET['deleteId'];
      $stmt = $conn->prepare("DELETE FROM user_account WHERE EmployeeID = ?");
      $stmt->bind_param("s", $id);
      
      if (!$stmt->execute()) {
        dataFailure('Failed to delete Record');
      } 
      else if ($stmt->affected_rows === 0) {
        dataFailure('Record not found in the database');
      }
      else
         dataSuccess('Record deleted successfully');
      $stmt->close();
  }
}

if (isset($_POST['update-profile'])) {
  global $conn;

  $emp_id = $_SESSION['user_data']['EmployeeID'];
  $previousName = $_SESSION['user_data']['Full Name'];
  $previousMail = $_SESSION['user_data']['Email'];
  $previousPhone = $_SESSION['user_data']['Mobile_no'];

  $name = filter_var(htmlspecialchars($_POST['name']));
  $email = filter_var(htmlspecialchars($_POST['email']));
  $phone = filter_var(htmlspecialchars($_POST['phone']));

  if ($previousName !== $name || $previousMail !== $email || $previousPhone !== $phone) {
    $query = $conn->prepare("UPDATE user_account SET `Full Name` = ?, Email = ?, Mobile_no = ? WHERE EmployeeID = ?");
    $query->bind_param('ssss', $name, $email, $phone, $emp_id);

    if (!$query->execute()) {
      dataFailure('Failed to delete Record');
    } 

    else if ($query->affected_rows === 0) {
      dataFailure('Failed to update Record');
    }
    else {
      $_SESSION['user_data'] = array('EmployeeID'=> $emp_id, 'Full Name' => $name, 'Email' => $email, 'Mobile_no' => $phone);
      dataSuccess('Profile updated successfully');
    }

    $query->close();
    // Closing the prepared statement
   } else {
    dataFailure('No changes from user end.');
  }
} 

if(isset($_POST['updateUser'])) {
    global $conn;
    parse_str($_POST['updateUser'], $updateData);
    print_r($updateData);
}
