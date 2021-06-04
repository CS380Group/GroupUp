<!-- This is the php script that will add a new event's data to our database -->

<?php

    // TODO: Split into functions to make more readable

    // TODO: Make this experience better visually.
  
    // Include database connect function
    include 'connectToDatabase.php';

    // Include geocode function
    include 'geocodePosition.php';

    // Include redirect function
    include 'redirectToLastPage.php';

    // Checks if the submit button has been pressed
    if(isset($_POST['submit'])) {

        session_start();

        // Connect to database
        // TODO : exception checking
        $conn = connectToDatabase();

        // Get current date
        $dateOfCreation = date('Ymd H:i:s');

        // Prepare event variables
        $userName = $_SESSION['username'];
        $eventTitle = $_POST['userTitle'];
        $eventType = $_POST['userType'];
        $eventDescription = $_POST['userDescription'];
        $eventPhone = $_POST['userPhone'];
        $eventPhone = preg_replace('/[^0-9]/', '', $eventPhone);
        $eventAddress = $_POST['userAddress'];
        $eventCity = $_POST['userCity'];
        $eventState = $_POST['userState'];

        // Prepare query to get userId from user's email
        $stmt = $conn->prepare("SELECT userId FROM user WHERE emailAddress=?");
        // Check for errors
        if ($stmt == false) {
            echo "Something went wrong when preparing the get userId statement. Please try again.";
            displayRedirect();
            die();
        }
        
        // Bind parameters for query
        $stmt->bind_param('s', $userName);
        // Check for errors
        if ($stmt == false) {
            echo "Something went wrong when binding paramerters of the get userId statement. Please try again.";
            displayRedirect();
            die();
        }

        // Execute the query
        $stmt->execute();
        // Check for errors
        if ($stmt == false) {
            echo "Something went wrong when executing the get userId statement. Please try again.";
            displayRedirect();
            die();
        }

        // Get the results of the query
        $result = $stmt->get_result();
        // Check for errors
        if ($stmt == false) {
            echo "Something went wrong when getting the result from the get userId statement. Please try again.";
            displayRedirect();
            die();
        }

        // Close the connection
        $stmt->close();

        // If the number of entries is 0, the user does not exist in the database.
        if (mysqli_num_rows($result) == 0) {
            echo "Error: Please make sure you're signed in before submitting an event.";
            displayRedirect();
            die();
        }

        // If the number of users returned is larger than one, something is wrong with the database
        if (mysqli_num_rows($result) > 1) {
            echo "Error: Something went wrong with the database! Duplicate email addresses aren't allowed!";
            displayRedirect();
            die();
        }

        // Get the userId of the email address
        $row = mysqli_fetch_assoc($result);
        $userId = $row['userId'];
   
        // Geocode address to get lat/long
        $eventAddress = $eventAddress . $eventCity . $eventState;
        $geoCode = geocode($eventAddress);
        if (!$geoCode) {
            echo "Error: Something went wrong during the geocode.";
            displayRedirect();
            die();    
        }

        // Extract location data from geocode
        $latitude = $geoCode[0];
        $longitude = $geoCode[1];
        $location = explode(',', $geoCode[2]);
        $street = $location[0];
        $city = $location[1];
        $city = preg_replace('/[^A-Za-z]/', '', $city);
        $stateZip = explode(' ', $location[2]);
        $state = $stateZip[1];
        $zip = $stateZip[2];
        $country = $location[3];
        $country = preg_replace('/[^A-Za-z]/', '', $country);

        // Temp variables
        $startDate = date('Y-m-d H:i:s');
        $endDate = date('Y-m-d H:i:s'); 

        // Prepare the insert event statement
        $stmt = $conn->prepare(
            "INSERT INTO event (
                userId, 
                eventTitle, 
                eventType, 
                eventDescription, 
                eventPhone, 
                eventStreet, 
                eventCity, 
                eventState, 
                eventZip, 
                eventCountry, 
                latitude, 
                longitude,
                startDate,
                endDate
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        if ($stmt == false) {
            echo "Something went wrong while preparing the query. Please try again.";
            displayRedirect();
            die();
        }
        
        // Bind the parameters for the insert event statement
        $stmt->bind_param('ssssssssssssss', $userId, $eventTitle, $eventType, $eventDescription, $eventPhone, $street, $city, $state, $zip, $country, $latitude, $longitude, $startDate, $endDate);
        if ($stmt == false) {
            echo "Something went wrong while binding parameters to the query. Please try again.";
            displayRedirect();
            die();
        }

        // Execute the insert event statement
        $stmt->execute();
        if ($stmt == false) {
            echo "Something went wrong while executing the query. Please try again.";
            displayRedirect();
            die();
        } else {
            echo "Event submitted successfully.";
        }


        // Close the connection
        $stmt->close();

        // Close the connection to the database
        mysqli_close($conn);
    } else {
        echo "Something went wrong :(";
    }

    displayRedirect();
    die;
?>