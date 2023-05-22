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
  //==========================================================================================================================
  if ($_SERVER['REQUEST_METHOD'] == 'POST')
  {
    $email= $_POST['email'];
    $password = $_POST['password'];
    if (isset($_POST['type']) && $_POST['type'] == 'homeseeker')
    {

      include('Homeseekerpage.php');//------ الفنكشن اللي تتاكد من الايميل والباسوورد
      $login  = homeseekerLogin($email, $password);//---------------

      if ($login) {

        header('location:Homeseekerpage.php');
      } else {

        $error  = 'Invalid Email Or Password';

      }

    }
    if (isset($_POST['type']) && $_POST['type'] == 'homeowner')
    {

      include('homeowner.php');//-----------
      
      $login  = homeownerLogin($email, $password);//------------
      if ($login) {

        header('location:homeowner.php');
      } else {

        $error  = 'Invalid Email Or Password';
      }
    }
  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Housing Any Where | Login</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" href="style.css" type="text/css" />
	
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
				<h2>Login</h2>
			</header>
		</section>
    <?php if (isset($error)){
      echo "error";

    }
    ?>

		<form id="login_form" action="login.php" method="POST">
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
			</div>
			<div class="form-row">
				<div class="input-group">
					<label for="type">Type *</label>
					<select class="form-control" id="type" name="type" required>
						<option value="HomeSeeker" name="homeseeker">Home Seeker</option>
						<option value="Homeowner" name="homeowner">Homeowner</option>
					</select>
				</div>
			</div>
			<input class="button" id="login" type="submit" value="login" onclick="goTo(); return false;">
			<div style="width:10%; margin:auto auto;">
				<a href="signup.html">Sign up</a> </div>

		</form>
	</div>

	<footer>
		<p class="copyright">Copyright &copy; 2023 <a href="index.html">Housing Anywhere</a> All rights reserved.
		</p>
	</footer>
<script>
function goTo(){
             type = document.getElementById("type").value;
             console.log(type);
             if(type==="HomeSeeker")
             {
                   location.replace("Homeseekerpage.html");
             }
             else
             {
                location.replace("Homeowner.html");  
             }
             }
</script>	
</body>
</html>
