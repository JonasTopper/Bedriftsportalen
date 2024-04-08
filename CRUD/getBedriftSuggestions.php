<?php
// Include the database connection file
include 'connect.php';

// Check if the query parameter is set in the URL
if (isset($_GET['query'])) {
    // Get the input query from the URL
    $query = $_GET['query'];

    // Prepare the SQL statement to search for bedrifts whose names contain the input query
    $sql = "SELECT bedrift_id, bedrift_navn FROM bedrifter_tb WHERE bedrift_navn LIKE ?";

    // Prepare the SQL statement
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        // Bind the input query to the SQL statement
        $param = "%$query%";
        $stmt->bind_param("s", $param);

        // Execute the SQL statement
        $stmt->execute();

        // Get the result set
        $result = $stmt->get_result();

        // Create an array to store the suggestions
        $suggestions = array();

        // Fetch rows from the result set
        while ($row = $result->fetch_assoc()) {
            // Add each bedrift suggestion to the array
            $suggestions[] = $row;
        }

        // Close the statement
        $stmt->close();

        // Encode the suggestions array as JSON and output it
        echo json_encode($suggestions);
    } else {
        // If the statement preparation fails, return an empty array
        echo json_encode(array());
    }
} else {
    // If the query parameter is not set, return an empty array
    echo json_encode(array());
}

// Close the database connection
$conn->close();
