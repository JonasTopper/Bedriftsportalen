<?php

include '../CRUD/connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define variables and initialize with empty values
    $username = $password = $confirm_password = "";

    //Validate username
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } else {
        //Prepare a select statement to check if the username already exists
        $sql = "SELECT bedrifter_id FROM bedrifter_innlogging_tb WHERE bedrifter_brukernavn = ?";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Binding variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Setting parameters
            $param_username = trim($_POST["username"]);

            // Attempting to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Storing the result
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "This username is already taken.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Closing the statement
        mysqli_stmt_close($stmt);
    }

    // validating password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 8) {
        $password_err = "Password must have at least 8 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validating password confirmation 
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm a password";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    // Check input errors before inserting into database
    if (empty($username_err) && empty($password_err) && empty($confirm_password_err)) {

        // Prepare an insert statement
        $sql = "INSERT INTO bedrifter_innlogging_tb (bedrifter_brukernavn, bedrifter_passord) VALUES (?, ?)";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "ss", $param_username, $param_password);

            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Hashing

            // Execute
            if (mysqli_stmt_execute($stmt)) {
                //Redirect
                header("location: log-in.php");
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // Closing
        mysqli_stmt_close($stmt);
    }

    // Closing connection
    mysqli_close($conn);
}
