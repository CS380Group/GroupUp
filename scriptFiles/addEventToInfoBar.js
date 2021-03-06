 var htmlElements = "";
 var nameArr = [
    "Lucy",
    "Derrick",
    "Josh",
    "Steven",
    "Amanda",
    "Patrick",
    "Laura"
  ];
  var titleArr = [
    "Soccer Game",
    "Looking for D&D Group",
    "Community Service",
    "Park Event",
    "Job Opportunity",
    "New Business Open",
    "Ultimate Frisbee"
 ];
  var descripArr = [
    "Soccer Description",
    "D&D Description",
    "Community Service Description",
    "Park Description",
    "Job Description",
    "Business Description",
    "Frisbee Description"
  ];
 var imgSrc = [
   'https://cdn.glitch.com/ee8fe43d-07e1-4e6b-829e-9a5845cad499%2Fp1.jpg?v=1621984801834',
   'https://cdn.glitch.com/ee8fe43d-07e1-4e6b-829e-9a5845cad499%2Fphoto-1522075469751-3a6694fb2f61.jpg?v=1621976348843',
   'https://cdn.glitch.com/ee8fe43d-07e1-4e6b-829e-9a5845cad499%2Fp3.jpg?v=1621984808443',
   'https://cdn.glitch.com/ee8fe43d-07e1-4e6b-829e-9a5845cad499%2Fp4.jpg?v=1621984812367',
   'https://cdn.glitch.com/ee8fe43d-07e1-4e6b-829e-9a5845cad499%2Fp2.jpg?v=1621984805135',
   'https://cdn.glitch.com/ee8fe43d-07e1-4e6b-829e-9a5845cad499%2Fp7.jpg?v=1621984822330',
   'https://cdn.glitch.com/ee8fe43d-07e1-4e6b-829e-9a5845cad499%2Fp6.jpg?v=1621984819236'
 ];
 var counterArr = [
   0,
   0,
   0,
   0,
   0,
   0,
   0
 ];


//inserts info bars
function addEventsToInfoBar(eventsData) {
    if (eventsData.length == 0) {
        htmlElements = '<h1>No Nearby Events Matching Criteria :(</h1>';
    } else {
        for (var i = 0; i < eventsData.length; i++) {
        var name = eventsData[i].userId;
        var eventId = eventsData[i].eventId;
        var title = eventsData[i].eventTitle;
        var descrip = eventsData[i].eventDescription;
    
        htmlElements += constructHtmlForSidebar(imgSrc[i], eventId, name, title, counterArr[i], i, descrip);
            
        }
    }
  
    //container for info side bar
    var multiContainer = document.getElementById("multiContainer");
    multiContainer.innerHTML = htmlElements;

    // Add click event to these list items and have them display event data
    for (var i = 0; i < eventsData.length; i++) {
      const eventElement = document.getElementById("event" + i);
      const eventData = eventsData[i];
      const eventName = eventsData[i].eventTitle;
      const eventDescrip = eventsData[i].eventDescription;
      const eventComments = 'Comments Coming Soon :)';
      const usersAttending = 'Attendance Coming Soon :)';
      const time = eventsData[i].startDate;
      const eventLocation = eventsData[i].eventStreet + ' ' + eventsData[i].eventCity + ', ' + eventsData[i].eventState;
      eventElement.addEventListener("click", function(eventData) {
        console.log(eventData);
        var multiCont = document.getElementById('multiContainer');
        // In case we need to old configuration, before the overwrite.
        const multiBackup = Object.assign({}, multiCont);
        
        multiCont.innerHTML =
          '<div class="sidebarContainer">' + 
          '<nav class="detailSidebar" id="navID">' + 
              // '<button type="button" onclick="myFnc(this)"class="toggle-collapse" id="toggle-button">' +
              //     '<span class="toggle-icon">' +

              // //     '</span>' + 
              // '</button>' +
              '<ul class="side-nav">' +
                  '<li class="nav-item">' + 
                      '<a href="#" class="site-name">Event</a>' + 
                  '</li>' + 
                  '<li class="nav-item">' + 
                      '<a href="#" class="nav-link">' + eventName + '</a>' + 
                  '</li>' + 
                  '<li class="nav-item">' + 
                      '<a href="#" class="nav-link">' + eventComments + '</a>' + 
                  '</li>' + 
                  '<li class="nav-item">' + 
                      '<a href="#" class="nav-link">' + usersAttending + '</a>' +
                  '</li>' +
                  '<li class="nav-item">' + 
                      '<a href="#" class="nav-link">Start Time: ' + time + '</a>' + 
                  '</li>' + 
                  '<li class="nav-item">' + 
                      '<a href="#" class="nav-link">Event Location: ' + eventLocation + '</a>' + 
                  '</li>' + 
                  '<li class="nav-item">' + 
                      '<a href="javascript:window.location.reload()" class="nav-link">Back</a>' + 
                  '</li>' +  
              '</ul>' +
          '</nav>' + 
      '</div>';
      });
      
    }

}

// Constructs the html for the sidebar elements
function constructHtmlForSidebar(imageSource, eventId, userName, eventName, heartCounter, i, eventDescription) {
    html = '<div class="box">'+
        '<div class="card">'+
        '<div class="container2">'+
            '<div class="left2">'+
            //'<div class="image" id="userPic"></div>'+
            '<img src="'+ imageSource +'" id="userPic" style="width:130; height:130; object-fit: cover;">'+
            '<h4 class="name"> UserId: '+ userName + '</h4>'+
            '<div class="icons" style="text-align:center;">'+
                '<a href="sendMessage.php?eventId=' + eventId + '"> <button class="btn"><i class="fa fa-comments"></i></button></a>'+
                '<button class="btn"><i class="fa fa-map-marker"></i></button>'+
            '</div>'+
            '<div style="text-align:center;">'+                
                '<button class="btn" onclick="heartFunction('+ i +')"><i id="heart['+ i +']" class="fa fa-heart" style="color:black;"><span id="likeCounter['+ i +']">'+ heartCounter +'</span></i></button>'+
                '<form action="./backend/addUserToEvent.php" method="POST">' + 
                  '<input style="display:none;" class="input" name="eventId" type="text" id="eventId" value="' + eventId + '"/>' + 
                  '<button class="btn" name="joinEvent" id="joinEvent' + eventId + '"><i class="fa fa-bookmark"></i></button>'+  
                '</form>' +
            '</div>'+
            '</div>'+
            '<div class="right2" id="event' + i + '">'+
            '<h3>'+ eventName +'</h3>'+
            '<div><p class="textbox" style="border: 1px solid black">'+eventDescription+'</p></div>' +
            '</div>'+
        '</div>'+
        '</div>'+
    '</div>'+
    '<div class="border">Hello</div>' + 
    // TODO : fix this. Stopgap solution.
    '<br /><br />' + 
    '<br /><br />';
    return html;
}

//like counter function
function heartFunction(i){
  
  var hrtColor = document.getElementById("heart["+ i +"]").style.color;
  
  if(hrtColor === "black"){
    counterArr[i]++;
    document.getElementById("likeCounter["+ i +"]").innerHTML = counterArr[i];
    document.getElementById("heart["+ i +"]").style.color = "red";
    document.getElementById("likeCounter["+ i +"]").style.color = "black";
  }else{
    counterArr[i]--;
    document.getElementById("likeCounter["+ i +"]").innerHTML = counterArr[i];
    document.getElementById("heart["+ i +"]").style.color = "black";
  }
}