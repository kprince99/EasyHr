<?php
include '../connection/connection.php';

if (!isset($_SESSION['user_id']) || !isset($_SESSION['password_token'])) {
  header('location: ../login.php');
  exit();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="apple-touch-icon" sizes="180x180" rel="noopener" href="../assests/img/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" rel="noopener" href="../assets/img/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" rel="noopener" href="../assests/img/favicon-16x16.png">
  <script src="https://kit.fontawesome.com/425aca6d49.js" crossorigin="anonymous"></script>
  <!-- Latest compiled and minified CSS -->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <title>DASHBOARD</title>
  <link rel="stylesheet" type="text/css" href="../assets/css/style.css">
  <link rel="stylesheet" href="dashboard.css">
  <meta name="robots" content="noindex">
</head>

<body>
  <input type="checkbox" name="checkbox" id="checkbox">
  <div class="sidebar-overlay position-relative">
    <!-- Create Fontawesome X Button  -->
    <i class="btn-close-sidebar bx bx-x bx-md"></i>
    <div id="sidebar">
      <header class="navbar-header mt-1 mb-3">
        <a class="brand-logo text-dark">
          <i class='bx bx-md bxs-bolt-circle'></i>
          LMS</a>
      </header>
      <ul class="d-flex flex-column ">
        <li class="nav-item">
          <a href="dashboard.php" data-url="dashboard" class="nav-links"><img class="nav-icons me-3" src="../assets/img/icons/dashboard.png">Dashboard</a>
        </li>
        <li class="nav-item">
          <a href="user-details.php" data-url="user-details" class="nav-links"><img class="nav-icons me-3" src="../assets/img/icons/user.png">User
            Details</a>
        </li>
        <li class="nav-item">
          <a href="member-list.php" data-url="member-list" class="nav-links"><img class="nav-icons me-3" src="../assets/img/icons/member.png"> Member
            List</a>
        </li>
        <li class="nav-item">
          <a href="leaves.php" data-url="leaves" class="nav-links"><img class="nav-icons me-3" src="../assets/img/icons/envelope-open.png">Leaves</a>
        </li>
        <li class="nav-item">
          <a href="reset-password.php" data-url="reset-password" class="nav-links"><img src="../assets/img/icons/password-key.png" class="nav-icons me-3">Reset
            Password</a>
        </li>
        <li class="nav-item">
          <a href="settings.php" data-url="settings" class="nav-links"><img class="nav-icons me-3" src="../assets/img/icons/cog.png">Settings</a>
        </li>
        <li class="nav-item logout">
          <a href="../logout.php" class="nav-links-logout"> <i class="fas fa-sign-out-alt me-3"></i>Logout
          </a>
        </li>
      </ul>
    </div>
  </div>


  <main id="main-content">
    <nav>
      <label for="checkbox" class="check-box">
        <span class="line "></span>
        <span class="line "></span>
        <span class="line "></span>
      </label>
      <div class="page-title pt-md-4">
        <h3 class=" px-3 m-0 fw-bold page-title-main">Dashboard</h3>
      </div>
      <div class="account mt-md-3">
        <img id="nav-img" src="https://i.pinimg.com/originals/ca/76/0b/ca760b70976b52578da88e06973af542.jpg"
          width="35px" height="35px" alt="Name" />
        <span class=" fw-bold ms-1">
          <?php echo $_SESSION['user_data']['Full Name'] ?>
        </span>
      </div>
    </nav>

    <div class="content-wrapper container-fluid "></div>
  </main>
  <?php
  ?>
</body>
<noscript>
  <style>
    main,
    .sidebar-overlay {
      display: none !important;
    }
  </style>

  <body>
    <p>Your browser does not support JavaScript. Please enable JavaScript to use this site.</p>
  </body>
</noscript>
<script src="../assets/js/script.js"></script>

</html>  