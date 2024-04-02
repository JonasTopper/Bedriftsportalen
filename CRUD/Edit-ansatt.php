<?php
include 'connect.php';

// Check if form is submitted
if(isset($_POST['submit'])) {
    // Get the ansatte_id from the form
    $id = $_POST['ansatte_id'];

    // Retrieve updated data from the form
    $fornavn = $_POST['ansatte_fornavn'];
    $etternavn = $_POST['ansatte_etternavn'];
    $stilling = $_POST['ansatte_stilling'];
    $telefon = $_POST['ansatte_tlf_nr'];
    $epost = $_POST['ansatte_epost'];
    $kontakt = $_POST['ansatte_kontakt_person'];

    // Get the selected bedrift_id from the form
    $bedrift_id = $_POST['bedrift_id'];

    // Update data in the database
    $sql_update = "UPDATE ansatte_tb 
                   SET ansatte_fornavn = '$fornavn', ansatte_etternavn = '$etternavn', 
                       ansatte_stilling = '$stilling', ansatte_tlf_nr = '$telefon',
                       ansatte_epost = '$epost', ansatte_kontakt_person = '$kontakt',
                       ansatte_bedrifts_id = '$bedrift_id' 
                   WHERE ansatte_id = $id";

    $result_update = mysqli_query($conn, $sql_update);

    // Check if the update was successful
    if ($result_update) {
        // Redirect back to read.php with the correct ansatte_bedrifts_id
        header("Location: read.php?bedrift_id=$bedrift_id");
        exit();
    } else {
        // Handle the case where the update fails
        echo "Error updating record: " . mysqli_error($conn);
    }
}

// Fetch current data for display
if(isset($_GET['ansatte_id'])) {
    $id = $_GET['ansatte_id'];
    $sql_ansatte = "SELECT * FROM ansatte_tb WHERE ansatte_id = $id";
    $result = mysqli_query($conn, $sql_ansatte);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        
        $fornavn = $row['ansatte_fornavn'];
        $etternavn = $row['ansatte_etternavn'];
        $stilling = $row['ansatte_stilling'];
        $telefon = $row['ansatte_tlf_nr'];
        $epost = $row['ansatte_epost'];
        $kontakt = $row['ansatte_kontakt_person'];
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    echo "Error: 'ansatte_id' parameter is missing in the query string.";
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../stylesheets/stylesheet.css?v=1.0">
    <link rel="stylesheet" href="../stylesheets/ansatt_bedrift_edit.css?v=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-pwCHXNHXDBp4Zh3fCkGpMeWzHjwUC1n1br5x3IyVBFzbJRsN/l2M+SWdgZfjqxiS" crossorigin="anonymous">
    <title>Bedriftsportalen</title>
</head>
<body>

<main>
    <form method="POST" action="">
        <input type="hidden" name="ansatte_id" value="<?php echo $id ?>">
        <!-- Add a hidden input field to store ansatte_bedrifts_id -->
        <input type="hidden" name="ansatte_bedrifts_id" value="<?php echo $ansatte_bedrifts_id ?>">

        <label for="fornavn">Fornavn:</label>
        <input type="text" name="ansatte_fornavn" value="<?php echo $fornavn ?>"><br>

        <label for="etternavn">Etternavn:</label>
        <input type="text" name="ansatte_etternavn" value="<?php echo $etternavn ?>"><br>

        <label for="stilling">Stilling:</label>
        <input type="text" name="ansatte_stilling" value="<?php echo $stilling ?>"><br>

        <label for="telefon">Telefonnummer:</label>
        <input type="text" name="ansatte_tlf_nr" value="<?php echo $telefon ?>"><br>

        <label for="epost">E-post:</label>
        <input type="text" name="ansatte_epost" value="<?php echo $epost ?>"><br>

        <label for="kontakt">Kontakt person:</label>
        <select name="ansatte_kontakt_person" class="input-field">
        <option value="1" <?php if ($kontakt == 1) echo "selected"; ?>>Ja</option>
        <option value="0" <?php if ($kontakt == 0) echo "selected"; ?>>Nei</option>
        </select><br>

        <label for="bedrift_id">Bedrift</label>
        <div class="autocomplete">
            <input type="text" id="bedrift_search" name="bedrift_search" class="autocomplete" placeholder="Søk">
            <div class="autocomplete-items" id="bedrift_suggestions"></div>
            <span class="clear-btn" onclick="clearSearch()">Clear</span>
        </div>
        <!-- Hidden input field to store the selected bedrift_id -->
        <input type="hidden" id="bedrift_id" name="bedrift_id"> <br>

        <input type="submit" name="submit" value="Submit">
    </form>
</main>

<script src="../JavaScript/bedrift_search.js?v=1.0"></script>
<script src="../JavaScript/bedrift_suggestion.js?v=1.0"></script>
</body>
</html>
