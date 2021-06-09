<?php

    // This script gets a list of events that the current user has joined.

    // Include required functions
    include 'connectToDatabase.php';
    include 'redirectToLastPage.php';
    include 'getUserIdFromEmail.php';

    // Connect to database.
    $conn = connectToDatabase();

    // Get username
    if (isset($_SESSION['username'])) {

        $userName = $_SESSION['username'];
        
        // Get user id
        $userId = getUserId($userName);

        // Prepare sql query
        $stmt = $conn->prepare("SELECT eventId FROM userJoinEvent WHERE userId=?");
        if ($stmt == false) {
            echo "Something went wrong while preparing the get joined events query. Please try again.";
            displayRedirect();
            die;
        }

        // Bind parameters
        $stmt->bind_param('s', $userId);
        if ($stmt == false) {
            echo "Something went wrong while binding the params to the get joined events query. Please try again.";
            displayRedirect();
            die;
        }

        // Execute the query
        $stmt->execute();
        if ($stmt == false) {
            echo "Something went wrong while executing the get joined events query. Please try again.";
            displayRedirect();
            die;
        }

        // Get results
        $results = $stmt->get_result();
        if ($stmt == false) {
            echo "Error: Something went wrong while getting results from the get events by city statement.";
            displayRedirect();
            die();
        }

        // Close the connection
        $stmt->close();
        $conn->close();
        
        $rows = mysqli_fetch_all($results, MYSQLI_ASSOC);

        echo json_encode($rows);

    } else {
        echo "Please sign in before trying to view joined events.";
        displayRedirect();
        die;
    }
?>