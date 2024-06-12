<?php
include '../connection/connection.php';

if (!isset($_SESSION['user_id']) || !isset($_SESSION['password_token'])) {
  header('location: ../login.php');
  exit();
}
?>

<div class="box">
    <div class="box-row">
        <div class="inside-box">
          <div class="d-flex mt-3">
            <img class="me-2" src = "../assets/icons/sun.svg" alt = "sunny">
            <div>
              <span class="time"></span>
              <p class="para">Realtime Insight</p>
            </div>
          </div>
          <h5 class="mt-3 fw-bold">Today:</h5>
          <p class="todayDate fw-bold"></p>
          <a href="#"><button class="btn btn-primary mt-4 mb-2">View Leaves</button></a>
    </div>
  </div>
  <div class="box-row">
      <div class="inside-box">
        <div class="d-flex gap-2 justify-content-start align-items-center">
          <i class='bx bxs-user'></i>
            <h3 class="heads"> No of Users</h3>
        </div>
            <h3 class="big-head mt-2 d-flex justify-content-center">500K</h3>
      </div>
  </div>
  <div class="box-row">
    <div class="inside-box">
      <div class="d-flex gap-2 justify-content-start align-items-center">
        <i class='bx bxs-checkbox-checked'></i>
        <h3 class="heads"> Approved Leaves</h3>
      </div>
        <h3 class="big-head mt-2 d-flex justify-content-center">20</h3>
    </div>
  </div>
  <div class="box-row">
    <div class="inside-box ">
      <div class="d-flex gap-2 justify-content-start align-items-center ">
        <i class='bx bxs-x-circle'></i>
        <h3 class="heads"> Rejected Leaves</h3>
      </div>
        <h3 class="big-head mt-2 d-flex justify-content-center">20</h3>
    </div>
  </div>
  <div class="box-row">
    <div class="responsive-table">
      <table>
        <thead>
          <tr>
            <th>Employee Name</th>
            <th>Role</th>
            <th>Leave Type</th>
            <th>From</th>
            <th>To</th>
            <th>Total Days</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>Amsavarthan K</td>
            <td>Engineering</td>
            <td>Sick</td>
            <td>16.10.2019</td>
            <td>19.10.2019</td>
            <td>3</td>
            <td>Pending</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
