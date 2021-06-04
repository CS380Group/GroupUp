<?php

    // This script addes a message to the message database

    // Include necessary functions
    include 'connectToDatabase.php';
    include 'redirectToLastPage.php';
    include 'getUserId.php';

    if (isset($_SESSION['submit'])) {
        
        // Connect to database
        $conn = connectToDatabase();
        
        // Get message information
        $messageSender = getUserId($_SESSION['userName']);
        $messageRecipient = getUserId($_POST['messageRecipient']);
        $messageContents = $_POST['messageContents'];

        // Get current date
        $joinDate = date('Y-m-d H:i:s');

        // Prepare query
        $stmt = $conn->prepare("INSERT INTO directMessage (messageSendDate, messageSender, messageRecipient, messageContents)
                                VALUES ('?', '?', '?', '?')");
        if ($stmt == false) {
            echo "Error: Something went wrong when preparing the add message query.";
            displayRedirect();
            die;
        }        
        // Bind parameters
        $stmt->bind_param('ssss', $joinDate, $messageSender, $messageRecipient, $messageContents);
        if ($stmt == false) {
            echo "Error: Something went wrong when binding parameters for the add message query.";
            displayRedirect();
            die;
        }        

        // Execute query
        $stmt->execute();
        if ($stmt == false) {
            echo "Error: Something went wrong when executing the add message query.";
            displayRedirect();
            die;
        }

        // Close the connection
        $stmt->close();

        // Close the connection to the database
        mysqli_close($conn);
        
        echo "Message submitted successfully!";
    } else {
        echo "Something went wrong. Please try again.";
    }

    displayRedirect();
    die;
?>