<!-- Start user session -->
<?php 
  session_start(); 
?>

<!--DOCTYPE html-->
<html>
  <head>
    <title>Main Page</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta charset="utf-8" />
    <link rel="stylesheet" href="stylesheet.css" type="text/css" />
    <link rel="stylesheet" href="Style.css" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>

  <body>
    <!--Nav Bar-->
    <nav class="navbar">
      <ul>
        <li><a class="active" href="index.php">Home</a></li>
        <li><a href="sports.php">Sports</a></li>
        <li><a href="community.php">Community</a></li>
        <li><a href="gaming.php">Gaming</a></li>
        <li><a href="create-event.php">Create an Event</a></li>
        <li><a href="create-account.php">Create An Account</a></li>
        <li><a href="inbox.php">Inbox</a></li>
        <li>
          <?php
            if (isset($_SESSION['username'])) {
              echo '<a href="myAccount.html">My Account</a>';
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

    <!--Page Title -->
    <h>Home Page</h>

    <!--Map-->
    <div class="container">
      <div class="left" id="map"></div>
      <div class="right" id="eventDetails">
        <div id="multiContainer"></div>
      </div>
    </div>

    <script>
      //Main Body
      function initMap() {
        geocoder = new google.maps.Geocoder();
        //TODO: Change default address to the city the user is in or has selected
        geocoder.geocode({ address: "Ellensburg" }, function(results, status) {
          if (status == google.maps.GeocoderStatus.OK) {
            //alert(results[0].geometry.location)
            var latlng = results[0].geometry.location;
            var mapOptions = {
              zoom: 13,
              center: latlng,
              gestureHandling: "greedy"
            };
            map = new google.maps.Map(
              document.getElementById("map"),
              mapOptions
            );

            // Get locations from db and add them to the map
            makeLocationRequest('Ellensburg', './backend/getEventsByCity.php', function(data) {
              var data = JSON.parse(data.responseText);
              
              // Display events in sidebar
              addEventsToInfoBar(data);

              // Extract event data and place them on the map
              for (var i = 0; i < data.length; i++) {
                var streetAddress = data[i].eventStreet;
                var city = data[i].eventCity;
                var state = data[i].eventState;
                var country = data[i].eventCountry;
                var latitude = data[i].latitude;
                var longitude = data[i].longitude;
                var userName = data[i].userName;
                var eventTitle = data[i].eventTitle;
                var eventDescription = data[i].eventDescription;
                //Debug message
                // console.log(address, userCity, userState, userName, userDescription);
                // codeAddress(geocoder, map, address, userState, userCity, userName, userDescription);
                placeMarker(map, streetAddress, city, state, country, latitude, longitude, eventTitle, eventDescription);
              }
            });
          } else {
            // TODO: Handle this error
            //alert('Geocode was not successful for the following reason: ' + status);
          }
        });
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDQP4SoFyVEn1BfUd54sFeVTqodT83NNfo&callback=initMap"></script>
    <script src="scriptFiles/signIn.js"></script>
    <script src="scriptFiles/indexScript.js"></script>
    <script src="scriptFiles/addEventToInfoBar.js"></script>
    <script src="scriptFiles/markerUtils.js"></script>
  </body>
</html>
