<?php 

include 'connect.php';

// Dersom bedrift_id finnes 
if (isset($_GET['bedrift_id'])) {
    // Oppretter variabel for bedrift_id => Bruker GET
    $id = $_GET['bedrift_id'];
    // Opretter variabel for SELECT setning => Hvor bedrift_id => Ønsket ID
    $sql_edit = "SELECT navn, adresse, postnummer, org_form, reg_dato, org_nr, beskrivelse, poststed FROM bedrifter WHERE bedrift_id = $id";

    // Leser SQL => Hva skjer er egentlig? \o/
    $result_edit = mysqli_query($conn, $sql_edit);
    $bedrifter= mysqli_fetch_assoc($result_edit);

    // Dersom navn på bedrifter eksisterer => Hent => Print ut overskrift.
    if(isset($bedrifter['navn'])) {
        $navn = $bedrifter['navn'];
        ?>
        <h1> <?php echo $navn ?> </h1>
        <?php
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../stylesheets/stylesheet.css">
    <title> Bedriftsportalen </title>
</head>
<body>
    

    

    <a href="Create.php"><button type="button" class="btn"> Create</button></a>
    <a href="Read.php"><button type="button" class="btn"> Read</button></a>
    <a href="Update.php"><button type="button" class="btn"> Update</button></a>
    <a href="Delete.php"><button type="button" class="btn"> Delete</button></a>
    <a href="../index.php"><button type="button" class="btn"> Index</button></a>

    <main>
        <table>
            <thead>
                <tr>
                    <th>Bedrift ID</th>
                    <th>Navn</th>
                    <th>Adresse</th>
                    <th>Postnummer</th>
                    <th>Slett</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><a class="Update">Rediger</a></td>
                    <td><a class="Delete">Slett</a></td>
                 </tr>
            </tbody>
        </table>
    </main>

    <script src="JavaScript/script.js">
</body>
</html>