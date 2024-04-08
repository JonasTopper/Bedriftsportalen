<?php 

include 'connect.php';

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


// Dersom bedrift_id finnes 
if (isset($_GET['bedrift_id'])) {
    // Oppretter variabel for bedrift_id => Bruker GET
    $id = $_GET['bedrift_id'];
    // Opretter variabel for SELECT setning => Hvor bedrift_id => Ønsket ID
    
    $sql_edit = "SELECT * FROM bedrifter_tb 
              INNER JOIN ansatte_tb 
              ON bedrifter_tb.bedrift_id = ansatte_tb.ansatte_bedrifts_id
              WHERE ansatte_tb.ansatte_bedrifts_id = $id";
    // Leser SQL => Hva skjer er egentlig? \o/
    $result_edit = mysqli_query($conn, $sql_edit);

    if (!$result_edit) {
        // If there's an error with the query, stop execution and display the error
        die("Query failed: " . mysqli_error($conn));
    }

    // Check if there are any rows returned by the query
    if (mysqli_num_rows($result_edit) > 0) {
        // Fetch the first row to display bedrift information
        $first_row = mysqli_fetch_assoc($result_edit); ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="../stylesheets/stylesheet.css?v=1.0">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-pwCHXNHXDBp4Zh3fCkGpMeWzHjwUC1n1br5x3IyVBFzbJRsN/l2M+SWdgZfjqxiS" crossorigin="anonymous">
            <title>Bedriftsportalen</title>
            <style>
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
                    Jeg har lest og godtatt <u><a href="../terms_of_service.php"><u>Terms of Service</a> <input type="checkbox" id="accept-checkbox"><br><br><br>
                    <button class="terms-btn" type="submit" id="accept-button" name="accept_terms" disabled>Accept</button>
                </form>
            </div>
        </div>
    <?php endif; ?>
           <main>
            <h1 class="header-bedrift"><?php echo $first_row['bedrift_navn'] ?></h1>
            <table class="table">
                <thead>
                    <tr>
                        <th>Bedrift ID</th>
                        <th>Navn</th>
                        <th>Adresse</th>
                        <th>Postnummer</th>
                        <th>Poststed</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $first_row['bedrift_id'] ?></td>
                        <td><?php echo $first_row['bedrift_navn'] ?></td>
                        <td><?php echo $first_row['bedrift_adresse'] ?></td>
                        <td><?php echo $first_row['bedrift_post_nr'] ?></td>
                        <td><?php echo $first_row['bedrift_post_sted'] ?></td>
                        <td>
                            <div class="button-group">
                                <a href="Edit-bedrift.php?bedrift_id=<?php echo $id ?>"><button class="edit-btn-table">Rediger</button></a>
                                <a class="detaljer_kapp" href="Detailed-view-bedrift.php?bedrift_id=<?php echo $id ?>"><button class="details-btn-table">Detaljer</button></a>
                                <button class="delete-btn-table" onclick="confirmDeleteBedrift('<?php echo htmlspecialchars($first_row['bedrift_navn'])?>', '<?php echo htmlspecialchars($first_row['bedrift_id'])?>')">X</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

            <h1 class="header-ansatte">Ansatte</h1>
            <table class="table2">
                <thead>
                    <tr>
                        <th>Ansatt ID</th>
                        <th>Fornavn</th>
                        <th>Etternavn</th>
                        <th>E-post</th>
                        <th>Telefonnummer</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    // Reset the pointer to the beginning of the result set
                    mysqli_data_seek($result_edit, 0);
                    // Loop through each row fetched from the result set to display ansatte information
                    while ($row = mysqli_fetch_assoc($result_edit)) {
                        $ansatt_id = $row['ansatte_id'];
                        ?>
                        <tr>
                            <td><?php echo $row['ansatte_id'] ?></td>
                            <td><?php echo $row['ansatte_fornavn'] ?></td>
                            <td><?php echo $row['ansatte_etternavn'] ?></td>
                            <td><?php echo $row['ansatte_epost'] ?></td>
                            <td><?php echo $row['ansatte_tlf_nr'] ?></td>
                            <td>
                                <div class="button-group">
                                    <a href="Edit-ansatt.php?ansatte_id=<?php echo $ansatt_id ?>"><button class="edit-btn-table">Rediger</button></a>
                                    <a class="detaljer_kapp" href="Detailed-view-ansatte.php?ansatte_id=<?php echo $row['ansatte_id']?>"><button class="details-btn-table">Detaljer</button></a>
                                    <button class="delete-btn-table" onclick="confirmDeleteAnsatte('<?php echo htmlspecialchars($row['ansatte_fornavn'])?>', '<?php echo htmlspecialchars($row['ansatte_etternavn'])?>', '<?php echo $row['ansatte_id'] ?>')">X</button>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                         <td colspan="6">
                            <form action="Create-ansatte.php" method="post">
                                <button type="submit" class="bsc-btn">+</button>
                                <input type="hidden" name="bedrift_id" value="<?php echo $id ?>">
                            </form>
                        </td>
                </tbody>
            </table>
            </main>
        </body>
        </html>
        <?php
    } else {
        // If no rows were returned by the query, display only the bedrift information
        $bedrift_query = "SELECT * FROM bedrifter_tb WHERE bedrift_id = $id";
        $bedrift_result = mysqli_query($conn, $bedrift_query);
        $bedrift_row = mysqli_fetch_assoc($bedrift_result);

        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="../stylesheets/stylesheet.css?v=1.0">
            <link href="../stylesheets/stylesheet.css" rel="stylesheet">
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-pwCHXNHXDBp4Zh3fCkGpMeWzHjwUC1n1br5x3IyVBFzbJRsN/l2M+SWdgZfjqxiS" crossorigin="anonymous">
            <title> Bedriftsportalen </title>
        </head>
        <body>
           <main class="read-main">
            <h1 class="header-bedrift"><?php echo $bedrift_row['bedrift_navn'] ?></h1>
            <table class="table-read">
                <thead>
                    <tr>
                        <th>Bedrift ID</th>
                        <th>Navn</th>
                        <th>Adresse</th>
                        <th>Postnummer</th>
                        <th>Poststed</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $bedrift_row['bedrift_id'] ?></td>
                        <td><?php echo $bedrift_row['bedrift_navn'] ?></td>
                        <td><?php echo $bedrift_row['bedrift_adresse'] ?></td>
                        <td><?php echo $bedrift_row['bedrift_post_nr'] ?></td>
                        <td><?php echo $bedrift_row['bedrift_post_sted'] ?></td>
                        <td>
                            <div class="button-group">
                                <a href="Edit-bedrift.php?bedrift_id=<?php echo $id ?>"><button class="edit-btn-table">Rediger</button></a>
                                <a class="detaljer_kapp" href="Detailed-view-bedrift.php?bedrift_id=<?php echo $id ?>"><button class="details-btn-table">Detaljer</button></a>
                                <button class="delete-btn-table" onclick="confirmDeleteBedrift('<?php echo htmlspecialchars($bedrift_row['bedrift_navn'])?>', '<?php echo htmlspecialchars($bedrift_row['bedrift_id'])?>')">X</button>
                            </div>
                        </td>
                    </tr>
                </tbody>

            </table>

            <h1 class="header-ansatte">Ansatte</h1>
            <table class="table2">
                <thead class="table2head">
                <p>No ansatte found for this bedrift.</p>
                </thead>
            </table>
            <table>
                <tbody>
                    <tr>
                        <td colspan="6">
                            <form action="Create-ansatte.php" method="post">
                              
                                    <button type="submit" class="bsc-btn">+</button>
                                
                                <input type="hidden" name="bedrift_id" value="<?php echo $id ?>">
                            </form>
                        </td>
                </tbody>
            </table>
                    </tr>
                </tbody>
                </table>
            </main>
        </body>
        </html>
        <?php
    }

    mysqli_close($conn);
}
?>
<script src="../JavaScript/delete_confirmation.js"></script>
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