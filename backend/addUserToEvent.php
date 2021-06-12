<?php
    // This script inserts a user/event mapping to the userJoinEvent table in the database

    // Include necessary dunctions
    include 'connectToDatabase.php';
    include 'redirectToLastPage.php';
    include 'getUserIdFromEmail.php';

    // Check if join event was pressed
    session_start();
    if (isset($_POST['joinEvent'])) {

        // Connect to database
        $conn = connectToDatabase();

        $userName = $_SESSION['username'];
        $eventId = $_POST['eventId'];

        $userId = getUserId($userName);

        // Check if the user has already joined this event
        if (isUserJoined($userId, $eventId, $conn)) {
            echo "User " . $userName . " has already joined event " . $eventId;
            displayRedirect();
            die;
        }

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
    } else {
        echo "Please sign in before attempting to join an event.";
        displayRedirect();
        die;
    }
    
    function isUserJoined($userId, $eventId, $conn) {
        $stmt = $conn->prepare("SELECT * FROM userJoinEvent WHERE userid=? AND eventId=?");
        if ($stmt == false) {
            echo "Error: Something went wrong when preparing the has user joined event query.";
            displayRedirect();
            die();
        }
        
        $stmt->bind_param('ss', $userId, $eventId);
        if ($stmt == false) {
            echo "Error: Something went wrong when binding params to the has user joined event query.";
            displayRedirect();
            die();
        }

        $stmt->execute();
        if ($stmt == false) {
            echo "Error: Something went wrong when executing the has user joined event query.";
            displayRedirect();
            die();
        }

        $result = $stmt->get_result();
        $stmt->close();

        return mysqli_num_rows($result) > 0;
    }
?>