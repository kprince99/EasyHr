<?php
include_once '../connection/connection.php';

if (!isset($_SESSION['user_id']) || !isset($_SESSION['password_token'])) {
  header('location: ../login.php');
  exit();
}

$employeeID = $_SESSION['user_data']['EmployeeID'];
$name = $_SESSION['user_data']['Full Name'];
$email = $_SESSION['user_data']['Email'];
$phone = $_SESSION['user_data']['Mobile_no'];

?>
<div>
  <div class="container-fluid bg-body mt-4 rounded">
    <div class="col-12 py-4 px-md-3  border-bottom">
      <div class=" p-3 border border-light-subtle border-2 rounded-lg-extra position-relative">
        <button id="edit-profile"
          class="btn fw-bold border px-3 py-2 rounded-lg border-2 border-light-subtle text-dark position-absolute top-0 end-0 mt-2 me-2"><i
            class="fa fa-pencil" aria-hidden="true"></i>
          Edit</button>
        <div class="d-flex flex-column align-items-center flex-sm-row ">
          <img
            src="https://static.vecteezy.com/system/resources/thumbnails/002/002/403/small/man-with-beard-avatar-character-isolated-icon-free-vector.jpg"
            class="rounded-circle" width="200px" height="auto" loading="lazy">
          <div class="d-flex flex-column align-items-center">
            <button class="btn border px-3 py-2 rounded-lg border-2 border-primary text-dark">Upload new
              photo</button>
            <p class="text-secondary mt-3 mb-0 text-center">At least 800 x 800 recommended</p>
            <p class="text-secondary">Maximum file size: 1MB</p>
          </div>
        </div>
        <div class="d-flex justify-content-between align-items-center">
          <p class=" fs-5 fw-bold my-auto">Personal Info</p>
        </div>
        <div class="user-profile position-relative mt-3 ">
          <form id="editForm" method="POST">
            <input type="hidden" name="update-profile" value="1">
            <div class="row">
              <div class="col-12 col-md-6 col-lg-3">
                <span class="position-relative">
                  <label for="emp_id" class="formlabel fw-semibold text-muted">Employee ID</label>
                  <p class="staticData text-dark">
                    <?php echo $employeeID; ?>
                  </p>
                  <input type="text" id="emp_id" name="emp_id"
                    class="mt-2 editable-input form-control form-control-lg border hover:border-primary border-2"
                    value="<?php echo $employeeID; ?>" disabled>
                </span>
              </div>
              <div class="col-12 col-md-6 col-lg-3">
                <span class="position-relative">
                  <label for="name" class="formlabel  text-muted">Full Name</label>
                  <p class="staticData text-dark">
                    <?php echo $name; ?>
                  </p>
                  <input type="text" id="name" name="name"
                    class="mt-2 editable-input form-control form-control-lg border hover:border-primary border-2"
                    value="<?php echo $name; ?>">
                </span>
              </div>
              <div class="col-12 col-md-6 col-lg-3">
                <span class="position-relative">
                  <label for="mobileNumber" class="formlabel text-muted">Phone</label>
                  <p class="staticData text-dark">
                    <?php echo $phone; ?>
                  </p>
                  <input type="tel" id="mobileNumber" name="phone"
                    class="mt-2 editable-input form-control form-control-lg border hover:border-primary border-2"
                    onInput="this.value = this.value.replace(/\D/g,'').substring(0,10)" value="<?php echo $phone; ?>">
                </span>
              </div>
              <div class="col-12 col-md-6 col-lg-3">
                <span class="position-relative">
                  <label for="email" class="formlabel text-muted">Email</label>
                  <p class="staticData text-dark">
                    <?php echo $email; ?>
                  </p>
                  <input type="email" id="email" name="email"
                    class="mt-2 editable-input rounded-3 form-control form-control-lg border hover:border-primary border-2"
                    value="<?php echo $email; ?>">
                </span>
              </div>
              <div>
                <span class=" mt-3 mx-auto py-1 float-end">
                  <button type="submit" name="submit" class="btn btn-outline-primary save-btn h-100 px-3 py-2 rounded-lg border-2">
                    Save Changes</button>
                </span>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>