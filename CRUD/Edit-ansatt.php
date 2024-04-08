<?php
include 'connect.php'; // Include database connection file

// Check if the form is submitted
if (isset($_POST['submit'])) {

    // Retrieve employee ID from the form
    $id = $_POST['ansatte_id'];

    // Retrieve employee details from the form
    $fornavn = $_POST['ansatte_fornavn'];
    $etternavn = $_POST['ansatte_etternavn'];
    $stilling = $_POST['ansatte_stilling'];
    $telefon = $_POST['ansatte_tlf_nr'];
    $epost = $_POST['ansatte_epost'];
    $kontakt = $_POST['ansatte_kontakt_person'];

    // Retrieve bedrift ID from the form
    $bedrift_id = $_POST['bedrift_id'];

    // If bedrift ID is not provided, retrieve it from the database based on employee ID
    if (empty($bedrift_id)) {
        // SQL query to get bedrift ID associated with the employee
        $sql_current_bedrift = "SELECT ansatte_bedrifts_id FROM ansatte_tb WHERE ansatte_id = $id";
        $result_current_bedrift = mysqli_query($conn, $sql_current_bedrift);

        // Check if the query executed successfully
        if ($result_current_bedrift && mysqli_num_rows($result_current_bedrift) > 0) {
            $row_current_bedrift = mysqli_fetch_assoc($result_current_bedrift);
            $bedrift_id = $row_current_bedrift['ansatte_bedrifts_id'];
        } else {
            // Display error message if unable to retrieve bedrift ID
            echo "Error: Unable to retrieve current bedrifts_id.";
            exit();
        }
    }

    // Update employee details in the database
    $sql_update = "UPDATE ansatte_tb 
                   SET ansatte_fornavn = '$fornavn', ansatte_etternavn = '$etternavn', 
                       ansatte_stilling = '$stilling', ansatte_tlf_nr = '$telefon',
                       ansatte_epost = '$epost', ansatte_kontakt_person = '$kontakt',
                       ansatte_bedrifts_id = '$bedrift_id' 
                   WHERE ansatte_id = $id";
    $result_update = mysqli_query($conn, $sql_update);

    // Check if the update was successful
    if ($result_update) {
        // Redirect to the employee details page
        header("Location: read.php?bedrift_id=$bedrift_id");
        exit();
    } else {
        // Display error message if update fails
        echo "Error updating record: " . mysqli_error($conn);
    }
}

// Retrieve employee details for editing
if (isset($_GET['ansatte_id'])) {
    $id = $_GET['ansatte_id'];
    $sql_ansatte = "SELECT * FROM ansatte_tb WHERE ansatte_id = $id";
    $result = mysqli_query($conn, $sql_ansatte);

    // Check if employee details are retrieved successfully
    if ($result) {
        $row = mysqli_fetch_assoc($result);

        // Assign retrieved employee details to variables
        $fornavn = $row['ansatte_fornavn'];
        $etternavn = $row['ansatte_etternavn'];
        $stilling = $row['ansatte_stilling'];
        $telefon = $row['ansatte_tlf_nr'];
        $epost = $row['ansatte_epost'];
        $kontakt = $row['ansatte_kontakt_person'];
        $ansatte_bedrifts_id = $row['ansatte_bedrifts_id'];
    } else {
        // Display error message if retrieval fails
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // Display error message if employee ID is missing
    echo "Error: 'ansatte_id' parameter is missing in the query string.";
}

mysqli_close($conn); // Close database connection
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

            <div class="edit-input-container">
                <label for="fornavn">Fornavn:</label>
                <input type="text" name="ansatte_fornavn" value="<?php echo $fornavn ?>"><br>
            </div>

            <div class="edit-input-container">
                <label for="etternavn">Etternavn:</label>
                <input type="text" name="ansatte_etternavn" value="<?php echo $etternavn ?>"><br>
            </div>

            <div class="edit-input-container">
                <label for="stilling">Stilling:</label>
                <input type="text" name="ansatte_stilling" value="<?php echo $stilling ?>"><br>
            </div>

            <div class="edit-input-container">
                <label for="telefon">Telefonnummer:</label>
                <input type="text" name="ansatte_tlf_nr" value="<?php echo $telefon ?>"><br>
            </div>

            <div class="edit-input-container">
                <label for="epost">E-post:</label>
                <input type="text" name="ansatte_epost" value="<?php echo $epost ?>"><br>
            </div>

            <div class="edit-input-container">
                <label for="kontakt">Kontakt person:</label>
                <select name="ansatte_kontakt_person" class="input-field">
                    <option value="1" <?php if ($kontakt == 1) echo "selected"; ?>>Ja</option>
                    <option value="0" <?php if ($kontakt == 0) echo "selected"; ?>>Nei</option>
                </select><br>
            </div>

            <div class="edit-input-container">
                <label for="bedrift_id">Bedrift</label>
                <div class="autocomplete">
                    <input type="text" id="bedrift_search" name="bedrift_search" class="autocomplete" placeholder="Søk">
                    <div class="autocomplete-items" id="bedrift_suggestions"></div>
                    <span class="clear-btn" onclick="clearSearch()">Clear</span>
                </div>
            </div>
            <!-- Hidden input field to store the selected bedrift_id -->


            <input type="hidden" id="bedrift_id" name="bedrift_id"> <br>
            <input type="button" name="exit" value="Tilbake" onclick=goBack() class="back-btn">
            <input class="btn" type="submit" name="submit" value="Submit">

        </form>
    </main>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
    <script src="../JavaScript/bedrift_search.js?v=1.0"></script>
    <script src="../JavaScript/bedrift_suggestion.js?v=1.0"></script>
</body>

</html>