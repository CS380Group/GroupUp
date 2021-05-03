//Values
var geocoder;
var map;
var userName = [
  "Lucy",
  "Derrick",
  "Josh",
  "Steven",
  "Amanda",
  "Patrick",
  "Will"
];

var description = [
  "Soccer Game",
  "Looking for D&D Group",
  "Community Service",
  "Park Event",
  "Job Opportunity",
  "New Business Open",
  "Ultimate Frisbee"
];

var address = [
  "801 e 18th ave",
  "1081 umptanum rd",
  "1300 e 3rd ave",
  "400 w washington ave",
  "805 n main st",
  "608 e mountain view ave",
  "1518 w university way"
];

var city = "Ellensburg";
var state = "WA";
/*
//Main Body
function initMap() {
  geocoder = new google.maps.Geocoder();
  geocoder.geocode({ address: city }, function(results, status) {
    if (status == google.maps.GeocoderStatus.OK) {
      //alert(results[0].geometry.location)
      var latlng = results[0].geometry.location;
      var mapOptions = {
        zoom: 13,
        center: latlng,
        gestureHandling: "greedy"
      };
      map = new google.maps.Map(document.getElementById("map"), mapOptions);

      //Loop for placing Markers
      for (var i = 0; i < address.length; i++) {
        var spot = address[i];
        var nam = userName[i];
        var descrip = description[i];
        codeAddress(geocoder, map, spot, nam, descrip);
      }
    } else {
      //alert('Geocode was not successful for the following reason: ' + status);
    }
  });
}

//Places Markers
function codeAddress(geocoder, map, spot, nam, descrip) {
  geocoder.geocode({ address: spot + ", " + city + " " + state }, function(
    results,
    status
  ) {
    if (status === "OK") {
      var infowindow = new google.maps.InfoWindow();
      var marker = new google.maps.Marker({
        map: map,
        position: results[0].geometry.location,
        title: spot
      });
      google.maps.event.addListener(
        marker,
        "click",
        (function(marker) {
          var contentString =
            '<div id="infoWindow">' +
            '<div id="bodyContent">' +
            "<p>" +
            "Name: " +
            nam +
            "<br>" +
            "Event Title: " +
            descrip +
            "<br>" +
            "Address: " +
            spot +
            "<br>" +
            "City: " +
            city +
            "<br>" +
            "State: " +
            state +
            "<br>" +
            "</p>" +
            "</div>" +
            "</div>";
          return function() {
            infowindow.setContent(contentString);
            infowindow.open(map, marker);
            google.maps.event.addListener(infowindow, "click", function(i) {
              alert("You clicked on the infowindow for" + cityList[i][0]);
            });
          };
        })(marker)
      );
    } else {
      //alert('Geocode was not successful for the following reason: ' + status);
    }
  });
}
*/