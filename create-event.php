<!-- Start user session -->
<?php 
  include './backend/redirectToLastPage.php';
  session_start(); 
  if (!isset($_SESSION['username'])) {
    echo "Please sign in before attempting to create an event.";
    displayRedirect();
    die;
  }
?>

<!--DOCTYPE html-->
<html>
  <head>
    <title>Create Event Page</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta charset="utf-8" />
    <link rel="stylesheet" href="stylesheet.css" type="text/css" />
  </head>
  <body>
    <!--Nav Bar-->
    <nav class="navbar">
      <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="sports.php">Sports</a></li>
        <li><a href="community.php">Community</a></li>
        <li><a href="gaming.php">Gaming</a></li>
        <li><a class="active" href="create-event.php">Create an Event</a></li>
        <li><a href="create-account.php">Create An Account</a></li>
        <li><a href="inbox.php">Inbox</a></li>
        <li>
          <?php
            if (isset($_SESSION['username'])) {
              echo '<a href="user-page.php">My Account</a>';
            }
            else {
              echo '<button class="open-button" onclick="openForm()">Sign In</button' . 
                '><br /><br /><br />' . 
                '<div class="form-popup" id="myForm">' . 
                  '<form action="/backend/loginUser.php" class="form-container" method="POST">' . 
                    '<h1>Login</h1>' . 
      
                    '<label for="email"><b>Email</b></label>' .
                    '<input ' . 
                      'type="text"' . 
                      'placeholder="Enter Email"' .
                      'name="email"' . 
                      'required' . 
                    '/>' .
                    '<label for="psw"><b>Password</b></label>' . 
                    '<input ' . 
                      'type="password"' . 
                      'placeholder="Enter Password"' .
                      'name="password"' . 
                      'required' . 
                    '/>' . 
                    '<button type="submit" name="submit" class="btn">Login</button>' . 
                    '<button type="submit" class="btn cancel" onclick="closeForm()">' . 
                      'Close' . 
                    '</button>' . 
                  '</form>' .
                '</div>';
            }
          ?>
        </li>
      </ul>
    </nav>

    <!--Places Marker on page-->
    <form action="./backend/addEventToDatabase.php" method="POST">
      
      <!--Box Info-->
      <div class="center">
      <p style="border:2px; background-color: lightgray; border-style:solid; 
                border-color:white; padding: 1em; width: 390px;">
      <!--End of box info-->
      
        <label for="userName">Name</label><br />
      <input
        type="text"
        id="userName"
        name="userName"
        value="John Doe"
      /><br /><br />

      <label for="userTitle">Event Title</label><br />
      <input
        type="text"
        id="userTitle"
        name="userTitle"
        value="Basketball Game"
      /><br /><br />

      <label for="userType">Event Type</label><br />
      <select name="userType" id="userType">
        <option value="sports" selected>Sports</option>
        <option value="community">Community</option>
        <option value="gaming">Gaming</option> </select
      ><br /><br />

      <label for="userDescription">Description</label><br />
      <textarea
        type="text"
        id="userDescription"
        name="userDescription"
        row="20"
        cols="50"
        resize="none"
      >
Looking for people to play basketball with.</textarea
      ><br /><br />

      <label for="userPhone">Phone Number</label><br />
      <input
        type="text"
        id="userPhone"
        name="userPhone"
        value="(555) 555-5555"
      /><br /><br />

      <label for="userAddress">Address</label><br />
      <input
        type="text"
        id="userAddress"
        name="userAddress"
        value="400 e University way"
      /><br /><br />

      <label for="userCity">City</label><br />
      <input
        type="text"
        id="userCity"
        name="userCity"
        value="Ellensburg"
      /><br /><br />

      <label for="userState">State</label><br />
      <select name="userState" id="userState">
        <option value="AL">Alabama</option>
        <option value="AK">Alaska</option>
        <option value="AZ">Arizona</option>
        <option value="AR">Arkansas</option>
        <option value="CA">California</option>
        <option value="CO">Colorado</option>
        <option value="CT">Connecticut</option>
        <option value="DE">Delaware</option>
        <option value="DC">District Of Columbia</option>
        <option value="FL">Florida</option>
        <option value="GA">Georgia</option>
        <option value="HI">Hawaii</option>
        <option value="ID">Idaho</option>
        <option value="IL">Illinois</option>
        <option value="IN">Indiana</option>
        <option value="IA">Iowa</option>
        <option value="KS">Kansas</option>
        <option value="KY">Kentucky</option>
        <option value="LA">Louisiana</option>
        <option value="ME">Maine</option>
        <option value="MD">Maryland</option>
        <option value="MA">Massachusetts</option>
        <option value="MI">Michigan</option>
        <option value="MN">Minnesota</option>
        <option value="MS">Mississippi</option>
        <option value="MO">Missouri</option>
        <option value="MT">Montana</option>
        <option value="NE">Nebraska</option>
        <option value="NV">Nevada</option>
        <option value="NH">New Hampshire</option>
        <option value="NJ">New Jersey</option>
        <option value="NM">New Mexico</option>
        <option value="NY">New York</option>
        <option value="NC">North Carolina</option>
        <option value="ND">North Dakota</option>
        <option value="OH">Ohio</option>
        <option value="OK">Oklahoma</option>
        <option value="OR">Oregon</option>
        <option value="PA">Pennsylvania</option>
        <option value="RI">Rhode Island</option>
        <option value="SC">South Carolina</option>
        <option value="SD">South Dakota</option>
        <option value="TN">Tennessee</option>
        <option value="TX">Texas</option>
        <option value="UT">Utah</option>
        <option value="VT">Vermont</option>
        <option value="VA">Virginia</option>
        <option value="WA" selected>Washington</option>
        <option value="WV">West Virginia</option>
        <option value="WI">Wisconsin</option>
        <option value="WY">Wyoming</option> </select
      ><br /><br />

      <input type="submit" name="submit" id="myButton" value="Submit" />
      </p>
    </div>
    </form>

    <script src="scriptFiles/signIn.js"></script>
    <script src="scriptFiles/create-eventScript.js"></script>
  </body>
</html>
