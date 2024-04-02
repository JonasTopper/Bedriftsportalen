<?php
include 'connect.php';

// Check if form is submitted
if(isset($_POST['submit'])) {
    // Get the bedrift_id from the form
    $id = $_POST['bedrift_id'];

    // Retrieve updated data from the form
    $navn = $_POST['bedrift_navn'];
    $adresse = $_POST['bedrift_adresse'];
    $post_nr = $_POST['bedrift_post_nr'];
    $post_sted = $_POST['bedrift_post_sted'];
    $org_form = $_POST['bedrift_org_form'];
    $org_nr = $_POST['bedrift_org_nr'];

    // Update data in the database
    $sql_update = "UPDATE bedrifter_tb 
                   SET bedrift_navn = '$navn', bedrift_adresse = '$adresse', bedrift_post_nr = '$post_nr', 
                       bedrift_post_sted = '$post_sted', bedrift_org_form = '$org_form', bedrift_org_nr = '$org_nr'
                   WHERE bedrift_id = $id";
    $result_update = mysqli_query($conn, $sql_update);

    // Check if the update was successful
    if ($result_update) {
        // Redirect back to read.php with the correct bedrift_id
        header("Location: read.php?bedrift_id=$id");
        exit();
    } else {
        // Handle the case where the update fails
        echo "Error updating record: " . mysqli_error($conn);
    }
}

// If form is not submitted or update fails, fetch current data for display
if(isset($_GET['bedrift_id'])) {
    $id = $_GET['bedrift_id'];
    $sql_bedrifter = "SELECT * FROM bedrifter_tb WHERE bedrift_id = $id";
    $result = mysqli_query($conn, $sql_bedrifter);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        
        $navn = $row['bedrift_navn'];
        $adresse = $row['bedrift_adresse'];
        $post_nr = $row['bedrift_post_nr'];
        $post_sted = $row['bedrift_post_sted'];
        $org_form = $row['bedrift_org_form'];
        $org_nr = $row['bedrift_org_nr'];
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Error: 'bedrift_id' parameter is missing in the query string.";
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../stylesheets/stylesheet.css?v=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-pwCHXNHXDBp4Zh3fCkGpMeWzHjwUC1n1br5x3IyVBFzbJRsN/l2M+SWdgZfjqxiS" crossorigin="anonymous">
    <title>Bedriftsportalen</title>
</head>
<body>

<main>
    <form method="POST" action="">
        <input type="hidden" name="bedrift_id" value="<?php echo $id ?>">

        <label for="navn">Navn:</label>
        <input type="text" name="bedrift_navn" value="<?php echo $navn ?>"><br>

        <label for="adresse">Adresse:</label>
        <input type="text" name="bedrift_adresse" value="<?php echo $adresse ?>"><br>

        <label for="post_nr">Postnummer:</label>
        <input type="text" name="bedrift_post_nr" value="<?php echo $post_nr ?>"><br>

        <label for="post_sted">Poststed:</label>
        <input type="text" name="bedrift_post_sted" value="<?php echo $post_sted ?>"><br>

        <label for="org_form">Org-form:</label>
        <input type="text" name="bedrift_org_form" value="<?php echo $org_form ?>"><br>

        <label for="org_nr">Org-nummer:</label>
        <input type="text" name="bedrift_org_nr" value="<?php echo $org_nr ?>"><br>

        /** Exit knapp her plz*/
        <input type="submit" name="submit" value="Oppdater">
    </form>
</main>

</body>
</html>
