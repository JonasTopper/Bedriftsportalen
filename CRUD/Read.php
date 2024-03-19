<?php 

include 'connect.php';

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
            <?php // Fetch the first row to display bedrift information
            $first_row = mysqli_fetch_assoc($result_edit); ?>
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
                                <button class="details-btn-table">Detaljer</button>
                                <button class="edit-btn-table">Rediger</button>
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
                        ?>
                        <tr>
                            <td><?php echo $row['ansatte_id'] ?></td>
                            <td><?php echo $row['ansatte_fornavn'] ?></td>
                            <td><?php echo $row['ansatte_etternavn'] ?></td>
                            <td><?php echo $row['ansatte_epost'] ?></td>
                            <td><?php echo $row['ansatte_tlf_nr'] ?></td>
                            <td>
                                <div class="button-group">
                                    <button class="edit-btn-table">Rediger</button>
                                </div>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>

        </body>
        </html>
        <?php
    } else {
        // If no rows were returned by the query, display a message
        echo "No results found.";
    }

    mysqli_close($conn);
}
?>
