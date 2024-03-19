<?php
include 'CRUD/connect.php';



// Prosedyre for les
$sql_les = "SELECT bedrift_id, bedrift_navn FROM bedrifter_tb";
$resultat_les = mysqli_query($conn, $sql_les);
$bedrifter = mysqli_fetch_all($resultat_les, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesheets/stylesheet.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-pwCHXNHXDBp4Zh3fCkGpMeWzHjwUC1n1br5x3IyVBFzbJRsN/l2M+SWdgZfjqxiS" crossorigin="anonymous">
    <title>Bedriftsportalen</title>
</head>
<body>
    <h1>Bedriftsportalen</h1>

        <div class="create-delete-edit">

            <div class="create-btn">
                <a href="CRUD/Create-bedrift.php" ><button> + </button></a>
            </div>

            <div class="delete-btn">
                <a href="x.php" ><button> Remove </button></a>
            </div>

        </div>
    <main>





        <?php
        foreach($bedrifter as $bedrift) {
            $navn = $bedrift['bedrift_navn'];
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
