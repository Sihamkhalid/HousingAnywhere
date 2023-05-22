
<html>
    <?php
    // session_start();
// if (!isset($_SESSION['homeowner_id'])) {
//     header('Location: login.php');
//     exit();
// }

        $connection = mysqli_connect("localhost", "root","root", "web_project") ;
        $error = mysqli_connect_error() ;
    ?>

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="(Basic)Style.css">
	<title>Housing Any Where | Homeowner </title>

</head>
<div class="homeowner">
	<body>

		<!--logo-->
	
    <header>
        <div class="logo">
            <img src="images/logo.png" alt="Logo" width= "150px" /> 
        </div>
            <div class="topnav">
                <a class="active" href="index.php">Log Out</a>
            </div>
            <?php
       
       if ($error != null)
       {
           echo"<p> Could not connect to the database. </p>";
       }

       
    ?>
    </header> 
		
	<main>

		<div class="info">
            <?php 
            $homeowner_id = '1';
           // $homeowner_id = $_SESSION['homeowner_id'];
            $sql = "SELECT * FROM homeowner WHERE ho_id = '$homeowner_id'";
            $rresult =  mysqli_query($connection, $sql);
            $row = mysqli_fetch_assoc($rresult);
           
            
            ?>
			<section style="text-align: center;">
				<h1>Welcome <strong><?php echo $row['name'];?></strong>! </h1>
			</section>
			<!--	<pre><b>Name: Aldanah Mohammed         Phone number: 0576867935         Email: aldanah@gmail.com</b></pre> -->
			<!-- <pre><span class="em"> Your Name: </span>  Aldanah Mohammed      <span class="em">Phone number: </span> 0576867935     <span class="em">    Email address: </span> aldanah@gmail.com</pre> -->

			<pre> <img src="images/user.png" alt="user" style="width:20px;height:20px;"><?php echo $row['name'];?>  <img src="images/phone.png" alt="phone" style="width:20px;height:20px;"><?php echo $row['phone_number'];?>     <img src="images/email.png" alt="email" style="width:20px;height:20px;"><?php echo $row['email_address'];?></pre>
			<br>
		</div>

		<br>
		<div class="content">
			<h3 class="title">Rental Applications</h3>
			<br>
	    <table class="table">
      <thead>
        <tr>
          <th>Property Name</th>
          <th>Location</th>
          <th>Applicant</th>
          <th>Status</th>
          <td></td>
        </tr>
      </thead>
      <tbody>
           <?php 
            $sql = "SELECT * FROM rentalapplication ra, property p"
                    . " WHERE ra.property_id=p.p_id AND p.homeowner_id=1";
            $result = mysqli_query($connection, $sql);
                
                while($row = mysqli_fetch_assoc($result)){
                    echo "<tr > <td><a href='PropertyDetailsPage.php?pid=".$row['p_id']."'>"
                        . $row['name']."</a></td>";
                    echo "<td>".$row['location']."</td>";
                    
                    $sqll = "SELECT * FROM homeseeker WHERE hs_id IN(SELECT home_seeker_id FROM rentalapplication WHERE ra_id=".$row['ra_id'].")";
                    $hsName = mysqli_query($connection, $sqll);
                 
                    while($name = mysqli_fetch_assoc($hsName)){
                    echo "<td><a href='applicantsinformation.php?hsid=".$name['hs_id']."'>".$name['first_name']." ".$name['last_name']."</td>";}
                
                    $ssql = "SELECT * FROM applicationstatus";
                    $status = mysqli_query($connection, $ssql);
                    while($stat = mysqli_fetch_assoc($status)){
                        if($row['application_status_id']==$stat['appS_id']){
                        echo "<td>".$stat['status']."</td>";
                        if($stat['status']=="Under consideration"){
                            echo "<td><a href='update.php?accept=".$row['ra_id']."&rent=".$row['property_id']."'>Accept</a> "
                                    . "<a href='update.php?declineOne=".$row['ra_id']."'>Decline</a></td>";
                        }
                        else{ 
                            echo "<td><a></a></td>";
                        }
                        
                        break;
                        } 
                    }
                    echo "</tr>";
                }
                
           
          ?>

      </tbody>
    </table>
		</div>
		<br><br>
		<div class="content">

			<h2 class="add"> <a href="AddNewProperty.php" class="addp">Add property</a> </h2>
			<h3 class="title">Listed Properties</h3>
			<br>
<table class="table">
        <thead>
          <tr>
            <th>Property Name</th>
            <th>Category</th>
            <th>Rent</th>
            <th>Rooms</th>
            <th>Location</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
  <?php
          
            
            $que = "SELECT * FROM property WHERE homeowner_id=1 AND p_id NOT IN"
                    . "(SELECT property_id FROM rentalapplication )";
            $list = mysqli_query($connection, $que);
            
             while($listed = mysqli_fetch_assoc($list)){
                 echo "<td><a href='PropertyDetailsPage.php?pid=".$listed['p_id']."'>".$listed['name']."</a></td>";
                 
                $sql = "SELECT * FROM propertycategory WHERE pc_id=".$listed['property_category_id'];
                $resultt = mysqli_query($connection, $sql);
                 while($rows= mysqli_fetch_assoc($resultt)){                 
                    echo "<td>".$rows['category']."</td>";}
                     
                echo "<td>".$listed['rent_cost']."</td>";
                echo "<td>".$listed['rooms']."</td>";
                echo "<td>".$listed['location']."</td>";
                echo "<td><a href='delete.php?delete=".$listed['p_id']."'>Delete</a></td></tr>";
   
                
                 
             }        
            
            ?>
         
        </tbody>
      </table>
     </div>
			
		<br><br>
	</main>
		<footer>
			<p class="copyright">Copyright &copy; 2023 <a href="index.html">Housing Anywhere</a> All rights reserved.
			</p>
		</footer>
		</body>
</div>
	</html>
