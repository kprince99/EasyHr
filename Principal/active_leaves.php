<?php include '../bootstrap_framework.php' ;
      include '../connection.php' ;
      include '../core.php';

      $query = "SELECT Count(*) AS total from empl_leave where Status = 0";
   $results=$conn->query($query);

    if($myrow = $results->fetch_assoc()) 
        $no_of_active_leaves = $myrow['total'];

       $sql="SELECT * from empl_leave where Status = 0";             
       $rs=$conn->query($sql) or die($conn->error); 

      ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" type="text/css" href="pri_panel.css">
     <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

   </head>
<body>

  <?php include 'sidebar_pri.php'; ?>

<div class="container-fluid">
  <div class="table-responsive">
  <table class="table table-bordered table-striped">
    <h5 style="margin-top:20px; margin-bottom:20px">Current Active Leave</h5>
    <caption>List Of Leaves</caption>
  <thead class = "table-dark">
    <tr>
      <th scope="col">S.no</th>
      <th scope="col">Employee ID</th>
      <th scope="col">Name</th>
      <th scope="col">Leave From</th>
      <th scope="col">Leave To</th>
      <th scope="col">Leave Type</th>
      <th scope="col">Reason</th>
      <th scope="col">Status</th>
      
    </tr>
  </thead>
    <?php
        while($result=$rs->fetch_assoc()): 
     ?>
  <tbody>
    <tr>
    <th scope="row"><?php echo $result['S.no'] ?> </th>
      <td><?php echo $result['empl_id'] ?> </td>
      <td><?php echo $result['Name'] ?></td>
      <td><?php echo $result['Date_from'] ?></td>
      <td><?php echo $result['Date_To'] ?></td>
      <td><?php echo $result['Leave_Type'] ?></td>
      <td><?php echo $result['Reason'] ?></td>
      <td><?php echo $result['Status'] ?></td>
    </tr>
   
  </tbody>
<?php endwhile ?>
  </table>
 </div>
</div>
 </body>
 <script src="./counter.js"></script>
    <script src="./main.js"></script>
  </html>