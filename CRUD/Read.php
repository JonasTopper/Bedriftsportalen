<?php 

include 'connect.php';


if (isset($_GET['bedrift_id'])) {
    $id = $_GET['bedrift_id'];
    $sql_edit = "SELECT navn, adresse, postnummer, org_form, reg_dato, org_nr, beskrivelse, poststed FROM bedrifter WHERE ID = $id";
    $result_edit = mysqli_query($conn, $sql_edit);
    $dyr_og_eier= mysqli_fetch_assoc($result_edit);
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
    

    <h1> <?php echo $navn ?> </h1>

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