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
        <li><a href="inbox.php" class="active">Inbox</a></li>
        <li>
          <!--Sign In-->
          <button class="open-button" onclick="openForm()">Sign In</button
          ><br /><br /><br />
          <div class="form-popup" id="myForm">
            <form action="/action_page.php" class="form-container">
              <h1>Login</h1>

              <label for="email"><b>Email</b></label>
              <input
                type="text"
                placeholder="Enter Email"
                name="email"
                required
              />

              <label for="psw"><b>Password</b></label>
              <input
                type="password"
                placeholder="Enter Password"
                name="psw"
                required
              />

              <button type="submit" class="btn">Login</button>
              <button type="submit" class="btn cancel" onclick="closeForm()">
                Close
              </button>
            </form>
          </div>
        </li>
      </ul>
    </nav>

     <!--Add here new messaging code--> 
     
  </body>
</html>

