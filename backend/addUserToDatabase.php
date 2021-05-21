<?php

    // This code will check if an email address exists in the user table, then add it if it does not

    // Include connect to database function
    include 'connectToDatabase.php';

    // Include redirect function
    include 'redirectToLastPage.php';

    // Checks if the submit button has been pressed
    if(isset($_POST['submit'])) {

        // Connect to database 
        $conn = connectToDatabase();

        // Get current date
        $dateOfCreation = date('Y-m-d');

        // Prepare user variables
        $emailAddress = $_POST['userEmail'];
        $password = $_POST['userPassword'];
        $firstName = $_POST['userFirstName'];
        $lastName = $_POST['userLastName'];
        $phoneNumber = $_POST['userPhone'];
        $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);
        $streetAddress = $_POST['userAddress'];
        $cityAddress = $_POST['userCity'];
        $stateAddress = $_POST['userState'];

        // Prepare query to check for duplicate email address
        $stmt = $conn->prepare('SELECT * FROM user WHERE emailAddress = ?');
        // Check for errors
        if ($stmt == false) {
            displayRedirect();
            die("Something went wrong when preparing the email check statement. Please try again.");
        }

        $stmt->bind_param('s', $emailAddress); // 's' specifies the variable type => 'string'
        // Check for errors
        if ($stmt == false) {
            displayRedirect();
            die("Something went wrong when binding the email check statement. Please try again.");
        }

        $stmt->execute();
        // Check for errors
        if ($stmt == false) {
            displayRedirect();
            die("Something went wrong when executing the email check statement. Please try again.");
        }

        $result = $stmt->get_result();
        // Check for errors
        if ($stmt == false) {
            displayRedirect();
            die("Something went wrong when getting the check email sstatement's result. Please try again.");
        }

        $stmt->close();

        // Check if the entered email address exists in the database using the prepared query
        if (mysqli_num_rows($result) != 0) {
            echo "User already exists! Please try a different email address.";
            displayRedirect();
            die();
        }

        // TODO: Do some password hashing magic

        // Prepare query safely for adding a new user
        $stmt = $conn->prepare("INSERT INTO user (
            emailAddress,
            password, 
            firstName, 
            lastName, 
            phoneNumber, 
            streetAddress, 
            cityAddress, 
            stateAddress, 
            dateOfCreation
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

        // Check for errors
        if ($stmt == false) {
            echo "Something went wrong when preparing the insert statement. Please try again.";
            displayRedirect();
            die();
        }

        $stmt->bind_param('sssssssss', $emailAddress, $password, $firstName, $lastName, $phoneNumber, 
                        $streetAddress, $cityAddress, $stateAddress, $dateOfCreation);

        // Check for errors
        if ($stmt == false) {
            echo "Something went wrong when binding the insert statement. Please try again.";
            displayRedirect();
            die();
        }

        // Execute the query that adds the new user to the database
        $stmt->execute();
        // Check for errors
        if ($stmt == false) {
            echo "Something went wrong when executing the insert statement. Please try again.";
            displayRedirect();
            die();
        }

        // Close the stmt
        $stmt->close();

        // Close the database connection
        mysqli_close($conn);

        echo "User account created successfully!";

        // Display redirect
        displayRedirect();
    }
?>