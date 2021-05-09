<!-- This is the php script that will add a new event's data to our database -->

<?php

    // TODO: Make this experience better visually.
  
    // Connect to database
    include 'connectToDatabase.php';

    // Checks if the submit button has been pressed
    if(isset($_POST['submit'])) {

        //We need userName, userTitle, userType, userDescription, userPhone, userAddress, userCity, userState

        $userName = $_POST['userName'];
        $userTitle = $_POST['userTitle'];
        $userType = $_POST['userType'];
        $userDescription = $_POST['userDescription'];
        $userPhone = $_POST['userPhone'];
        $userPhone = preg_replace('/[^0-9]/', '', $userPhone);
        $userAddress = $_POST['userAddress'];
        $userCity = $_POST['userCity'];
        $userState = $_POST['userState'];

        // Stores the sql query to be executed
        $query = "INSERT INTO event (userName, userTitle, userType, userDescription, userPhone, userAddress, userCity, userState) 
            VALUES ('$userName', '$userTitle', '$userType', '$userDescription', '$userPhone', '$userAddress', '$userCity', '$userState')";

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