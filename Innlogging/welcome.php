<?php

session_start();
// Check if the user is logged in, if not then redirect them to the login page
/* if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: ../Verification.php");
    exit;
} */

// Display welcome message with user's username
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link rel="stylesheet" href="../stylesheets/stylesheet.css?v=1.0">
</head>

<body>
    <div class="wrapper">
        <h1>Welcome, <?php echo $_SESSION["username"]; ?></h1>
        <p>This is a simple example of a welcome page. You are logged in as <?php echo $_SESSION["username"]; ?>.</p>
        <p>Admin: <?php echo $_SESSION["is_admin"]; ?></p>
        <p><a href="logout.php">Logout</a></p>
        <p><a href="../index.php">Index</a></p>
    </div>
</body>

</html>