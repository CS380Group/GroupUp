<?php
    // This is the php script that will retrieve events from the database that match a certain criteria

    // TODO: Make this experience better visually.

    // TODO: Database connection can be extracted into a single file

    // Database connection information. Will be different once database is on server
    $dbhost = 'localhost';
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

    // Get category for query
    $city = $_GET['city'];
    // Debug message
    // echo $category;

    // Execute query
    // TODO: Add Error Handling especially for even that query returns null
    $query = "SELECT * FROM event WHERE userCity='$city'";
    $result = mysqli_query($conn, $query);
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Debug message
    // echo "JSON: ";

    // Return the contents of the query as a JSON Object
    echo json_encode($rows);

?>
