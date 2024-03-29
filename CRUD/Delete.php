<?php
include 'connect.php';

if (isset($_GET['bedrift_id'])) {
    $id = $_GET['bedrift_id'];

    $sql_delete = "SELECT * FROM bedrifter_tb 
                   INNER JOIN ansatte_tb 
                   ON bedrifter_tb.bedfrift_id = ansatte_tb.ansatte_bedrifts_id 
                   WHERE ansatte_tb.ansatte_bedrifts_id = $id";

    $result_delete = mysqli_query($conn, $sql_delete);

    if (!$sql_delete) {
        die("Query failed: " . mysqli_error($conn));
    }

    if (mysqli_num_rows($result_delete) > 0) {
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../stylesheets/stylesheet.css?v=1.0">
    <title> Bedriftsportalen </title>
</head>
<body>
    

    <h1> Bedriftsportalen </h1>

    <a href="Create.php"><button type="button" class="btn"> Create</button></a>
    <a href="Read.php"><button type="button" class="btn"> Read</button></a>
    <a href="Update.php"><button type="button" class="btn"> Update</button></a>
    <a href="../"><button type="button" class="btn"> Index</button></a>

    <?php
    if(isset($_GET['bedrift_id'])) { 
        echo '<form id="deleteForm" method="post" style="display:none;">';
        echo '<input type="hidden" name="confirm_delete" value="1"';
        echo "</form";
    }
    ?>

    <button onclick="confirmDelete(<?php echo $id; ?>)" class="delete-btn-table">Delete</button>

    <script src="JavaScript/script.js">
</body>
</html>