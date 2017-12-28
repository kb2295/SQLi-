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

      <p class="form-label">Here is a POST login form: (username: pcs17 password: practical)</p>
      <form method="POST" action="login.php">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <input type="submit" value="Log in">
      </form>

      <p class="form-label">Here is a GET search form: (searches for usernames that match)"</p>
      <form method="GET" action="search.php">
        <input type="text" name="search" placeholder="Search here...">
        <input type="submit" value="Search">
      </form>
    </div>
  </body>
</html>