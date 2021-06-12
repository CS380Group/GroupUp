<?php
	// This code submits a message to the database

	// Import necessary functions
	include 'connectToDatabase.php';
	include 'redirectToLastPage.php';
	include 'getUserIdFromEmail.php';
	include 'getEventOwner.php';

	if (isset($_POST['submit'])) {
		session_start();
		// Connect to database
		$conn = connectToDatabase();

		// Get variables
		$userId = getUserId($_SESSION['username']);
		$eventId = $_SESSION['eventId'];
		$eventOwner = getEventOwnerId($eventId);
		$todaysDate = date('Y-m-d H:i:s');
		$message = $_POST['message'];

		// Prepare statement
		$stmt = $conn->prepare("INSERT INTO directMessage (messageSendDate, messageSender, messageRecipient, messageContents)
					VALUES (?,?,?,?)");
		if ($stmt == false) {
			echo "Something went wrong while preparing the send message query. Please try again.";
			displayRedirect();
			die;
		}

		// Bind parameters
		$stmt->bind_param('ssss', $todaysDate, $userId, $eventOwner, $message);
		if ($stmt == false) {
			echo "Something went wrong while binding params to the send message query. Please try again.";
			displayRedirect();
			die;
		}

		// Execute query
		$stmt->execute();
		if ($stmt == false) {
			echo "Something went wrong while executing the send message query. Please try again.";
			displayRedirect();
			die;
		}

		$stmt->close();


		echo "Message sent!";
		echo '<p><a href="../index.php" title="Return to home page">&laquo; Return to home page</a></p>';
		die;
	} else {
		echo "Something went wrong, please try again.";
		echo '<p><a href="../index.php" title="Return to home page">&laquo; Return to home page</a></p>';
		die;
	}

?>
