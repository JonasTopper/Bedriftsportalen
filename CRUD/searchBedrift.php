<?php
// Include the database connection file
include 'connect.php';

// Check if the search query parameter is set
if (isset($_GET['q'])) {
    // Sanitize the search query
    $searchQuery = mysqli_real_escape_string($conn, $_GET['q']);

    // Prepare the SQL statement to search for the bedrift
    $sql = "SELECT bedrift_id FROM bedrifter_tb WHERE bedrift_navn LIKE '%$searchQuery%' LIMIT 1";

    // Execute the SQL statement
    $result = mysqli_query($conn, $sql);

    // Check if the query was successful and if a bedrift was found
    if ($result && mysqli_num_rows($result) > 0) {
        // Fetch the first row to get the bedrift ID
        $row = mysqli_fetch_assoc($result);
        $bedriftId = $row['bedrift_id'];

        // Prepare the bedrift data as JSON
        $bedriftData = array(
            'id' => $bedriftId
        );

        // Output the bedrift data as JSON
        header('Content-Type: application/json');
        echo json_encode($bedriftData);
    } else {
        // If no bedrift was found, return an empty response
        echo json_encode(array());
    }
} else {
    // If the search query parameter is not set, return an empty response
    echo json_encode(array());
}

// Close the database connection
mysqli_close($conn);