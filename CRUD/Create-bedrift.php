<?php 
include 'connect.php';

function CreateSQLRow($conn, $navn, $adresse, $orgform, $orgnummer, $postnummer, $poststed) {
    
    $sql = "INSERT INTO bedrifter_tb (bedrift_navn, bedrift_adresse, bedrift_org_form, bedrift_org_nr, bedrift_post_nr, bedrift_post_sted) VALUES ('$navn', '$adresse', '$orgform', '$orgnummer', '$postnummer', '$poststed')";

    
    $run_query = mysqli_query($conn, $sql);

    if($run_query) {
        header("Location: http://localhost/Bedriftsportalen/index.php"); 
        exit();
    } else {
        echo "Error: " . mysqli_error($conn); 
    }
}

if(isset($_POST['submit'])) {
    $navn = $_POST['navn'];
    $adresse = $_POST['adresse'];
    $postnummer = $_POST['postnummer'];
    $poststed = $_POST['poststed'];
    $orgform = $_POST['orgform'];
    $orgnummer = $_POST['orgnummer'];
    
    CreateSQLRow($conn, $navn, $adresse, $orgform, $orgnummer, $postnummer, $poststed);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../stylesheets/stylesheet.css">
    <title>Bedriftsportalen</title>
</head>
<body>
    

    <h1> Legg til bedrifter </h1>


    <main>
        <table>
            <thead>
                <form method="POST" action="Create-bedrift.php">
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
                    <td><input type="text" name="postnummer"></td>
                </tr>
                <tr>
                    <th>Poststed</th>
                    <td><input type="text" name="poststed"></td>
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
           
            <tbody>

            </tbody>

        </table>

    <div class="submit-btn-container">
        <a href="../index.php"><button type="button" class="back-btn">Exit</button></a>
        <input type="submit" name="submit" class="submit-btn">
    </div>

    </form>
    </main>


    <script src="JavaScript/script.js"></script>
</body>
</html>
