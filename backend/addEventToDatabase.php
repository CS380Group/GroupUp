<!-- This is the php script that will add a new event's data to our database -->

<?php

    // TODO: Make this experience better visually.
  
    // Connect to database
    include 'connectToDatabase.php';

    // Include geocode funtion
    include 'geocodePosition.php';

    // Checks if the submit button has been pressed
    if(isset($_POST['submit'])) {

        //We need userName, userTitle, userType, userDescription, userPhone, userAddress, userCity, userState

        $userName = $_POST['userName'];
        $eventTitle = $_POST['userTitle'];
        $eventType = $_POST['userType'];
        $eventDescription = $_POST['userDescription'];
        $userPhone = $_POST['userPhone'];
        $userPhone = preg_replace('/[^0-9]/', '', $userPhone);
        $eventAddress = $_POST['userAddress'];
        $eventCity = $_POST['userCity'];
        $eventState = $_POST['userState'];

        // Geocode address to get lat/long
        $eventAddress = $eventAddress . $eventCity . $eventState;
        $geoCode = geocode($eventAddress);
        if (!$geoCode) {
            die("geocode failed");    
        }
        print_r($geoCode);

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

        // Stores the sql query to be executed
        $query = "INSERT INTO event (userName, eventTitle, eventType, eventDescription, userPhone, eventStreet, eventCity, eventState, eventZip, eventCountry, latitude, longitude) 
            VALUES ('$userName', '$eventTitle', '$eventType', '$eventDescription', '$userPhone', '$street', '$city', '$state', '$zip', '$country', '$latitude', '$longitude')";

        // Execute the query and inform the user if it was successfull
        if (!mysqli_query($conn, $query)) {
            echo('An error occurred when submitting the event!');
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