<!-- This is the php script that will add a new event's data to our database -->

<?php

    // TODO: Make this experience better for the user

    // Database connection information. Will be different once database is on server
    $dbhost = 'localhost';
    $dbuser = 'root';
    $dbpass = 'star trek fan';
    $db = 'groupUp';
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db);

    // Checks if the connection to the database is successful
    if(! $conn ) {
        die('Could not connect: ' . mysql_error());
    }
    
    // Debug message
    echo "Connected successfully\n";

    // Checks if the submit button has been pressed
    if(isset($_POST['submit'])) {

        //We need userName, userTitle, userAddress, userCity, userState

        $userName = $_POST['userName'];
        $userTitle = $_POST['userTitle'];
        $userAddress = $_POST['userAddress'];
        $userCity = $_POST['userCity'];
        $state = $_POST['state'];

        // Debug message
        // echo "username = $userName, userTitle = $userTitle, userAddress = $userAddress, userCity = $userCity, state = $state";

        // Stores the sql query to be executed
        $query = "INSERT INTO event (userName, userTitle, userAddress, userCity, userState) 
            VALUES ('$userName', '$userTitle', '$userAddress', '$userCity', '$state')";

        // Execute the query and inform the user if it was successfull
        if (!mysqli_query($conn, $query)) {
            die('An error occurred when submitting the event!');
        } else {
            echo "Event submitted successfully!";
        }
    }

    // Close the connection to the database
    mysqli_close($conn);

    // This will provide the user with a link that will take them to the previous page. Can be changed later.
    $referer = filter_var($_SERVER['HTTP_REFERER'], FILTER_VALIDATE_URL);

    // Handles whether the redirect will be php or javascript
    if (!empty($referer)) {
        echo '<p><a href="'. $referer .'" title="Return to the previous page">&laquo; Go back</a></p>';
    } else {
        echo '<p><a href="javascript:history.go(-1)" title="Return to the previous page">&laquo; Go back</a></p>';
    }

    die();

?>