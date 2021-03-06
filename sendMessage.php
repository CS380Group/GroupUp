<?php
  include './backend/redirectToLastPage.php';
  session_start();
  if (!isset($_SESSION['username'])) {
    echo "Please sign in before attempting to message another user.";
    displayRedirect();
    die;
  }
  $_SESSION['eventId'] = $_GET['eventId'];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="contact form example">
  <title>Contact Form Example</title>
</head>

<body>
  <h2 class="content-head is-center">Message Sender!</h2>
  <aside>
       <p>
           <b>Please use this webpage to send a message!</b> </p>
           <p><b>Message will be sent to users inbox.</b> 
       </p>
   </aside>

<!-- START HERE -->
   <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
   <!-- Style The Contact Form How Ever You Prefer -->
   <link rel="stylesheet" href="Style3.css">

  <form class="gform pure-form pure-form-stacked" method="POST" data-email="example@email.net"
  action="./backend/sendMessage.php">
    <!-- change the form action to your script url -->

    <div class="form-elements">
      <fieldset class="pure-group">
        <label for="nam" name="senderEmail">Message Sender: <?php echo $_SESSION['username']; ?></label>
      </fieldset>

      <fieldset class="pure-group">
        <label for="owner" name="recipEventId">Event Owner: <?php echo $_GET['eventId']; ?></label>
      </fieldset>

      <fieldset class="pure-group">
        <label for="message">Message: </label>
        <textarea id="message" name="message" rows="10"
        value="sfsfs"></textarea>
      </fieldset>
      
      <fieldset class="pure-group honeypot-field">
        <label for="honeypot">To help avoid spam, utilize a Honeypot technique with a hidden text field; must be empty to submit the form! Otherwise, we assume the user is a spam bot.</label>
        <input id="honeypot" type="text" name="honeypot" value="" />
      </fieldset>

      <button class="button-success pure-button button-xlarge" name="submit" onclick="setMessage()">
        <i class="fa fa-paper-plane"></i>&nbsp;Send</button>
    </div>

    <!-- Customise the Thankyou Message People See when they submit the form: -->
    <div class="thankyou_message" style="display:none;">
      <h2><em>Message Sent!</h2>
      
    <div style="display: flex; align-items: center;">
      <p style="font-weight: bold; ">The message: </p> &nbsp&nbsp&nbsp
      <p id="demo2" >2</p>&nbsp&nbsp&nbsp
      <p style="font-weight: bold;">was sent to: </p>&nbsp&nbsp&nbsp
      <p id="person"></p>
    </div>
    <a href="index.html">Go Back</a>
      
    </div>

  </form>

  <!-- Submit the Form to Google Using "AJAX" -->
  <script data-cfasync="false" src="form-submission-handler.js"></script>
<!-- END -->
<script>


 var messageArr = [
    [],
 ];

  

  //potential function
  function setMessage(){

    //collects message
    var message = document.getElementById("message").value;
    messageArr[0].push(message);

    var owner = document.getElementById("owner").value;

    document.getElementById("demo2").innerHTML = messageArr[0];
    document.getElementById("person").innerHTML = owner;
  }
  

</script>
</body>
</html>
