<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>Confirm Deletion</h1>
    <p>Are you sure you want to delete this ansatt? This cannot be undone.</p>
    <form action="delete_ansatte.php" method="POST">
        <input type="hidden" name="ansatte_id" value="<?php echo $_GET['ansatte_id']; ?>">
        <button type="submit" name="confirm_delete">Yes, Delete</button>
        <a href="read.php"><button type="button">Cancel</button></a>
    </form>
</body>
</html>