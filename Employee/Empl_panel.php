<?php
include '../bundler/bootstrap_framework.php';
include './Empl_navbar.php';
?>

<?php

if (isset($_POST['Leave_submit'])) {

  $from = mysqli_real_escape_string($conn, $_POST['exampleInputdate']);
  $to = mysqli_real_escape_string($conn, $_POST['exampleInput_to_date']);
  $type = mysqli_real_escape_string($conn, $_POST['leave_type']);
  $reason = mysqli_real_escape_string($conn, $_POST['exampleInputremark']);
  $file = mysqli_real_escape_string($conn, $_POST['exampleInputfile']);


  $sql = " INSERT INTO empl_leave(empl_id , Username, Date_from, Date_to, Leave_Type, Reason) VALUES ('" . $_SESSION['id'] . "', '" . $_SESSION['uname'] . "', '" . $from . "', '" . $to . "', '" . $type . "', '" . $reason . "')";

  $conn->query($sql) or die("Error is" . mysqli_error($conn));
}



if (isset($_POST['Submit'])) {
  $user = mysqli_real_escape_string($conn, $_POST['Name']);
  $Profile = mysqli_real_escape_string($conn, $_POST['profile']);
  $Email = mysqli_real_escape_string($conn, $_POST['Email']);
  $num = mysqli_real_escape_string($conn, $_POST['Num']);

  $sql = " UPDATE empl_sec SET Name = '" . $user . "', Email_id = '" . $Email . "', Num = '" . $num . "' WHERE Username = '" . $_SESSION['uname'] . "' ";

  $conn->query($sql) or die("Error is" . mysqli_error($conn));

  echo "<div class='alert alert-success col-md-4 offset-md-4 ' role='alert' style = ' position:absolute; z-index:99; opacity:1; top:0; ><h5>Your Accounts Updated Successfully</h5> </div> ";

  echo "<script>window.setTimeout(function() {
        $('.alert').fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
      });
    }, 2000);</script>";
}
?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <title>Lect Panel</title>

</head>

<body>

  <div class="container">
    <div class="main-body ">
      <!-- /Breadcrumb -->
      <div class="col-lx-8">
        <div class="card mb-3 d-flex flex-row flex-wrap">
          <div class="card-body">
            <div class="d-flex flex-column align-items-center text-center">
              <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
              <div class="mt-3">
                <h4><?php echo strtoupper($_SESSION['Username']) ?></h4>
                <p class="text-secondary mb-1">Lecturer @ CS Department</p>
                <p class="text-muted font-size-sm"></p>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#xampleModal">Edit Account </button>
                <button class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#leaveModal">Apply Leave</button>
                <button class="btn btn-success btn-outline" onclick="destroy()">Logout</button>
              </div>
            </div>
          </div>
          <?php
          $sql = "SELECT * from empl_sec Where empl_id LIKE '" . $_SESSION['id'] . "' ";
          $rs = $conn->query($sql) or die($conn->error);
          while ($result = $rs->fetch_assoc()) :
          ?>
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Employee ID :</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <?php echo $result['empl_id'] ?>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Full Name :</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <?php echo $result['Name'] ?>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Email :</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <?php echo $result['Email_id'] ?>
                </div>
              </div>
              <hr>

              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Department :</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <?php echo $result['Dept'] ?>
                </div>
              </div>

              <hr>

              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Mobile :</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <?php echo $result['Num'] ?>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <h6 class="mb-0">Address :</h6>
                </div>
                <div class="col-sm-9 text-secondary">
                  <?php echo $result['Address'] ?>
                </div>
              </div>
              <hr>
            </div>
          <?php endwhile ?>
        </div>
      </div>
    </div>




    <div class="modal fade" id="xampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog " role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">EDIT ACCOUNT</h5>
            <hr>
          </div>
          <div class="modal-body">
            <form action="" method="POST">
              <div class="sm">
                <label for="exampleInputName" class="form-label">Name</label>
                <input type="text" class="form-control" id="exampleInputName" name="Name" required>
              </div>
              <div class="sm-3">
                <label for="exampleInputfile" class="form-label">Change Profile Image</label>
                <input type="file" class="form-control" id="exampleInputfile" name="profile">
              </div>

              <div class="sm-3">
                <label for="exampleInputEmail" class="form-label">Email</label>
                <input type="Email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" name="Email" required>
              </div>

              <div class="sm-3">
                <label for="exampleInputMobile" class="form-label">Mobile No</label>
                <input type="text" class="form-control" id="exampleInputMobile" name="Num" required>
              </div>
              <br>
              <button type="submit" class="btn btn-primary" name="Submit">Submit</button>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="leaveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog " role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">LEAVE SECTION</h5>
            <hr>
          </div>
          <div class="modal-body">
            <form method="POST">
              <div class="sm">
                <label for="exampleInputName" class="form-label">From Date</label>
                <input type="date" class="form-control " name="exampleInputdate" id="exampleInputdate" required>
              </div>
              <div class="sm-3">
                <label for="exampleInputfile" class="form-label">To Date </label>
                <input type="date" class="form-control" name="exampleInput_to_date" id="exampleInput_to_date" required>
              </div>

              <div class="sm-3">
                <label for="exampleInputEmail" class="form-label">Leave Type</label>
                <select class="form-select" aria-label="Default select example" name="leave_type" required>
                  <option selected>Select Your Leave Type</option>
                  <option value="Health">Health</option>
                  <option value="Personal">Personal</option>
                </select>
              </div>

              <div class="sm-3">
                <label for="exampleInputMobile" class="form-label">Remark</label>
                <textarea class="form-control" name="exampleInputremark" required></textarea>
              </div>
              <div class="sm-3">
                <label for="exampleInputfile" class="form-label">Any Other Document</label>
                <input type="file" class="form-control" name="exampleInputfile" placeholder="*Optional">
              </div>
              <br>
              <button type="submit" class="btn btn-primary" name="Leave_submit">Submit</button>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    var date = new Date();
    var year = date.getFullYear(); // YYYY
    var month = ("0" + (date.getMonth() + 1)).slice(-2); // MM
    var day = ("0" + date.getDate()).slice(-2); // DD
    var minDate = (year + "-" + month + "-" + day);
    var nextDay = new Date(minDate).toISOString().slice(0, 10);

    $('#exampleInputdate').attr('min', minDate);

    $('#exampleInput_to_date').attr('min', nextDay);

    function destroy() {
      window.location = "../logout.php";
    }
  </script>

  <br>
</body>

</html>