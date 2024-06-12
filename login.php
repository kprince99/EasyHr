<?php

include './connection/connection.php';
include './includes/error-handler.php';
if (isset($_SESSION['user_id']) && isset($_SESSION['flag']) == 1) {
	echo isset($_SESSION['flag']);
	header('location: ./admin/dashboard.php');
	exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Login Page</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" type="text/css"
		href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="/assets/css/style.css">
	<link rel="apple-touch-icon" sizes="180x180" rel="noopener" href="assests/img/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" rel="noopener" href="assets/img/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" rel="noopener" href="assests/img/favicon-16x16.png">
	<link rel="manifest" href="/site.webmanifest">
</head>

<body>
	<section class="main-content">
		<div class="container">
			<div class="login-card d-flex rounded-lg overflow-hidden bg-white">
				<div class="login-message d-none d-sm-none d-md-flex flex-column justify-content-center p-5">
					<h2>Welcome back</h2>
					<img src="https://cdn.iconscout.com/icon/free/png-512/best-employee-23-1117676.png" alt="Welcome"
						class="img-fluid mb-3">
					<p>Login into Employee Managment System!</p>
				</div>
				<div class="login-body">
					<div class="login-body-wrapper mx-auto">
						<h3 class="text-center text-uppercase mb-3 text-primary">Login</h3>
						<form action="./authentication/validate.php" method="POST">
							<?php
							if (isset($_SESSION['error-message'])) {
								echo error($_SESSION['error-message']);
								unset($_SESSION['error-message']);
							}
							?>
							<div class="form-group">
								<label for="email">Username</label>
								<input type="text" class="form-control form-control-lg" name="Username" id="email"
									aria-describedby="helpId" placeholder="Enter Username" required>
							</div>
							<div class="form-group">
								<label for="password">Password</label>
								<input type="password" class="form-control form-control-lg" name="Password" id="password"
									aria-describedby="helpId" placeholder="Enter your Password" required>
								<a href="#!">Forgot password?</a>
							</div>
							<button class="btn btn-primary btn-block btn-lg">Login</button>
						</form>
						<p class="text-muted text-center">New to our platform? <a href="#!">Signup</a></p>
					</div>
				</div>
			</div>
		</div>
	</section>
</body>

</html>