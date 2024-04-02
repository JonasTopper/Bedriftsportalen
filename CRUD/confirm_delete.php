<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../stylesheets/stylesheet.css?v=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-pwCHXNHXDBp4Zh3fCkGpMeWzHjwUC1n1br5x3IyVBFzbJRsN/l2M+SWdgZfjqxiS" crossorigin="anonymous">
    <title>Confirm Delete</title>
</head>
<body>
    <h1>Confirm Deleteion</h1>
    <p>Are you sure you want to delete this bedrift? This cannot be undone.</p>
    <form action="delete_code.php" method="POST">
        <input type="hidden" name="bedrift_id" value="<?php echo $_GET['bedrift_id']; ?>">
        <button type="submit" name="confirm_delete">Yes, Delete</button>
        <a href="../"><button type="button">Cancel</button></a>
    </form>
</body>
</html>