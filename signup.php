<?php 
  session_start();?>
 <?php include_once('db.php'); ?>
<?php
  if (isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'homeseeker') {
      header('location: Homeseekerpage.php');//------------
    }
    if ($_SESSION['role'] == 'homeowner') {
      header('location: homeowner.php');//-----------------
    }
    
  }
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['age']) && isset($_POST['familymembers'])&& isset($_POST['income'])&& isset($_POST['job'])&& isset($_POST['phonenumber'])&& isset($_POST['email'])&& isset($_POST['password'])&& isset($_POST['confirm_password'])){
		$firstname = mysqli_real_escape_string($databaseCon, $_POST['firstname']);
		$lastname = mysqli_real_escape_string($databaseCon, $_POST['lastname']);
		$age = mysqli_real_escape_string($databaseCon, $_POST['age']);
		$familymembers = mysqli_real_escape_string($databaseCon, $_POST['familymembers']);
		$income = mysqli_real_escape_string($databaseCon, $_POST['income']);
		$job = mysqli_real_escape_string($databaseCon, $_POST['job']);
		$phonenumber = mysqli_real_escape_string($databaseCon, $_POST['phonenumber']);
		$email = mysqli_real_escape_string($databaseCon, $_POST['email']);
		$password = mysqli_real_escape_string($databaseCon, $_POST['password']);
		$confirm_password = mysqli_real_escape_string($databaseCon, $_POST['confirm_password']);
		

		$query = "SELECT * FROM `homeseeker`;";
		$result = mysqli_query($databaseCon, $query) or die(mysqli_error($databaseCon));
		
		

		while($rows = mysqli_fetch_array($result)){
			if( $email == $rows['email_address']){
				$msg = '<h4 style="color:red;">This data entered exists</h4>';
				break; 
			}
		}
		

		if (empty($msg)) {
			$hashed_pass = password_hash($password ,  PASSWORD_DEFAULT  );

			$query = "INSERT INTO `homeseeker` (first_name, last_name, age, family_members,income,job,phone_number,email_address,password) VALUES('$firstname', '$lastname', '$age',' $familymembers','$income','$job','$phonenumber','$email','$hashed_pass')";

			$result = mysqli_query($databaseCon, $query) ;
			
			if ($result) {
				$query = "SELECT * FROM `homeseeker` WHERE email='$email' and password='$hashed_pass'";
				$result = mysqli_query($databaseCon, $query) or die(mysqli_error($databaseCon));
				
				if ( mysqli_num_rows($result) == 1){
					$row = mysqli_fetch_assoc($result);

$_SESSION['id'] = $row['id'];
$_SESSION['first_name'] = $row['first_name'];
$_SESSION [ 'last_name'] = $row ['last_name'];
$_SESSION['age'] = $row['age'];
$_SESSION ['family_members'] = $row['family_members'];
$_SESSION['income'] = $row['income'];
$_SESSION['job'] = $row['job'];
$_SESSION ['phone_number'] = $row['phone_number'];
$_SESSION['email_address'] = $row['email_address'];
$_SESSION['password'] = $row['password'];
$_SESSION[ 'role'] = 'hameseeker';
					
					header("Location: Homeseekerpage.php");//------------------------
					exit;
				}
				else{
					$msg = '<h4 style="color:red;">Error in signup.</h4>';
				}
			} else {
				$msg = '<h4 style="color:red;">Error in signup.</h4>';
			}
		}
	}
	else{
		$msg = '<h4 style="color:red;">required data is missing!</h4>';
	}

}
	

?>
<!DOCTYPE html>
<html>
<head>
	<title>Housing Any Where | Home</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="style.css" type="text/css" />
	<script type="text/javascript" src="js/javascript.js"></script>
</head>
<body>

	<header id="headerLogo">
		<div id="logo">
			<img src ="images/logo.png" alt ="logo" >
		</div>
	</header>

	<div id="content">
		<section style="text-align: center;">
			<header class="title">
				<h2>Signup</h2>
			</header>
		</section>
		
		<form name="signup_form" action="signup.php" method="POST">
			<div class="form-row">
				<div class="input-group">
					<label for="firstname">First Name *</label>
					<input type="text" class="form-control" id="firstname" name="firstname" required>
				</div>
				<div class="input-group">
					<label for="lastname">Last Name *</label>
					<input type="text" class="form-control" id="lastname" name="lastname" required>
				</div>
			</div>
			<div class="form-row">
				<div class="input-group">
					<label for="age">Age *</label>
					<input type="number" class="form-control" id="age" name="age" required>
				</div>
				<div class="input-group">
					<label for="familymembers">Number of the family members *</label>
					<input type="number" class="form-control" id="familymembers" name="familymembers" required>
				</div>
			</div>
			<div class="form-row">
				<div class="input-group">
					<label for="income">Income *</label>
					<input type="number" class="form-control" id="income" name="income" required>
				</div>
				<div class="input-group">
					<label for="job">Job *</label>
					<input type="text" class="form-control" id="job" name="job" required>
				</div>
			</div>


			<div class="form-row">
				<div class="input-group">
					<label for="phonenumber">Phone Number *</label>
					<input type="tel" class="form-control" id="phonenumber" name="phonenumber" required>
				</div>
			</div>
		
			<div class="form-row">
				<div class="input-group">
					<label for="email">Email *</label>
					<input type="email" class="form-control" id="email" name="email" value="" required>
				</div>
			</div>
			<div class="form-row">
				<div class="input-group">
					<label for="password">Password *</label>
					<input type="password" class="form-control" id="password" name="password" value="" required>
				</div>
				<div class="input-group">
					<label for="confirm_password">Confirm Password*</label>
					<input type="password" class="form-control" id="confirm_password" name="confirm_password" value="" required>
				</div>
			</div>
			<input class="button" id="signup" name="signup" type="submit" value="sign-up" onclick="signup.php">
			
			<div style="width:10%; margin:auto auto;">
				<a href="login.html" >Login</a> </div>
				<!--****************************************************
				<?php  

				if(!empty($errors)){
					foreach($errors as $error){
						echo $error;
					}
				}
				?>

***********************************************************-->
		</form>
	</div>

	<footer>
		<p class="copyright">Copyright &copy; 2023 <a href="index.html">Housing Anywhere</a> All rights reserved.
		</p>
	</footer>
</body>
</html>
