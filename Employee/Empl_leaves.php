<?php include "../connection/core.php"; ?>
<?php include "../connection/connection.php"; ?>
 
<html>
 <body>
  <head>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  </head>
  <div class="container">
    <div class="table-responsive sm">
     <table class="table table-bordered table-striped">
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
                  $sql="SELECT * from empl_leave Where empl_id LIKE '". $_SESSION['id']."' ";
                  $rs=$conn->query($sql) or die($conn->error); 
                  while($result=$rs->fetch_assoc()): 
                  ?>
            <tbody>
              <tr>
                <th scope="row"><?php echo $result['S.no'] ?> </th>
                  <td><?php echo $result['empl_id'] ?> </td>
                  <td><?php echo $result['Username'] ?></td>
                  <td>@<?php echo $result['Date_from'] ?></td>
                  <td><?php echo $result['Date_To'] ?></td>
                  <td><?php echo $result['Leave_Type'] ?></td>
                  <td><textarea cols = "40" rows = "4" readonly style="resize:none; overflow:hidden; border:none;"><?php echo $result['Reason'] ?></textarea></td>
                  <td>
                <?php if($result['Status'] == 0)
                    echo "<button type='button' class='btn btn-secondary btn-sm' disabled>Waiting for Approval</button>";
                    else if($result['Status'] == 1)
                      echo "<button type='button' class='btn btn-success btn-sm' disabled>Approved</button>";
                    else if($result['Status'] == 2)
                    echo "<button type='button' class='btn btn-danger btn-sm' disabled>Rejected</button>";
                ?> 
                </td>
              </tr>
          </tbody>
        <?php endwhile ?>
  </table>
</div>
</div>
</body>
</html>