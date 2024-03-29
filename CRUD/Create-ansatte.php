<?php
include 'connect.php';

function CreateSQLRow($conn, $fornavn, $etternavn, $stilling, $kontakt_person, $tlf_nr, $epost, $bedrifts_id) {
    $sql = "INSERT INTO ansatte_tb (ansatte_fornavn, ansatte_etternavn, ansatte_stilling, ansatte_kontakt_person, ansatte_tlf_nr, ansatte_epost, ansatte_bedrifts_id) 
    VALUES ('$fornavn', '$etternavn', '$stilling', '$kontakt_person', '$tlf_nr', '$epost', '$bedrifts_id')";

    $run_query = mysqli_query($conn, $sql);

    if($run_query) {
        header("Location: ../ "); //redirect
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

if (isset($_POST['submit'])) {
    $fornavn = $_POST['fornavn'];
    $etternavn = $_POST['etternavn'];
    $stilling = $_POST['stilling'];
    $kontakt_person = isset($_POST['kontakt_person']) ? 1 : 0; 
    $tlf_nr = $_POST['tlf_nr'];
    $epost = $_POST['epost'];
    $bedrifts_id = $_POST['bedrift_id'];

    CreateSQLRow($conn, $fornavn, $etternavn, $stilling, $kontakt_person, $tlf_nr, $epost, $bedrifts_id);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../stylesheets/stylesheet.css?v=1.0">
    <title>Bedriftsportalen</title>
</head>
<body>
    <h1> Create ansatte </h1>
    <main>
        <form id="bedriftForm" method="POST" action="Create-ansatte.php">
            <table>
                <thead>
                    <tr>
                        <th>Navn</th>
                        <td><input type="text" name="navn"></td>
                    </tr>
                    <tr>
                        <th>Adresse</th>
                        <td><input type="text" name="adresse"></td>
                    </tr>
                    <tr>
                        <th>Postnummer</th>
                        <td><input type="text" name="postnummer" id="postnummer" maxlength="4"></td>
                    </tr>
                    <tr>
                        <th>Poststed</th>
                        <td><input type="text" name="poststed" id="poststed"></td>
                    </tr>
                    <tr>
                        <th>Org-form</th>
                        <td><input type="text" name="orgform"></td>
                    </tr>
                    <tr>
                        <th>Org-nummer</th>
                        <td><input type="text" name="orgnummer"></td>
                    </tr>
                </thead>
            </table>
            <div class="submit-btn-container">
                <a href="../"><button type="button" class="back-btn">Exit</button></a>
                <input type="submit" name="submit" class="submit-btn">
            </div>
        </form>
    </main>
    <script src="../JavaScript/post.js?v1.0"></script>
</body>
</html>
