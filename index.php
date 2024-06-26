<?php
include 'CRUD/connect.php';

session_start();

// Variable for search functionality
$newSearchQuery = '';

// Redirect to login page if user is not logged in
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("Location: Innlogging/Login.php");
    exit;
}

// Get user details from session
$user_id = $_SESSION["id"];
$user_name = $_SESSION["username"];
$user_admin = $_SESSION["is_admin"];

// Redirect non-admin users to their profile page
if ($user_admin != 1) {
    header("Location: CRUD/Read_User.php?bedrift_id=" . $user_id);
    exit;
}

// Check if the user has already accepted the terms
$termsAccepted = isset($_COOKIE['terms_accepted']);

// Set terms accepted cookie when form is submitted
if (!$termsAccepted && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['accept_terms'])) {
    setcookie('terms_accepted', 'true', time() + (365 * 24 * 60 * 60), '/'); // Cookie lasts for 1 year
    $termsAccepted = true;
}

// Prevent caching of the page
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// Fetch all bedrifter for display
$sql_les = "SELECT bedrift_id, bedrift_navn, bedrift_logo_filepath FROM bedrifter_tb";
$resultat_les = mysqli_query($conn, $sql_les);
$bedrifter = mysqli_fetch_all($resultat_les, MYSQLI_ASSOC);

// Search functionality
$newSearchQuery = isset($_GET['search']) ? $_GET['search'] : '';
if (!empty($newSearchQuery)) {
    // Modify the SQL query to fetch data based on the search criteria
    $sql_les = "SELECT bedrift_id, bedrift_navn, bedrift_logo_filepath FROM bedrifter_tb WHERE bedrift_navn LIKE '%$newSearchQuery%' OR bedrift_id LIKE '%$newSearchQuery%'";
    $resultat_les = mysqli_query($conn, $sql_les);
    $bedrifter = mysqli_fetch_all($resultat_les, MYSQLI_ASSOC);
}
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


        /* Search bar style */

        .search-container {
            margin-bottom: 20px;
            text-align: center;
        }

        .search-container input[type="text"] {
            width: 300px;
            height: 30px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .search-container button {
            height: 40px;
            padding: 5px 15px;
            background-color: #3E92CC;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .search-container button:hover {
            background-color: #357ea8;
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
    <a href="CRUD/alle_ansatte.php"><button class="alle-view-btn" type="button">Alle ansatte</button></a>
    <a href="CRUD/alle_bedrifter.php"><button class="alle-view-btn" type="button">Alle bedrifter</button></a>
    <a href="Innlogging/logout.php"><button class="alle-view-btn" type="button">Logg ut</button></a>

    <div class="logo-main-con">
        <img class="logo-main" src="images/logo_no_slogan.png">
    </div>

    <div class="create-delete-edit">
        <div class="create-btn">
            <a href="CRUD/Create-bedrift.php"><button class="main-pg-btn"> + </button></a>
        </div>
    </div>
    <main>

        <!-- #region  -->
        <div class="search-container">
            <form action="index.php" method="get">
                <input type="text" id="bedrift-search" name="search" placeholder="Search by bedrift name...🔍" value="<?php echo htmlspecialchars($newSearchQuery); ?>">
                <button type="submit">Search</button>
            </form>

        </div>

        <div class="slider">
            <div class="slide">
                <?php foreach ($bedrifter as $bedrift) : ?>
                    <div class="bedrift">
                        <a href="./CRUD/Read.php?bedrift_id=<?php echo $bedrift['bedrift_id']; ?>">
                            <?php
                            $bedrift_id = $bedrift['bedrift_id'];
                            $bedrift_navn = $bedrift['bedrift_navn'];
                            $logo_src = $bedrift["bedrift_logo_filepath"];
                            if (empty($logo_src) || !file_exists($logo_src)) {
                                $logo_src = "Images/no-image.png";
                            }
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