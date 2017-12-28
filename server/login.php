<?php
include "db-config.php";
$username = $_POST['username'];
$password = $_POST['password'];
$query = "SELECT * FROM users WHERE username = '".$username."' AND password = '".$password."'";
$result = $link->query($query);
$logged_in = "Failure! Incorrect credentials: $username and $password";
if ($result->num_rows > 0) {
  $logged_in = "Success! Logged in as $username with $password!";
}
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Test Site for SQLi Scanner</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
    <div id="banner">SQLi Scanner Test Site</div>
    <div id="content">
      <p>A test site for PCS17 SQLi Scanner.</p>

      <p id="result-msg"> <?php echo $logged_in ?> </p>

      <a href="/" id="back-btn">Back to Home</a>
    </div>
  </body>
</html>