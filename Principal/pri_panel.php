<?php include '../bootstrap_framework.php' ;
      include '../connection.php' ;
      include '../core.php';

   $query = "SELECT Count(*) AS total from empl_leave where Status = 0";
   $results=$conn->query($query);

    if($myrow = $results->fetch_assoc()) 
        $no_of_active_leaves = $myrow['total'];

   $query1 = "SELECT Count(*) AS Rej from empl_leave where Status = 2";
    $results=$conn->query($query1);

    if($myrow = $results->fetch_assoc()) 
        $no_of_rejected_leaves = $myrow['Rej'];
        
   $query2 = "SELECT Count(*) AS Approved from empl_leave where Status = 1";
    $results=$conn->query($query2);

     if($myrow = $results->fetch_assoc()) 
        $no_of_approved_leaves = $myrow['Approved'];

       $sql="SELECT * from empl_leave where Status = 0";             
       $rs=$conn->query($sql) or die($conn->error); 

       ?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
      
    <link rel="stylesheet" href="pri_panel.css">
    <!-- Boxicons CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
 
 <?php include "sidebar_pri.php"; ?>

<div class="container-fluid mt-3">
  <div class="card-group ">
  <div class="card m-2">
    <div class="card-body">
      <h5 class="card-title">Number of Active Leaves</h5>
     
      <p class="h3"><small class="text-muted "><span class="single"><?php echo $no_of_active_leaves ?></span></small></p>
    </div>
  </div>
  <div class="card m-2">
    <div class="card-body">
      <h5 class="card-title">No of Approved Leaves</h5>
     
      <p class="h3"><small class="text-muted"><span class="second"><?php echo  $no_of_approved_leaves ?></span></small></p>
    </div>
  </div>
  <div class="card m-2">
    <div class="card-body">
      <h5 class="card-title">No of Rejected Leaves</h5>
     
      <p class="h3"><small class="text-muted"><span class="third"><?php echo $no_of_rejected_leaves ?></span></small></p>
    </div>
  </div>
</div>
</div>

  
<div class="container-fluid">
    <h5 style="margin-top:20px; margin-bottom:20px">Current Active Leave</h5>
  <div class="table-responsive">
  <table class="table table-bordered ">
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
      <th scope="col">Action</th>
      
    </tr>
  </thead>
    <?php
        while($result=$rs->fetch_assoc()): 
     ?>
  <tbody>
    <tr>
    <td><?php echo $result['S.no'] ?> </th>
      <td><?php echo $result['empl_id'] ?> </td>
      <td><?php echo $result['Username'] ?></td>
      <td><?php echo $result['Date_from'] ?></td>
      <td><?php echo $result['Date_To'] ?></td>
      <td><?php echo $result['Leave_Type'] ?></td>
      <td><textarea cols= "30" rows="3" readonly style="resize:none; overflow:hidden; border:none;"><?php echo $result['Reason'] ?></textarea></td>
      <td><?php if($result['Status'] == 0)
             echo "<button type='button' class='btn btn-secondary btn-sm' disabled>Waiting </button>";
            else if($result['Status'] == 1)
               echo "<button type='button' class='btn btn-success btn-sm' disabled>Approved</button>";
            else if($result['Status'] == 2)
             echo "<button type='button' class='btn btn-danger btn-sm' disabled>Rejected</button>";
        ?> 
      </td>
      <td>
            <div class="d-flex flex-row gap-1 ">
              <form method="POST" action="./action.php">
              <button type="submit" class="btn btn-primary btn-lg p-2" name="Approve"><i class='bx bxs-badge-check'></i>
                <input type="hidden" name="Approv" value="<?php echo $result['S.no']?>">
              </button>
            </form>
            
              <form method="POST" action="./action.php">
              <button type="submit" class="btn btn-danger btn-lg p-2" name="Reject"><i class="far fa-trash-alt"></i>
               <input type="hidden" name="Reject" value="<?php echo $result['S.no']?>"></button>
            </form>
            </div>
      </td>
    </tr>
   
  </tbody>
<?php endwhile ?>
  </table>
 </div>
</div>
    </div>
  </div>
</body>
<script src="./counter.js"></script>
    <script src="./main.js"></script>
</html>
