<?php

    // This code checks if a user exists in the database with the supplied password, then logs the user in or informs them that 
    // the user does not exists or used the wrong password. 

    // TODO : make sure to account for SQL injection!

   // Include database connect function
   include 'connectToDatabase.php';

   // Include geocode function
   include 'geocodePosition.php';

   // Include redirect function
   include 'redirectToLastPage.php';

   // Checks if the submit button has been pressed
   if(isset($_POST['submit'])) {
        
        // Connect to database
        $conn = connectToDatabase();

        // Get login credentials
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Prepare the database query to log the user in
        // TODO: Need to do some password hashing magic
        $stmt = $conn->prepare("SELECT * FROM user WHERE emailAddress=? AND password=PASSWORD(?)");
        // Check for errors
        if ($stmt == false) {
            displayRedirect();
            die("Something went wrong when preparing the login statement. Please try again.");
        }

        $stmt->bind_param('ss', $email, $password);
        // Check for errors
        if ($stmt == false) {
            displayRedirect();
            die("Something went wrong when binding the login statement. Please try again.");
        }

        // Execute query
        $stmt->execute();
        // Check for errors
        if ($stmt == false) {
            displayRedirect();
            die("Something went wrong when executing the login statement. Please try again.");
        }

        // Get results of the query
        $result = $stmt->get_result();

        // Close stmt
        $stmt->close();

        // Check that user exists in database
        if (mysqli_num_rows($result) == 0) {
            echo "Error: Either the user does not exist, or the password was entered incorrectly. Please try again.";
            displayRedirect();
            die();
        }

        // Establish session variables
        $_SESSION['key'] = session_start();
        $_SESSION['valid'] = true;
        $_SESSION['timeout'] = time();
        $_SESSION['username'] = $email;

        // Debug
        echo "User " . $_SESSION['username'] . " is now logged in!";

        displayRedirect();
   }


?>