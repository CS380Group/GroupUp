<?php
    // This script inserts a user/event mapping to the userJoinEvent table in the database

    // Include necessary dunctions
    include 'connectToDatabase.php';
    include 'redirectToLastPage.php';

    // Check if submit button was pressed
    if (isset($_POST['submit'])) {
        session_start();
        // Connect to database
        $conn = connectToDatabase();

        $userName = $_SESSION['userName'];
        $eventId = $_POST['event'];

        $userId = getUserId($userName);

        // Prepare SQL query
        $stmt = $conn->prepare("INSERT INTO userJoinEvent (userId, eventId) VALUES (?, ?)");
        if ($stmt == false) {
            echo "Error: Something went wrong when preparing the user join event query.";
            displayRedirect();
            die();
        }

        // Bind params to SQL query
        $stmt->bind_param('ss', $userId, $eventId);
        if ($stmt == false) {
            echo "Error: Something went wrong when binding parameters to the user join event query.";
            displayRedirect();
            die();
        }

        // Execute query
        $stmt->execute();
        if ($stmt == false) {
            echo "Error: Something went wrong when executing the user join event query.";
            displayRedirect();
            die();
        }

        // TODO : Get the event name instead of the eventId
        echo "$userName joined eventId $eventId successfully!";
        displayRedirect();
        die;
    }
    

    function getUserId($userName) {

        // connect to database
        $conn = connectToDatabase();

        // Prepare query
        $stmt = $conn->prepare("SELECT userId FROM user WHERE emailAddress=?");
        if ($stmt == false) {
            echo "Error: something went wrong when preparing the get userId query.";
            displayRedirect();
            die;
        }

        // Bind query
        $stmt->bind_param('s', $userName);
        if ($stmt == false) {
            echo "Error: something went wrong when binding the parameters for the get userId query";
            displayRedirect();
            die;
        }

        // Execute query
        $stmt->execute();
        if ($stmt == false) {
            echo "Error: Something went wrong when executing the query.";
            displayRedirect();
            die;
        }

        // Get results
        $result = $stmt->get_result();
        if ($result == false || $stmt == false) {
            echo "Error: Something went wrong when retrieving the results of the get userId query.";
            displayRedirect();
            die;
        }
        
        // Get results as an associative array
        $row = mysqli_fetch_all($result, MYSQLI_ASSOC);

        // Check if there was more than one row
        if (mysqli_num_rows($result) > 1) {
            echo "Error: More than one user found with the same email, please check the database.";
            displayRedirect();
            die;
        }

        // Return the userId
        return $row['userId'];
    }



?>