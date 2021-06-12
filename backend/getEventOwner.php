<?php

    // Gets the userId of the passed in username

    function getEventOwnerId($eventId) {

        // connect to database
        $conn = connectToDatabase();

        // Prepare query
        $stmt = $conn->prepare("SELECT userId FROM event WHERE eventId=?");
        if ($stmt == false) {
            echo "Error: something went wrong when preparing the get eventId query.";
            displayRedirect();
            die;
        }

        // Bind query
        $stmt->bind_param('s', $eventId);
        if ($stmt == false) {
            echo "Error: something went wrong when binding the parameters for the get eventId query";
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
            echo "Error: Something went wrong when retrieving the results of the get eventId query.";
            displayRedirect();
            die;
        }

        $stmt->close();
        
        // Check if there was more than one row
        if (mysqli_num_rows($result) != 1) {
            echo "Error: More than one user found with the same event, please check the database.";
            displayRedirect();
            die;
        }

        // Get results as an associative array
        $row = mysqli_fetch_all($result, MYSQLI_ASSOC);

        // Return the userId
        return $row[0]['userId'];
    }

?>