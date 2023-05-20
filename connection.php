
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $host = "localhost";
        $database = "project_database";
        $user = "root";
        $pass = "root"; 
        
        $connection = mysqli_connect($host , $user , $pass , $database); 
        
        $error = mysqli_connect_error();
        if ( $error != null) { 
            $output = "Can not connect to the database" . $error; 
            die ( mysqli_connect_errno()) ;
        }
            
                
        ?>
    </body>
</html>
