<?php
include 'connect.php'; // Include database connection

// Initialize $result_bedrifter to null
$result_bedrifter = null;

// Check if bedrift_id is set in the URL
if (isset($_GET['bedrift_id'])) {
    $id = $_GET['bedrift_id'];
    // SQL query to retrieve everything from the bedrifter_tb table where bedrift_id matches $id
    $sql_bedrifter = "SELECT * FROM bedrifter_tb WHERE bedrift_id = $id";

    // Execute the query
    $result_bedrifter = mysqli_query($conn, $sql_bedrifter);

    if (!$result_bedrifter) {
        // If there's an error with the query, stop execution and display the error
        die("Query failed: " . mysqli_error($conn));
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../stylesheets/stylesheet.css?v=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-pwCHXNHXDBp4Zh3fCkGpMeWzHjwUC1n1br5x3IyVBFzbJRsN/l2M+SWdgZfjqxiS" crossorigin="anonymous">
    <title>Detaljer</title>
</head>

<body>
    <main>
        <button type="button" class="btn" onclick="goBack()">Hjem </button>
        <script>
            function goBack() {
                window.history.back();
            }
        </script>

        <h1 class="header-bedrift"> Bedriftdetaljer</h1>
        <table>
            <thead>
                <tr>
                    <th>Bedrift ID</th>
                    <th>Navn</th>
                    <th>Adresse</th>
                    <th>Postnummer</th>
                    <th>Poststed</th>
                    <th>Org form</th>
                    <th>Org nr</th>
                    <th>Reg dato</th>
                    <th>Beskrivelse</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Check if $result_bedrifter is not null
                if ($result_bedrifter !== null) {
                    // Check if there are any rows returned by the query
                    if (mysqli_num_rows($result_bedrifter) > 0) {
                        // Loop through each row fetched from the result set to display bedrifter information
                        while ($row = mysqli_fetch_assoc($result_bedrifter)) {
                ?>
                            <tr>
                                <td><?php echo $row['bedrift_id'] ?></td>
                                <td><?php echo $row['bedrift_navn'] ?></td>
                                <td><?php echo $row['bedrift_adresse'] ?></td>
                                <td><?php echo $row['bedrift_post_nr'] ?></td>
                                <td><?php echo $row['bedrift_post_sted'] ?></td>
                                <td><?php echo $row['bedrift_org_form'] ?></td>
                                <td><?php echo $row['bedrift_org_nr'] ?></td>
                                <td><?php echo $row['bedrift_reg_dato'] ?></td>
                                <td><?php echo $row['bedrift_beskrivelse'] ?></td>
                                <!-- Add more columns if necessary -->
                            </tr>
                <?php
                        }
                    } else {
                        // If no rows were returned by the query, display a message
                        echo "<tr><td colspan='9'>No results found.</td></tr>";
                    }
                } else {
                    // If $result_bedrifter is null, display an error message
                    echo "<tr><td colspan='9'>No bedrift ID provided.</td></tr>";
                }
                ?>
            </tbody>
        </table>
        <!-- Extra line breaks for spacing -->
        <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    </main>
</body>

</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
