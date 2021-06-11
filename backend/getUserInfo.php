<?php
	function getUserInfo() {
		// This script will get relevant user information for use in the my account page

		// Include necessary functions
		include 'connectToDatabase.php';
		include 'redirectToLastPage.php';
		include 'getUserIdFromEmail.php';

		if (isset($_SESSION['username'])) {
			// Connect to database
			$conn = connectToDatabase();

			$username = $_SESSION['username'];

			// Get userId
			$userId = getUserId($username);

			// Prepare query
			$stmt = $conn->prepare("SELECT * FROM user WHERE userId=?");
			if ($stmt == false) {
				echo "Something went wrong while preparing the get user data query.";
				displayRedirect();
				die;
			}
			// Bind query
			$stmt->bind_param('s', $userId);
			if ($stmt == false) {
				echo "Something went wrong while binding parameters to the get user data query.";
				displayRedirect();
				die;
			}

			// Execute query
			$stmt->execute();
			if ($stmt == false) {
				echo "Something went wrong while executing the get user data query.";
				displayRedirect();
				die;
			}

			// Get results
			$result = $stmt->get_result();
			if ($stmt == false) {
				echo "Something went wrong while getting the results of the get user data query.";
				displayRedirect();
				die;
			}

			// Get results as an assoc array
			$user = mysqli_fetch_all($result, MYSQLI_ASSOC);
			
			// Get list of joined events
			// Prepare query
			$stmt->prepare("SELECT * FROM userJoinEvent WHERE userId=?");
			if ($stmt == false) {
				echo "Something went wrong while preparing the get joined events query.";
				displayRedirect();
				die;
			}
			
			// Bind paramters
			$stmt->bind_param('s', $user['userId']);
			if ($stmt == false) {
				echo "Something went wrong while binding parameters to the get joined events query.";
				displayRedirect();
				die;
			}
			
			// Execute query
			$stmt->execute();
			if ($stmt == false) {
				echo "Something went wrong while executing the get joined events query.";
				displayRedirect();
				die;
			}

			// Get results
			$result = $stmt->get_result();
			if ($stmt == false) {
				echo "Something went wrong while getting the results of the get joined events query.";
				displayRedirect();
				die;
			}

			$events = mysqli_fetch_all($result, MYSQLI_ASSOC);

			$userAndEvents = array($user, $events);

			return $userAndEvents;
		} else {
			echo "Please sign in before viewing your account.";
			displayRedirect();
			die;
		}
	}
?>