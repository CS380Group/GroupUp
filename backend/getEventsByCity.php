<?php
    // This is the php script that will retrieve events from the database that match a certain criteria

    // TODO: Make this experience better visually.

    // TODO: Database connection can be extracted into a single file

    // Connect to database
    include 'connectToDatabase.php';

    // Connect to the database
    $conn = connectToDatabase();
    
    // Get city for query
    $city = $_GET['city'];

    // Prepare query for finding events by city
    $stmt = $conn->prepare("SELECT * FROM event WHERE eventCity=?");
    if ($stmt == false) {
        echo "Error: Something went wrong while preparing the get events by city statement.";
        displayRedirect();
        die();
    }

    // Bind the variables involved with the query
    $stmt->bind_param('s', $city);
    if ($stmt == false) {
        echo "Error: Something went wrong while binding parameters for the get events by city statement.";
        displayRedirect();
        die();
    }

    // Execute the query
    // TODO: Add Error Handling especially for even that query returns null
    $stmt->execute();
    if ($stmt == false) {
        echo "Error: Something went wrong while executing the get events by city statement.";
        displayRedirect();
        die();
    }

    // Get the results
    $result = $stmt->get_result();
    if ($stmt == false) {
        echo "Error: Something went wrong while getting results from the get events by city statement.";
        displayRedirect();
        die();
    }

    $stmt->close();

    // Get all rows that matched the query, in associative array form
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Return the contents of the query as a JSON Object
    echo json_encode($rows);
?>
