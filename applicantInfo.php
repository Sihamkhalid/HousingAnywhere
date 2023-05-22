<!DOCTYPE html>
<html lang="en">

<?php
  if (!isset($_SESSION)) session_start();
  if (!isset($_SESSION['id'])) {
      echo "<script>
        alert('You must login to view the page!');
        window.location.href='/web-pro/login.php';
      </script>";
  }

  if(!isset($_GET['id'])) {
    echo "<script>
      alert('No applicant id was provided!');
      window.location.href='/web-pro/';
    </script>";
  }

  include("server.php");
  $query = mysqli_query($con, "SELECT * FROM homeseeker WHERE hs_id = {$_GET['id']}");
  $applicant = mysqli_fetch_assoc($query);

?>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script type="text/javascript" src="js/javascript.js"></script>


  <title>Housing Any Where | Applicant Information</title>
  <style>
    p em {
      color: rgb(23, 9, 74);
      font-size: larger;
      text-shadow: 2px 1px 3px #0000004e;
    }

    p {

      text-shadow: 2px 1px 3px #2b21124e;
      color: rgb(71, 113, 130);
      font-size: 110%;
    }


    #logo img {
      width: 150px;
    }


    html {
      background: rgba(169, 169, 181, 0.151) 100%;
    }

    header {
      background: linear-gradient(to bottom, rgb(155, 155, 167) 0%, rgba(155, 155, 167, 0.879) 39%, rgba(155, 155, 167, 0.868) 40%, rgba(155, 155, 167, 0.728) 56%, rgba(155, 155, 167, 0.731) 60%, rgba(155, 155, 167, 0.452) 80%, rgba(155, 155, 167, 0.432) 81%, rgba(155, 155, 167, 0.237) 90%, rgba(155, 155, 167, 0.199) 91%, rgba(169, 169, 181, 0.178) 95%, rgba(169, 169, 181, 0.121) 98%, rgba(169, 169, 181, 0.048) 100%);
    }

    .copyright {
      position: relative;
      width: 420px;
      margin: 0 auto;
      text-align: center;
      color: rgba(155, 155, 167, 0.868);
      line-height: 30px;
    }

    .copyright a {
      color: rgba(155, 155, 167, 0.452);
    }

    .copyright a:hover {
      color: #5773a4;
    }

    footer {
      text-align: center;
      display: flex;
      align-items: center;
      height: 10vh;
      margin: auto auto;
      background: linear-gradient(to bottom, rgba(169, 169, 181, 0.048) 0%, rgba(169, 169, 181, 0.121) 39%, rgba(169, 169, 181, 0.178) 40%, rgba(155, 155, 167, 0.199) 56%, rgba(155, 155, 167, 0.237) 60%, rgba(155, 155, 167, 0.432) 80%, rgba(155, 155, 167, 0.452) 81%, rgba(155, 155, 167, 0.731) 90%, rgba(155, 155, 167, 0.728)91%, rgba(155, 155, 167, 0.868)95%, rgba(155, 155, 167, 0.879)98%, rgb(155, 155, 167) 100%);

    }

    .topnav {
      background-color: linear-gradient(to bottom, rgb(155, 155, 167) 0%, rgba(155, 155, 167, 0.879) 39%, rgba(155, 155, 167, 0.868) 40%, rgba(155, 155, 167, 0.728) 56%, rgba(155, 155, 167, 0.731) 60%, rgba(155, 155, 167, 0.452) 80%, rgba(155, 155, 167, 0.432) 81%, rgba(155, 155, 167, 0.237) 90%, rgba(155, 155, 167, 0.199) 91%, rgba(169, 169, 181, 0.178) 95%, rgba(169, 169, 181, 0.121) 98%, rgba(169, 169, 181, 0.048) 100%);
      overflow: hidden;

    }


    .topnav a {
      float: right;
      color: #002244;
      text-align: center;
      padding: 14px 20px;
      text-decoration: none;
      font-size: 17px;
      border-radius: 20px;

    }

    .topnav a:hover {
      background-color: #ddd;
      color: black;
    }


    .topnav a.active {
      background-color: #002244;
      color: white;
    }

    a {
      color: #143ba8;
      text-decoration: none;
    }

    h3 {
      width: 35%;
      background-image: url("images/Background.jpeg");
      border-radius: 6px;
      text-align: center;
      font-size: 20px;

      text-transform: uppercase;
      color: #374255;
      font-family: Georgia, 'Times New Roman', Times, serif;

    }
  </style>
</head>

<body>
  <header>
    <div class="logo">
      <img src="images/logo.png" alt="Logo" width="150px" />
    </div>
    <div class="topnav">
      <a class="active" href="index.html">Log Out</a>
      <a href="homeowner.html">Homeowner page</a>
    </div>
  </header>


  <h3> Applicant's Information</h3>
  <div class="Proinfo">
    <ul>
      <li>
        <p> <em> Applicant Name: </em> <?php echo $applicant['first_name'] ?> <?php echo $applicant['last_name'] ?> </p>
      </li>
      <li>
        <p> <em>Phone Number:</em> <?php echo $applicant['phone_number'] ?> </p>
      </li>
      <li>
        <p> <em> Number of family members: </em> <?php echo $applicant['family_members'] ?> </p>
      </li>
      <li>
        <p> <em>Email:</em> <?php echo $applicant['email_address'] ?> </p>
      </li>
      <li>
        <p> <em>Age:</em> <?php echo $applicant['age'] ?> </p>
      </li>
      <li>
        <p> <em>Job:</em> <?php echo $applicant['job'] ?> </p>
      </li>
      <li>
        <p> <em>Income per month:</em> <?php echo $applicant['income'] ?> </p>
      </li>
    </ul>
  </div>
</body>
<br><br><br><br><br><br>
<br><br><br><br><br>



<footer>
  <p class="copyright">Copyright &copy; 2023 <a href="index.html">Housing Anywhere</a> All rights reserved.</p>
</footer>
</html>
