<!-- Start user session -->
<?php session_start(); ?>
<!--DOCTYPE html-->
<html>
  <head>
    <title>Sign-In Page</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta charset="utf-8" />
    <link rel="stylesheet" href="stylesheet.css" type="text/css" />
  </head>
  <body>
    <nav class="navbar">
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="sports.php">Sports</a></li>
        <li><a href="community.php">Community</a></li>
        <li><a href="gaming.php">Gaming</a></li>
        <li><a href="create-event.php">Create an Event</a></li>
        <li><a href="create-account.php">Create An Account</a></li>
        <li><a href="inbox.html">Inbox</a></li>
        <li>
          <a class="active" href="user-page.php">My Account</a>
        </li>
      </ul>
    </nav>

    <!--Places Map on page-->
    <form action="/backend/addUserToDatabase.php" method="POST">
      
      <!--Box Info-->
      <div class="center">
      <p style="border:2px; background-color: lightgray; border-style:solid; 
                border-color:white; padding: 1em; width: 390px;">
      <!--End of box info-->
      <?php
        include './backend/getUserInfo.php';

        $userAndEvents = getUserInfo();
        $userInfo = $userAndEvents[0][0];
        $joinedEvents = $userAndEvents[1];

        $userFirstName = $userInfo['firstName'];
        $userLastName = $userInfo['lastName'];
        $userEmail = $_SESSION['username'];
        $userPhone = $userInfo['phoneNumber'];
        $userAddress = $userInfo['streetAddress'];
        $userCity = $userInfo['cityAddress'];
        $joinedEventsString = "";

        if (sizeof($joinedEvents) == 0) {
          $joinedEventsString = $joinedEventsString . " - No joined events were found! Try joining some events!";
        } else {
          for ($i = 0; $i < sizeof($joinedEvents); $i++) {
            $eventTitle = $joinedEvents[$i]['eventTitle'];
            $joinedEventsString = $joinedEventsString . "$eventTitle<br /><br />";
          }
        }
        
        $userData = "<b>My Account</b>" . 
        "<br /><br /><br />" . 
        "<b><u>Name</u></b>" . 
        "<br /><br />" . 
        "<text>$userFirstName $userLastName</text>" . 
        "<br /><br />" . 
        "<b><u>Email</u></b>" . 
        "<br /><br />" . 
        "<text>$userEmail</text>" .
        "<br /><br />" . 
        "<b><u>Phone Number</u></b>" . 
        "<br /><br />" . 
        "<text>$userPhone</text>" . 
        "<br /><br />" . 
        "<b><u>Address</u></b>" . 
        "<br /><br />" . 
        "<text>$userAddress</text>" . 
        "<br /><br />" . 
        "<b><u>City</u></b>" . 
        "<br /><br />" . 
        "<text>$userCity</text>" . 
        "<br /><br />" . 
        "<b><u>Events Joined</u></b>" . 
        // "<ul><li>fff</li></ul>" .
        "<br /><br />" . 
        "<text>$joinedEventsString</text>" . 
        "<br /><br />";
        echo $userData;
      ?>

      <button class="open-button" name="submit" onclick="">Sign Out</button>      
    </form>
    <script src="scriptFiles/signIn.js"></script>
    <script src="scriptFiles/create-accountScript.js"></script>
  </body>
</html>