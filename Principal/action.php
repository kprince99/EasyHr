<?php include '../bootstrap_framework.php' ;
      include '../connection.php' ;
      include '../core.php';
      
	 if(isset($_POST['Approve']))
       {
          $id=$_POST['Approv'];
          $approves = "UPDATE `empl_leave` SET `Status` = '1' WHERE `empl_leave`.`S.no` = '".$id."'";
          $conn->query($approves) or die(mysqli_error($conn));
          header('Location: ./pri_panel.php');
        }

         if(isset($_POST['Reject']))
           {
          $id=$_POST['Reject'];
          $approves = "UPDATE `empl_leave` SET `Status` = '2' WHERE `empl_leave`.`S.no` = '".$id."'";
          $conn->query($approves) or die(mysqli_error($conn));
          header('Location: ./pri_panel.php');
        }
?>