<?php 
include 'connect.php';

if (isset($_GET["bedriftid"]) || isset($_GET["ansattid"])) {
    if (isset($_GET["bedriftid"])) {
        $id = $_GET["bedriftid"];
        $sql = "SELECT bedrift_logo_filepath FROM bedrifter_tb WHERE bedrift_id = $id";
        $result = mysqli_query($conn, $sql); 
        if ($result) {
            $row = mysqli_fetch_assoc($result); 
            $filepath =  "../" . $row["bedrift_logo_filepath"]; 
            if ($filepath) {
                unlink($filepath); 
            }
        } else {
            echo "Error: " . mysqli_error($conn);
            exit(); 
        }
        
        $sql = "DELETE FROM bedrifter_tb WHERE bedrift_id = $id";
        if(mysqli_query($conn, $sql)) {
            header("Location: ../index.php?deletion=true");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
            exit(); 
        }
    }

    if (isset($_GET["ansattid"])) {
        $id = $_GET["ansattid"];
        $sql = "DELETE FROM ansatte_tb WHERE ansatte_id = $id";
        if(mysqli_query($conn, $sql)) {
            header("Location: {$_SERVER['HTTP_REFERER']}");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
            exit(); 
        }
    }
}
?>
