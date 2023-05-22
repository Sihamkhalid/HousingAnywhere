<?php include('connection.php'); ?>

<?php 
ini_set("display_errors", 1);
$query = "SELECT * FROM `homeseeker` WHERE id='1'"; //needs sessions $id
$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
$row = mysqli_fetch_array($result);

$query2 = "SELECT * FROM `property` WHERE id NOT IN (SELECT property_id FROM `rentalapplication` WHERE application_status_id=1 OR home_seeker_id=1)";//needs $id
$result2 = mysqli_query($connection, $query2) or die(mysqli_error($connection));

$query3 = "SELECT * FROM `rentalapplication`,`property` WHERE property.id = property_id And home_seeker_id='1'"; //$id
$result3 = mysqli_query($connection, $query3) or die(mysqli_error($connection));
$row3 = mysqli_fetch_array($result3);

$query4 = "SELECT * FROM `propertycategory`";
$result4 = mysqli_query($connection, $query4) or die(mysqli_error($connection));
?>



<html lang="en">

<head>
   
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Housing Any Where | Homeseeker </title>
	    <link rel="stylesheet" href="(Basic)Style.css">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
            
        <script>
              
            $(document).ready( function() { 
                $("#btn1").click(function(){
                $.post("searchProperties.php", { c: $("#Catsort").val()},
                   function(response){
                    var properties = JSON.parse(response);
                    var save = $('#dynamicContent #header').detach();
                    $('#dynamicContent').empty().append(save);
                    for(i=0; i<properties.length; i++){
                        if(properties[i].property_category_id==1)
                           $category = "Villa";
                        else
                            $category = "Apartment";
                        $("#dynamicContent").append("<tr><td> <a class='hover-underline' href='propertyDetails.php?id='" + properties[i].id + ">" + properties[i].name +
                                "</a> </td> <td>" + $category + "</td> <td>" + properties[i].rent_cost+"/month" + "</td> <td>" + properties[i].rooms + "</td> <td>" + properties[i].location +
                                "</td> <td> <a class='hover-underline' onClick='apply(this)'>Apply</a> </td> </tr>" );
                    }
                    
                  });
                });
            });
           </script>
</head>
<div class="homeseeker">
<body>


    <header>
        <div class="logo">
            <img src="images/logo.png" alt="Logo" width= "150px" /> 
        </div>
            <div class="topnav">
                <a class="active" href="index.html">Log Out</a>
            </div>
        
    </header>
        <main id="contentContainer">


            <div id="content">
                <!-- <span id ="Welcome"> >
           <section style="text-align: center;">
            <h1>Welcome <strong>Siham</strong>! </h1> 
         </section>

               <!-- <pre><span class="em"> Your Name: </span>  <?php echo $row["first_name"]." ".$row["last_name"]; ?>    <span class="em">Phone number: </span> <?php echo $row["phone_number"]; ?><    <span class="em">   Email address: </span>  <?php echo $row["email_address"]; ?> 
               <span class="em">   Family members: <?php echo $row["family_members"]; ?> </span></pre>
			<br> -->

            <pre> <img src="images/user.png" alt="user" style="width:20px;height:20px;">  Siham Khalid  <img src="images/phone.png" alt="phone" style="width:20px;height:20px;"> 0550167978  <img src="images/email.png" alt="email" style="width:20px;height:20px;">Siham@gmail.com</pre>
			<br>
				

                
                <table>
                <span class="title">
				<h2> Requested Homes </h2>  <br>
                </span>

                    <tr>
                        <th>Property Name</th>
                        <th>Category</th>
                        <th>Rent</th>
                        <th>Status</th>
                    		
                     </tr>
                    <?php 
                    while($row3=mysqli_fetch_array($result3)){
                    ?>
                    <tr>
                        <td>
                            <a class="hover-underline" href="propertyDetails.php?id=<?php echo $row3['id'];?>"> 
                            <?php echo $row3["name"]; ?>  
                            </a>
                        </td>
                        <td>
                            <?php 
                            if ($row3["property_category_id"]==1) 
                                echo "Villa";
                            else
                                echo "Apartment"; 
                            ?>
                        </td>
                        <td> <?php echo $row3["rent_cost"]."/month"; ?> </td>
                        <td> 
                            <?php 
                            switch($row3["application_status_id"]){
                                case 1: echo "Accepted"; break;
                                case 2: echo "Under consideration"; break;
                                case 3: echo "Declined"; break;
                            }
                            ?> 
                        </td>
                    </tr>
                    <?php } ?>
                      
                </table><br>
                

<br><br >
                <div class="sort">
                    <br>
                    <select name="Catsort" id="Catsort">
                      <option value="" disabled selected> Search by Category: </option>
                            <?php    
                            while ($row4 = mysqli_fetch_array($result4)) {
                                echo "<option value=".$row4['id'].">".$row4['category']."</option>";
                            }
                            ?>
                    </select>
                    <button id="btn1"> Search </button> 
                </div>

                <table id="dynamicContent">
                    <span class="title">
                    <h2> Homes for Rent </h2> 
                    </span>
                    
                        <tr>
                            <th>Property Name</th>
                            <th>Category</th>
                            <th>Rent</th>
                            <th>Rooms</th>
                            <th>Location</th>
                        </tr>
                        
                        <?php 
                    while($row2=mysqli_fetch_array($result2)){
                    ?>
                    
                    <tr id="<?php echo $row2['id'];?>">
                        <td>
                            <a class="hover-underline" href="propertyDetails.php?id=<?php echo $row2['id'];?>"> 
                            <?php echo $row2["name"]; ?>  
                            </a>
                        </td>
                        <td> 
                            <?php 
                            if ($row2["property_category_id"]==1) 
                                echo "Apartment";
                            else
                                echo "Villa"; 
                            ?> 
                        </td>
                        <td> <?php echo $row2["rent_cost"]."/month"; ?> </td>
                        <td> <?php echo $row2["rooms"];?> </td>
                        <td> <?php echo $row2["location"]; ?> </td>
                        <td><a class="hover-underline" onClick='<?php echo "apply(".$row2['id'].")";?>'>Apply</a></td>
                    </tr>
                   
                    <?php } ?>
                </table>
            </div>
			
		
        </main>
           <br><br>
        <footer class="foo">  
            <p class="copyright">Copyright &copy; 2023 <a href="index.html">Housing Anywhere</a> All rights reserved.
			</p>
        </footer>
</body 
</div>
</html>

