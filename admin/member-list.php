<?php
include '../connection/connection.php';

if (!isset($_SESSION['user_id']) || !isset($_SESSION['password_token'])) {
  header('location: ../login.php');
  exit();
}

$stmt = $conn->prepare("SELECT * FROM `user_account`");
$stmt->execute();
$result = $stmt->get_result();
?>

<section class="employee-list h-full d-block">
  <div class="container-fluid bg-body rounded mb-3">
    <div class="d-flex justify-content-between align-items-center py-3 gap-3">
      <h2 class="my-auto">Manage Employees</h2>
      <button type="button" class="btn btn-color"><i class='bx bxs-plus-circle me-2'></i> Add Employee
      </button>
    </div>
  </div>
  <div class="bg-body rounded responsive-table ">
    <table>
      <thead>
        <tr>
          <th>
            <input type="checkbox">
          </th>
          <th>Employee ID</th>
          <th>Full Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Department</th>
          <th>DOB</th>
          <th>Joining Date</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
      </thead>
      <tbody>
        <?php
        global $count;
        while ($row = $result->fetch_assoc()) {
          ?>
          <tr>
            <td>
              <input type="checkbox">
            </td>
            <td>
              <?php echo htmlspecialchars($row['EmployeeID']); ?>
            </td>
            <td>
              <?php echo htmlspecialchars($row['Full Name']); ?>
            </td>
            <td>
              <?php echo htmlspecialchars($row['Email']); ?>
            </td>
            <td>
              <?php echo htmlspecialchars($row['Mobile_no']); ?>
            </td>
            <td>
             <span class="role-badge <?php  
                switch($row['Department']) {
                  case 'HR': echo 'bg-info'; break;
                  case 'IT': echo 'bg-primary'; break;
                  case 'Marketing': echo 'bg-warning'; break;
                  case 'Finance': echo 'bg-success'; break;
                  default: echo 'bg-danger'; break;
             }
              ?>"> 
                <?php echo htmlspecialchars($row['Department']); ?>
             <span>
            </td>
            <td>
              <?php echo htmlspecialchars($row['DOB']); ?>
            </td>
            <td>
              <?php echo htmlspecialchars($row['Joining Date']); ?>
            </td>
            <td>
              <a id="user-edit-form" data-role="update" href="javascript:void(0)"
                data-id="<?php echo $row['EmployeeID']; ?>">
                <i class='bx bx-sm bxs-edit'></i>
              </a>
            </td>
            <td>
              <a style="color:red" data-role="delete" data-toggle="modal" data-target="#deleteConfirmation" href="javascript:void(0)"
              data-id="<?php echo $row['EmployeeID']; ?>">
                <i class='bx bx-sm bxs-trash'></i>
              </a>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
</section>

<!-- Modal -->
<div class="modal fade" id="deleteConfirmation" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteConfirmationLabel">Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"><i class="bx bx-x bx-sm"></i></span>
        </button>
      </div>
      <div class="modal-body">
        Are you sure you want to delete this item?
      </div>
      <div class="modal-footer">
        <button type="reset" class="btn btn-secondary" data-dismiss="modal" id="cancelDelete">Cancel</button>
        <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
      </div>
    </div>
  </div>
</div>

<section class="employee-form-update h-full w-100 d-none">
  <div class="container-fluid bg-body rounded my-3 ">
    <div class="d-flex justify-content-between align-items-center py-2 gap-3">
      <span class="back-btn d-flex">
        <i class='bx bx-sm bx-chevron-left' style="color: #7b39ed"></i> Edit Employee
      </span>
      <span><i class='bx bx-x bx-sm'></i></span>
    </div>
  </div>

  <div class="px-sm-2 px-md-3 overflow-y-hidden">
    <div class="container-fluid bg-body rounded pt-3">
      <h5><strong>Basic Info</strong></h5>
      <form id = "editFormSubmit" method="POST">
        <div class="row justify-content-between mt-3">
          <div class="col-xl-5 col-md-12 col-sm-12 mb-3">

            <div class="mb-3 d-md-flex ">
              <label for="employeeID" class="col-form-label col-xl-4">EmployeeID</label>
              <input type="text" class="form-control px-3 bg-transparent" id="employeeID" value="">
            </div>

            <div class=" mb-3 d-md-flex">
              <label for="FullName" class="col-form-label col-xl-4">Full Name </label>
              <input type="text" class="form-control px-3" name="FullName" id="FullName">
            </div>

            <div class=" mb-3 d-md-flex">
              <label for="ModifiedTime" class="col-form-label col-xl-4">Modified Time</label>
              <input type="date" class="form-control px-3" name="ModifiedTime" id="ModifiedTime">
            </div>
          </div>

          <div class="col-xl-6 col-md-12 col-sm-12 mb-3">

            <div class="mb-3 d-md-flex order-2">
              <label for="Email" class="col-form-label col-xl-4">Email Id</label>
              <input type="text" class="form-control px-3" name="email"  id="Email" value="">
            </div>

            <div class=" mb-3 d-md-flex order-1">
              <label for="nickname" class="col-form-label col-xl-4">Nickname</label>
              <input type="text" class="form-control px-3" name="nickname" id="nickname">
            </div>

            <div class=" mb-3 d-md-flex">
              <label for="MobileNumber" class="col-form-label col-xl-4">Mobile Number </label>
              <input type="number" class="form-control px-3" name="MobileNumber" id="MobileNumber">
            </div>

            <div class=" mb-3 d-md-flex">
              <label for="ModifiedBy" class="col-form-label col-xl-4">Modified By</label>
              <input type="text" class="form-control px-3" name="ModifiedBy" id="ModifiedBy">
            </div>
          </div>

          <h5 class="mb-3"><strong>Work Info</strong></h5>
          <div class="col-xl-5 col-md-12 col-sm-12 mb-3">
            <div class=" mb-3 d-md-flex">
              <label for="Department" class="col-form-label col-xl-4">Department</label>
              <input type="text" class="form-control px-3" name="Department" id="Department">
            </div>
            <div class=" mb-3 d-md-flex">
              <label for="SourceOfHire" class="col-form-label col-xl-4">Source Of Hire</label>
              <input type="text" class="form-control px-3" name="SourceOfHire" id="SourceOfHire">
            </div>
          </div>

          <div class="col-xl-6 col-md-12 col-sm-12 mb-3">
            <div class=" mb-3 d-md-flex">
              <label for="EmployeeType" class="col-form-label col-xl-4">Employee Type</label>
              <input type="text" readonly class="form-control px-3 bg-transparent" name="EmployeeType" id="EmployeeType">
            </div>

            <div class=" mb-3 d-md-flex order-1">
              <label for="Title" class="col-form-label col-xl-4">Position</label>
              <input type="text" class="form-control px-3" name="Title" id="Title">
            </div>

            <div class=" mb-3 d-md-flex">
              <label for="Joining" class="col-form-label col-xl-4">Date of Joining</label>
              <input type="text" readonly class="form-control px-3 bg-transparent" name="Joining" id="Joining">
            </div>
          </div>
        </div>
      </form>

      <!-- Add Employee Data -->
      <div class="container-fluid bg-body rounded pt-3">
      <h5><strong>Basic Info</strong></h5>
      <form id = "addEmployee" method="POST">
        <div class="row justify-content-between mt-3">
          <div class="col-xl-5 col-md-12 col-sm-12 mb-3">

            <div class=" mb-3 d-md-flex">
              <label for="FullName" class="col-form-label col-xl-4">Full Name </label>
              <input type="text" class="form-control px-3" name="FullName" id="FullName">
            </div>

            <div class="mb-3 d-md-flex order-2">
              <label for="Email" class="col-form-label col-xl-4">Email Id</label>
              <input type="text" class="form-control px-3" name="email" id="Email" value="">
            </div>
          </div>

          <div class="col-xl-6 col-md-12 col-sm-12 mb-3">

            <div class=" mb-3 d-md-flex order-1">
              <label for="nickname" class="col-form-label col-xl-4">Nickname</label>
              <input type="text" class="form-control px-3" name="nickname" id="nickname">
            </div>

            <div class=" mb-3 d-md-flex">
              <label for="MobileNumber" class="col-form-label col-xl-4">Mobile Number </label>
              <input type="number" class="form-control px-3" name="MobileNumber" id="MobileNumber">
            </div>

          </div>

          <h5 class="mb-3"><strong>Work Info</strong></h5>
          <div class="col-xl-5 col-md-12 col-sm-12 mb-3">
            <div class=" mb-3 d-md-flex">
              <label for="Department" class="col-form-label col-xl-4">Department</label>
              <input type="text" class="form-control px-3" name="Department" id="Department">
            </div>
            <div class=" mb-3 d-md-flex">
              <label for="SourceOfHire" class="col-form-label col-xl-4">Source Of Hire</label>
              <input type="text" class="form-control px-3" name="SourceOfHire" id="SourceOfHire">
            </div>
          </div>

          <div class="col-xl-6 col-md-12 col-sm-12 mb-3">
            <div class=" mb-3 d-md-flex">
              <label for="EmployeeType" class="col-form-label col-xl-4">Employee Type</label>
              <input type="text" readonly class="form-control px-3 bg-transparent" name="EmployeeType" id="EmployeeType">
            </div>

            <div class=" mb-3 d-md-flex order-1">
              <label for="Title" class="col-form-label col-xl-4">Position</label>
              <input type="text" class="form-control px-3" name="Title" id="Title">
            </div>

            <div class=" mb-3 d-md-flex">
              <label for="Joining" class="col-form-label col-xl-4">Date of Joining</label>
              <input type="text" readonly class="form-control px-3 bg-transparent" name="Joining" id="Joining">
            </div>
          </div>
        </div>
      </form>
    </div>
    </div>
  </div>
  
  <div class="container position-sticky  mt-3 bottom-0 bg-body rounded">
    <div class="d-flex gap-2 align-items-center py-3">
      <button type="button" name="submit" id="formSubmit" class="btn-color py-1">Submit</button>
      <button type="reset" id="formReset" class=" btn-color-border py-1">cancel</button>
    </div>
  </div>
</section>