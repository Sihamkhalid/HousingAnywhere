<!DOCTYPE html>
<html>
<?php
if (!isset($_SESSION)) session_start();
if (!isset($_SESSION['id']) ) {
    echo "<script>
      alert('You must login as owner to view this page!');
      window.location.href='/web-pro/login.php';
    </script>";
}

if (!isset($_GET['id'])) {
    echo "<script>
        alert('No Property id was provided!');
        window.location.href='/web-pro/index.php';
    </script>";
}
include("server.php");
$prop = getProperty($_GET['id']);

?>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="editprop.css">
  <title>Housing Any Where | EditProperty</title>
</head>
<style>
  .gallery {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
    width: 100vw;
    margin: 0;
  }
  
  .gallery div {
    border-radius: 1rem;
    margin: 1rem;
  }

  .propimg {
    border-radius: 1rem;
    padding: 1rem;
    border: 1px solid darkgrey;
    /* box-shadow: 1px 1px 10px black; */
    /* height: 20rem; */
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    transition: 1s ease-in-out;
    overflow: hidden;
    transition: .3s ease-in-out;
  }

  .propimg:hover {
    background-color: #e0e0e0;
  }

  .propimg div {
    overflow: hidden;
  }

  .propimg img {
    border-radius: 0.5rem;
    max-height: 20rem;
    -webkit-transform: scale(1);
    transform: scale(1);
    -webkit-transition: .3s ease-in-out;
    transition: .3s ease-in-out;
  }

  .propimg:hover img {
    -webkit-transform: scale(1.1);
    transform: scale(1.15);
  }
  
  .propimg a {
    text-decoration: none;
    padding: 0.3rem 2rem;
    border-radius: .3rem;
    border: 1px solid darkgray;
    font-weight: 700;
    color : darkslategray
  }
  .propimg a:hover {
    background-color:mintcream;
  }

</style>
<body>
  <header>
    <div class="logo">
      <img src="images/logo.png" alt="Logo" width="150px" />
    </div>
    <div class="topnav">
      <a class="active" href="index.html">Log Out</a>
      <div class="heCol">
        <a href="PropertyDetailsPage.php?id=<?php echo $prop['p_id']?>">Property deatils </a>
      </div>
    </div>

  </header>
  <h1><?php echo $prop['name'] ?></h1>
  <main>
    <form action="server.php" method="post" id="formP" name="myForm">

      <fieldset class="Property">
        <legend>Property Information</legend>
        <br />
        <label><span>Property Name:</span></label>
        <input required type="text" id="Pname" name="Name" value="<?php echo $prop['name'] ?>"/>
        <br /><br />

        <label for="category"><span>Category:</span></label>
        <select name="category">
          <?php
            $query = mysqli_query($con, "SELECT * from propertycategory");
            $cats = mysqli_fetch_all($query, MYSQLI_ASSOC);
            foreach($cats as $cat)
              if($cat['category'] != $prop['category']) echo "<option value={$cat['pc_id']}>{$cat['category']}</option>";
              else echo "<option selected value={$cat['pc_id']}>{$cat['category']}</option>";
          ?>
        </select>
        <br /><br />


        <label for="rooms"><span>Number Of Rooms:</span></label>
        <input required type="number" id="nor" name="rooms" value="<?php echo $prop['rooms'] ?>" />
        <br /><br />

        <label for="prent"><span>Rent (per month):</span></label>
        <input required type="number" id="prent" name="rent" value="<?php echo $prop['rent_cost'] ?>" />
        <br /><br />

        <label for="add"><span>Location:</span></label>
        <input required type="text" id="add" name="plocation" value="<?php echo $prop['location'] ?>" />
        <br /><br />

        <label for="mnot"><span>Max Number Of Tenants:</span></label>
        <input required type="number" id="mnot" name="Pmnot" value="<?php echo $prop['max_tenants'] ?>" />
        <br /><br />

        <label for="des"><span>Description:</span></label> <br />
        <textarea id="des" name="desc" rows="6" cols="64"><?php echo $prop['description'] ?></textarea>
        
        <br /><br />
        <input hidden name='id' value=<?php echo $prop['p_id']?> >
        <input required type="submit" name="editprop" value="Save" style="padding:1rem; background-color:rgb(51, 51, 68); color:white; border-radius:.5rem">
        <br /><br />

      </fieldset>
  
  
    </form>
    <br />
    <div class="editCon" style="flex-direction: column;">
      <Span class="word">Properity images:</Span>
      <br>
      <div class="upl">
        <br><br>
        <form action="server.php" method="POST" enctype="multipart/form-data" id="imgForm">
          <label>Upload Images</label>
          <input type="file" name="images[]" accept="image/*" 
          multiple onchange="document.getElementById('imgForm').submit();">
          <input hidden name="addImages" value="<?php echo $prop['p_id']?>">
        </form>
      </div>
      <br>
      <div class="flex-container" style="margin:0; width:100vw;">
        <div class="imo-container gallery">
          <?php 
            $images = getPropertyImages($prop['p_id']);
            foreach($images as $img){
              echo"
              <div class='propimg' style='min-width: 30vw;'>
                <div>
                  <img src=\"{$img['path']}\" alt='HouseDetails' class='imgHouse' />
                </div>
                <br>
                <a href='server.php?delimg={$img['pi_id']}&prop={$prop['p_id']}' class='delet'>Delete</a>
              </div>
              ";
            }
          ?>
        </div>
      </div>
      <br>
    </div>
    <br><br>
  
  </main>
  <br /><br />



  <footer>
    <p class="copyright">Copyright &copy; 2023 <a href="index.html">Housing Anywhere</a> All rights reserved.
    </p>
  </footer>

</body>

</html>
