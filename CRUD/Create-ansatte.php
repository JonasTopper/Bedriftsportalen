<?php
include 'connect.php';

function CreateSQLRow($conn, $fornavn, $etternavn, $stilling, $kontakt_person, $tlf_nr, $epost, $bedrifts_id) {
    $sql = "INSERT INTO ansatte_tb (ansatte_fornavn, ansatte_etternavn, ansatte_stilling, ansatte_kontakt_person, ansatte_tlf_nr, ansatte_epost, ansatte_bedrifts_id) 
    VALUES ('$fornavn', '$etternavn', '$stilling', '$kontakt_person', '$tlf_nr', '$epost', '$bedrifts_id')";

    $run_query = mysqli_query($conn, $sql);

    if($run_query) {
        header("Location: Read.php?bedrift_id=$bedrifts_id"); //redirect
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

if (isset($_POST['submit'])) {
    $fornavn = $_POST['fornavn'];
    $etternavn = $_POST['etternavn'];
    $stilling = $_POST['stilling'];
    $kontakt_person = $_POST['kontakt_person'];
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-pwCHXNHXDBp4Zh3fCkGpMeWzHjwUC1n1br5x3IyVBFzbJRsN/l2M+SWdgZfjqxiS" crossorigin="anonymous">
    <title>Bedriftsportalen</title>
</head>
<body>
    <h1> Opprett Ansatte </h1>
    <main>
        <form id="bedriftForm" method="POST" action="Create-ansatte.php">
            <table>
                <thead>
                    <tr>
                        <th>Fornavn</th>
                        <td><input type="text" name="fornavn"></td>
                    </tr>
                    <tr>
                        <th>Etternavn</th>
                        <td><input type="text" name="etternavn"></td>
                    </tr>
                    <tr>
                        <th>Stilling</th>
                        <td><input type="text" name="stilling"></td>
                    </tr>
                    <tr>
                        <th>Kontaktperson</th>
                        <td>
                        <select name="kontakt_person" class="input-field">
                        <option value="1">Ja</option>
                        <option value="0">Nei</option>
                        </td>
                    </tr>
                    <tr>
                        <th>Telefonnummer</th>
                        <td><input type="text" name="tlf_nr"></td>
                    </tr>
                    <tr>
                        <th>Epost</th>
                        <td><input type="text" name="epost"></td>
                    </tr>
                    <tr>
                        <th>Bedriftid</th>
                        <td><input type="text" name="bedrift_id" value="<?php echo $_POST["bedrift_id"] ?>" readonly></td>
                    </tr>
                </thead>
            </table>
            <div class="submit-btn-container">
            <a onclick=goBack()><button type="button" class="back-btn-create-bedrift">Exit</button></a>
                <input type="submit" name="submit" class="submit-btn">
            </div>
        </form>
    </main>
    <script src="../JavaScript/post.js?v1.0"></script>
</body>
</html>
 
<script>
        function goBack() {
        window.history.back();
    }
</script>