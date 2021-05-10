<?php
    // Database connection information. Will be different once database is on server
    $dbhost = 'localhost:3306';
    $dbuser = 'root';
    $dbpass = '123';
    $db = 'GroupUp';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);

    // Checks if the connection to the database is successful
    if(! $conn ) {
        die('Could not connect: ' . mysql_error());
    }
    
    // Debug message
    // echo "Connected successfully.";
?>