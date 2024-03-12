<?php
include 'CRUD/connect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheets/stylesheet.css" type="text/css">
    <title>Bedriftsportalen</title>
</head>
<body>
    <h1>Bedriftsportalen</h1>

    <main>
        <?php
        // Prosedyre for les
        $sql_les = "SELECT bedrift_id, navn FROM bedrifter";
        $resultat_les = mysqli_query($conn, $sql_les);
        $bedrifter = mysqli_fetch_all($resultat_les, MYSQLI_ASSOC);

        foreach($bedrifter as $bedrift) {
            $navn = $bedrift['navn'];
            $bedrift_id = $bedrift['bedrift_id'];
        ?>
        <a href="./CRUD/Read.php?bedrift_id=<?php echo $bedrift_id;?>">
            <div>
                <?php echo $navn ?>
                <img class="logo" src="images/logo_<?php echo $bedrift_id?>.png">
            </div>
        </a>
        <?php
        }
        ?>
    </main>

    <script src="JavaScript/script.js"></script>
</body>
</html>
