<?php
include 'CRUD/connect.php';

header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

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
    <link rel="stylesheet" href="stylesheets/stylesheet.css?v=1.0" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-pwCHXNHXDBp4Zh3fCkGpMeWzHjwUC1n1br5x3IyVBFzbJRsN/l2M+SWdgZfjqxiS" crossorigin="anonymous">
    <title>Bedriftsportalen</title>
</head>

<body>
    <div class="logo-main-con">
    <img class="logo-main" src="images/logo.png">
</div>
    <div class="create-delete-edit">

        <div class="create-btn">
            <a href="CRUD/Create-bedrift.php"><button> + </button></a>
        </div>
    </div>
    <main>
        <div class="slider">
            <div class="slide">
                <?php foreach ($bedrifter as $bedrift) : ?>
                    <div class="bedrift">
                        <a href="./CRUD/Read.php?bedrift_id=<?php echo $bedrift['bedrift_id']; ?>">
                            <?php
                            $bedrift_id = $bedrift['bedrift_id'];
                            $bedrift_navn = $bedrift['bedrift_navn'];
                            $logo_src_png = "images/logo_" . strtolower(str_replace(" ", "_", $bedrift_navn)) . ".png";
                            $logo_src_jpg = "images/logo_" . strtolower(str_replace(" ", "_", $bedrift_navn)) . ".jpg";
                            
                            $logo_src = (file_exists($logo_src_png)) ? $logo_src_png : (file_exists($logo_src_jpg) ? $logo_src_jpg : "images/no-image.png");
                            ?>
                            <img class="logo" src="<?php echo $logo_src; ?>" alt="Logo">
                            <p class="bedrift-navn"><?php echo $bedrift['bedrift_navn']; ?></p>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>
    <script src="JavaScript/script.js?=v1.0"></script>
</body>

</html>