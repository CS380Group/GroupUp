// Places markers according to their latitude/longitude in DB
function placeMarker(map, street, city, state, country, latitude, longitude, eventTitle, eventDescription) {
  var infowindow = new google.maps.InfoWindow();
  var eventPosition = new google.maps.LatLng(latitude, longitude);
  var marker = new google.maps.Marker({
    map: map,
    position: eventPosition,
    title: street
  });
  google.maps.event.addListener(
    marker,
    "click",
    (function(marker) {
      // Open Sidebar
      
      var contentString =
        '<div id="infoWindow">' +
        '<div id="bodyContent">' +
        "<p>" +
        "Name: " +
        eventTitle +
        "<br>" +
        "Event Title: " +
        eventDescription +
        "<br>" +
        "Address: " +
        street +
        "<br>" +
        "City: " +
        city +
        "<br>" +
        "State: " +
        state +
        "<br>" +
        "Country: " +
        country +
        "<br>" +
        "</p>" +
        "</div>" +
        "</div>";
      return function() {
        // infowindow.setContent(contentString);
        infowindow.open(map, marker);
        google.maps.event.addListener(infowindow, "click", function(i) {
          alert(
            "You clicked on the infowindow for" + cityList[i][0]
          );
        });
      };
    })(marker)
  );
}

// Function that will handle the database request for retrieving events based on category
function makeCategoryRequest(category, url, callback) {
    var request;
    //TODO: Look into compatibility issues
    request = new XMLHttpRequest();
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
        callback(request);
        }
    }
    // var category = 'sports';
    request.open("GET", url+"?"+"category="+category, true);
    request.send();
}

// Function that will handle the database request for retrieving events
function makeLocationRequest(city, url, callback) {
  var request;
  //TODO: Look into compatibility issues
  request = new XMLHttpRequest();
  request.onreadystatechange = function() {
    if (request.readyState == 4 && request.status == 200) {
      callback(request);
    }
  }
  // var city = 'Ellensburg';
  request.open("GET", url+"?"+"city="+city, true);
  request.send();
}