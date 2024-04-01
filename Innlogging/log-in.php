<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include "../CRUD/connect.php";

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT bedrifter_passord FROM bedrifter_innlogging_tb WHERE bedrifter_brukernavn = ?";

    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        // Binding parameters and executing the statement
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);

        //Binding the result variable and fetching the hashed password
        mysqli_stmt_bind_result($stmt, $hashed_password);

        if (mysqli_stmt_fetch($stmt)) {
            if (password_verify($password, $hashed_password)) {
                $_SESSION["username"] = $username;
                header("Location: ../index.php");
                exit();
            } else {
                $login_error = "Invalid username or password.";
            }
        } else {
            $login_error = "Invalid username or password.";
        }
        

    mysqli_close($conn);
} 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../stylesheets/stylesheet.css">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php if (isset($login_error)) { ?>
        <div><?php echo $login_error; ?> </div>
    <?php } ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
    </div>
    <div>
        <button type="submit">Login</button>
    </div>
</form>
</body>
</html>