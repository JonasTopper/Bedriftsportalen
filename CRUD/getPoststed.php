<?php
// Include the database connection file
include 'connect.php';

// Check if the postnummer parameter is set in the request
if (isset($_GET['postnummer'])) {
    // Sanitize the input
    $postnummer = mysqli_real_escape_string($conn, $_GET['postnummer']);

    // SQL query to fetch the corresponding poststed based on postnummer
    $sql = "SELECT poststed FROM postinformasjon_tb WHERE postnummer = '$postnummer'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch the poststed
        $row = mysqli_fetch_assoc($result);
        $poststed = $row['poststed'];

        // Return the poststed as response
        echo $poststed;
    } else {
        // If no matching poststed found, return a default message
        echo "Error: Feil postnummer";
    }
} else {
    // If postnummer parameter is not set, return an error message
    echo "Error: Postnummer parameter is missing";
}
