<?php
include 'CRUD/connect.php';

// Check if the user has already accepted the terms
$termsAccepted = isset($_COOKIE['terms_accepted']);

if (!$termsAccepted && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accept_terms'])) {
    // User has accepted the terms, set a cookie to remember the choice for a period of time
    setcookie('terms_accepted', 'true', time() + (365 * 24 * 60 * 60), '/'); // Cookie lasts for 1 year
    $termsAccepted = true;
}

header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// Prosedyre for les
$sql_les = "SELECT bedrift_id, bedrift_navn, bedrift_logo_filepath FROM bedrifter_tb";
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
    <style>
        /* Styles for the popup */
        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 999;
        }

        .popup-content {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            max-width: 80%;
            text-align: center;
        }

        .popup-buttons {
            margin-top: 20px;
        }

        /* Style for disabled button */
        .terms-btn[disabled] {
            opacity: 0.5;
            cursor: not-allowed;
            min-width: 95px;
            min-height: 30px;
            border-radius: 10px;
        }

        /* Style for enabled button */
        .terms-btn:not([disabled]) {
            background-color: #3E92CC;
            color: white;
            min-width: 95px;
            min-height: 30px;
            border-radius: 10px;
            border: none;
        }

        .terms-btn:not([disabled]):hover {
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.701);
            border: 1px;
        }


    </style>
</head>

<body>
    <?php if (!$termsAccepted) : ?>
        <!-- Popup for accepting terms -->
        <div class="popup-overlay" id="popup">
            <div class="popup-content">
                <h2>Terms of Service</h2>
                <p>Vennligst les og godta Terms of Service før du benytter deg av tjenesten.</p>
                <form id="accept-form" method="post">
                    Jeg har lest og godtatt <u><a href="terms_of_service.php"><u>Terms of Service</a> <input type="checkbox" id="accept-checkbox"><br><br><br>
                    <button class="terms-btn" type="submit" id="accept-button" name="accept_terms" disabled>Accept</button>
                </form>
            </div>
        </div>
    <?php endif; ?>

    <!-- Rest of your HTML content -->
    <a href="CRUD/alle_ansatte.php"><button class="alle-view-btn" type="button" href="alle_ansatte">Alle ansatte</button></a>
    <a href="CRUD/alle_bedrifter.php"><button class="alle-view-btn" type="button" href="alle_bedrifter">Alle bedrifter</button></a>

    <div class="logo-main-con">
        <img class="logo-main" src="images/logo_no_slogan.png">
    </div>
    
    <div class="create-delete-edit">
        <div class="create-btn">
            <a href="CRUD/Create-bedrift.php"><button class="main-pg-btn"> + </button></a>
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
                            $logo_src = $bedrift["bedrift_logo_filepath"];
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
    <script>
        // JavaScript function to handle accepting terms
        function acceptTerms() {
            // Close the popup
            document.getElementById("popup").style.display = "none";
        }

        // Check if terms have been accepted before showing the popup
        if (!<?php echo json_encode($termsAccepted); ?>) {
            document.getElementById("popup").style.display = "flex";
        }

        // Add event listener to the checkbox
        document.getElementById("accept-checkbox").addEventListener("change", function() {
            // Enable/disable the accept button based on checkbox state
            document.getElementById("accept-button").disabled = !this.checked;
        });
    </script>
</body>

</html>
