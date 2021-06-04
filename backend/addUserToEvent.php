<?php
    // This script inserts a user/event mapping to the userJoinEvent table in the database

    // Include necessary dunctions
    include 'connectToDatabase.php';
    include 'redirectToLastPage.php';
    include 'getUserId.php';

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

        // Close the connection
        $stmt->close();

        // Close the connection to the database
        mysqli_close($conn);

        // TODO : Get the event name instead of the eventId
        echo "$userName joined eventId $eventId successfully!";
        
    } else {
        echo "Something went wrong. Please try again.";
    }

    displayRedirect();
    die;
?>