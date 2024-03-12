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
    
    <a href="../index.php"><button type="button" class="btn">&#8592 Hjem! </button></a>


    <table class="table">
    <thead>
        <tr>
            <th>Bedrift ID</th>
            <th>Navn</th>
            <th>Adresse</th>
            <th>Postnummer</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        
        <tr>

            <!-- Rediger denne, endre lenken. takk <3 -->
                
                <td>1</td>

                <td>Bedrift A</td>

                <td>Gateveien 123</td>

                <td>1234</td>

            <td>
                <div class="button-group">
                    <button class="details-btn-table">Detaljer</button>
                    <button class="edit-btn-table">Rediger</button>
                    <button class="delete-btn-table">Slett</button>
                </div>
            </td>
        </tr>
    </tbody>
</table>



    <script src="JavaScript/script.js">
</body>
</html>