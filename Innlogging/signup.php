<?php
include '../CRUD/connect.php';

// Initialize variables for form validation
$username_err = $password_err = $confirm_password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process form data when the form is submitted

    // Validate username
    $input_username = trim($_POST["username"]);
    // Check if username is empty
    if (empty($input_username)) {
        $username_err = "Please enter a username.";
    } else {
        // Prepare a select statement to check if the username already exists in the database
        $sql = "SELECT bedrifter_id FROM bedrifter_innlogging_tb WHERE bedrifter_brukernavn = ?";
        // Execute prepared statement
        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            // Set parameters
            $param_username = $input_username;
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);
                // Check if username already exists
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "This username is already taken.";
                } else {
                    $username = $input_username;
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate password
    $input_password = trim($_POST["password"]);
    // Check if password is empty
    if (empty($input_password)) {
        $password_err = "Please enter a password.";
    } elseif (strlen($input_password) < 8) {
        $password_err = "Password must have at least 8 characters.";
    } else {
        $password = $input_password;
    }

    // Validate confirm password
    $input_confirm_password = trim($_POST["confirm_password"]);
    // Check if confirm password is empty
    if (empty($input_confirm_password)) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = $input_confirm_password;
        // Check if passwords match
        if ($input_password != $input_confirm_password) {
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input errors before inserting into database
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO bedrifter_innlogging_tb (bedrifter_brukernavn, bedrifter_passord) VALUES (?, ?)";
        // Execute prepared statement
        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);
            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to login page
                header("location: Login.php");
                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($conn);
}