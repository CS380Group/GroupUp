<?php

    // Include necessary functions
    include 'connectToDatabase.php';
    include 'redirectToLastPage.php';
    include 'getUserId.php';

    // Connect to database.
    $conn = connectToDatabase();

    $userId = getUserId($_SESSION['userName']);

    // Prepare query.
    $stmt = $conn->prepare("SELECT * FROM directMessage WHERE messageRecipient=?");
    if ($stmt == false) {
        echo "Error: Something went wrong when preparing the get message query";
        displayRedirect();
        die;
    }

    // Bind parameters.
    $stmt->bind_param('s', $userId);
    if ($stmt == false) {
        echo "Error: Something went wrong when binding parameters for the get message query";
        displayRedirect();
        die;
    }

    // Execute query.
    $stmt->execute();
    if ($stmt == false) {
        echo "Error: Something went wrong when preparing the get message query";
        displayRedirect();
        die;
    }

    $result = $stmt->get_result();
    if ($stmt == false) {
        echo "Error: Something went wrong when retrieving the result of the get message query";
        displayRedirect();
        die;
    }

    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

    echo json_encode($rows);
?>