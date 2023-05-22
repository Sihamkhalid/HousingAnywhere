<!DOCTYPE html>
<html>

<?php
if (!isset($_SESSION)) session_start();
if (!isset($_SESSION['id'])) {
    echo "<script>
        alert('You must login to view the page!');
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
    <style>
        html {
            background: rgba(169, 169, 181, 0.151) 100%;
        }

        header {
            background: linear-gradient(to bottom,
                    rgb(155, 155, 167) 0%,
                    rgba(155, 155, 167, 0.879) 39%,
                    rgba(155, 155, 167, 0.868) 40%,
                    rgba(155, 155, 167, 0.728) 56%,
                    rgba(155, 155, 167, 0.731) 60%,

                    rgba(155, 155, 167, 0.452) 80%,
                    rgba(155, 155, 167, 0.432) 81%,
                    rgba(155, 155, 167, 0.237) 90%,
                    rgba(155, 155, 167, 0.199) 91%,
                    rgba(169, 169, 181, 0.178) 95%,
                    rgba(169, 169, 181, 0.121) 98%,
                    rgba(169, 169, 181, 0.048) 100%);
        }


        h1 {
            color: rgb(51, 51, 68);
        }

        h3 {
            width: 35%;
            background-image: url("images/gb.jpg");
            border-radius: 6px;
            text-align: center;
            color: rgb(30, 30, 54);
            text-transform: uppercase;
            color: #374255;
            font-family: Georgia, 'Times New Roman', Times, serif;
        }

        .logO {
            float: right;
            color: #143ba8;
            text-decoration: none;
        }

        .topnav {
            background-color: linear-gradient(to bottom, rgb(155, 155, 167) 0%, rgba(155, 155, 167, 0.879) 39%, rgba(155, 155, 167, 0.868) 40%, rgba(155, 155, 167, 0.728) 56%, rgba(155, 155, 167, 0.731) 60%, rgba(155, 155, 167, 0.452) 80%, rgba(155, 155, 167, 0.432) 81%, rgba(155, 155, 167, 0.237) 90%, rgba(155, 155, 167, 0.199) 91%, rgba(169, 169, 181, 0.178) 95%, rgba(169, 169, 181, 0.121) 98%, rgba(169, 169, 181, 0.048) 100%);
            overflow: hidden;

        }

        .topnav a {
            float: right;
            color: white;
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

        .topnav .heCol a {
            Color: #002244;
            ;
        }

        .main {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            min-width: 100%;
        }

        li p {
            font-size: 1.1rem;
        }

        li p em {
            font-weight: 900;
            text-shadow: #374255;
        }

        .gallery {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            justify-content: center;
        }

        .gallery img {
            border-radius: 1rem;
            margin: 1rem;
            /* border: 1px solid #374255;  */
            box-shadow: 1px 1px 3px black;
            max-height: 25rem;
        }

        footer {
            text-align: center;
            display: flex;
            align-items: center;
            height: 10vh;
            margin: auto auto;
            background: linear-gradient(to bottom,
                    rgba(169, 169, 181, 0.048) 0%,
                    rgba(169, 169, 181, 0.121) 10%,
                    rgba(155, 155, 167, 0.432) 30%,
                    rgb(155, 155, 167) 100%);
        }

        .copyright {
            position: relative;
            width: 420px;
            margin: 0 auto;
            text-align: center;
            color: #374255;
            line-height: 30px;
        }

        .copyright a {
            color: #374255;
        }

        .copyright a:hover {
            color: #5773a4;
        }
    </style>
    <title>Housing Any Where | PropertyDetails</title>

</head>

<body>
    <div class="prop">
        <header>
            <div class="logo">
                <img src="images/logo.png" alt="Logo" width="150px" />
            </div>
            <div class="topnav">
                <a class="active" href="index.html">Log Out</a>
                <div class="heCol">
                    <a href="homeowner.html">Homeowner page</a>
                    <a href="Homeseekerpage.html">Homeseeker page</a>
                </div>
            </div>

        </header>
        
        <main class='main'>
            <h1> <?php echo $prop['name'] ?> </h1>
            <div class="check">
                <?php
                if ($_SESSION['role'] == 'owner')
                    echo "<a class='colorA' href='Editpropertypage.php?id={$_GET['id']}'><h3>Edit</h3></a>";
                else{

                    $query = mysqli_query($con, "SELECT * FROM rentalapplication
                    WHERE property_id = {$prop['p_id']}
                    AND home_seeker_id = {$_SESSION['id']}");
                    
                    if(mysqli_num_rows($query) == 0)
                    echo "<a class='colorA' href='server.php?apply={$_GET['id']}'><h3>Apply</h3></a>";
                    else echo "<a class='colorA'><h3>Applied</h3></a>";

                }
                ?>
            </div>
            <h3> Property Information</h3>
            <div class="Proinfo">
                <ul>
                    <li>
                        <p> <em>Property Name:</em> <?php echo $prop['name'] ?> </p>
                    </li>
                    <li>
                        <p> <em>Category:</em> <?php echo $prop['category'] ?> </p>
                    </li>
                    <li>
                        <p> <em>Number Of Rooms:</em> <?php echo $prop['rooms'] ?> </p>
                    </li>
                    <li>
                        <p> <em>Rent:</em> <?php echo $prop['rent_cost'] ?>/month </p>
                    </li>
                    <li>
                        <p> <em>Location:</em> <?php echo $prop['location'] ?> </p>
                    </li>
                    <li>
                        <p> <em>Max Number Of Tenants:</em> <?php echo $prop['max_tenants'] ?> </p>
                    </li>
                    <li>
                        <p> <em>Description:</em> <?php echo $prop['description'] ?> </p>
                    </li>
                </ul>
            </div>

            <br>
            <h3>property image</h3>

            <div class='gallery'>
                <?php
                $images = getPropertyImages($prop['p_id']);
                if (count($images) == 0) echo "<p>No images available!</p>";
                foreach ($images as $img) {
                    echo "<img src='{$img['path']}'>";
                }
                ?>
            </div>

        </main>
    </div>

    <br><br><br>

    <footer>
        <p class="copyright">Copyright &copy; 2023 <a href="index.html">Housing Anywhere</a> All rights reserved.</p>
    </footer>
</body>

</html>
