<?php
include "db-config.php";
$search = $_GET['search'];
$query = "SELECT * FROM users WHERE username LIKE '%$search%'";
$result = $link->query($query);
$output = "Search failed. No results found.";
if ($result->num_rows > 0) {
  $output = "Found:<br>";
  while($row = $result->fetch_assoc()) {
    $output .= $row['id'].". ".$row['username']."<br>";
  }
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

      <p id="result-msg"><?php echo $output ?></p>

      <a href="/" id="back-btn">Back to Home</a>
    </div>
  </body>
</html>