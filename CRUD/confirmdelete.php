<?php 

include 'connect.php';

if (isset($_GET["bedriftid"]) or isset($_GET["ansattid"])) {
   if (isset($_GET["bedriftid"])) {
    $id = $_GET["bedriftid"];
    $sql = "DELETE FROM bedrifter_tb WHERE bedrift_id = $id";
    if(mysqli_query($conn, $sql)) {
        header("Location: ../index.php");
        exit();
    }
   }
   if (isset($_GET["ansattid"])) {
    $id = $_GET["ansattid"];
    $sql = "DELETE FROM ansatte_tb WHERE ansatte_id = $id";
    if(mysqli_query($conn, $sql)) {
        header("Location: {$_SERVER['HTTP_REFERER']}");
        exit();
    }
   }
}

?>