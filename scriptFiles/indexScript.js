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
  for (var i = 0; i < eventsData.length; i++) {
    var name = eventsData[i].userName;
    var title = eventsData[i].eventTitle;
    var descrip = eventsData[i].eventDescription;

    htmlElements += 
      '<div class="box">'+
        '<div class="card">'+
          '<div class="container2">'+
            '<div class="left2">'+
              //'<div class="image" id="userPic"></div>'+
              '<img src="'+ imgSrc[i] +'" id="userPic" style="width:130; height:130; object-fit: cover;">'+
              '<h4 class="name">'+ name + '</h4>'+
              '<div class="icons" style="text-align:center;">'+
                '<button class="btn"><i class="fa fa-comments"></i></button>'+
                '<button class="btn"><i class="fa fa-map-marker"></i></button>'+
              '</div>'+

              '<div style="text-align:center;">'+
                '<button class="btn" onclick="heartFunction('+ i +')"><i id="heart['+ i +']" class="fa fa-heart" style="color:black;"><span id="likeCounter['+ i +']">'+ counterArr[i] +'</span></i></button>'+

                '<button class="btn"><i class="fa fa-bookmark"></i></button>'+
              '</div>'+
            '</div>'+
            '<div class="right2">'+
              '<h3>'+ title +'</h3>'+
              '<div><p class="textbox" style="border: 1px solid black">'+descrip+'</p></div>' +
            '</div>'+
          '</div>'+
        '</div>'+
      '</div>'+
      '<div class="border">Hello</div>';  
  }

  //container for info side bar
  var multiContainer = document.getElementById("multiContainer");
  multiContainer.innerHTML = htmlElements;      
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