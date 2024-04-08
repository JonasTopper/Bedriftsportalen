<?php 
include 'connect.php';

function getSmallestAvailableBedriftId($conn) {
    $smallest_id = 1;
    
    // Check if the smallest_id is already used, if so, find the next available id
    while (true) {
        $sql_check = "SELECT * FROM bedrifter_tb WHERE bedrift_id = $smallest_id";
        $result_check = mysqli_query($conn, $sql_check);
        if (mysqli_num_rows($result_check) == 0) {
            break; // Found an available id
        }
        $smallest_id++; // Try next id
    }
    
    return $smallest_id;
}


function CreateSQLRow($conn, $navn, $adresse, $orgform, $orgnummer, $postnummer, $poststed, $logo_path, $er_kunde, $beskrivelse) {
    // Get the smallest available bedrift_id
    $bedrift_id = getSmallestAvailableBedriftId($conn);
    
    // Get current date in "YYYY-MM-DD" format
    $reg_date = date("Y-m-d");
    
    // Convert boolean value to 1 or 0 for database insertion
    $er_kunde = $er_kunde ? 1 : 0;
    
    $sql = "INSERT INTO bedrifter_tb (bedrift_id, bedrift_navn, bedrift_adresse, bedrift_org_form, bedrift_org_nr, bedrift_post_nr, bedrift_post_sted, bedrift_logo_filepath, bedrift_reg_dato, bedrift_er_kunde, bedrift_beskrivelse) 
            VALUES ('$bedrift_id', '$navn', '$adresse', '$orgform', '$orgnummer', '$postnummer', '$poststed', '$logo_path', '$reg_date', '$er_kunde', '$beskrivelse')";
    
    $run_query = mysqli_query($conn, $sql);

    if($run_query) {
        return true;
    } else {
        echo "Error: " . mysqli_error($conn); 
        return false;
    }
}

if(isset($_POST['submit'])) {
    $navn = $_POST['navn'];
    $adresse = $_POST['adresse'];
    $postnummer = $_POST['postnummer'];
    $sql = "SELECT poststed FROM postinformasjon_tb WHERE postnummer = '$postnummer'";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $poststed = $row['poststed'];
    } else {
        $poststed = ""; 
    }
    $orgform = $_POST['orgform'];
    $orgnummer = $_POST['orgnummer'];
    $er_kunde = isset($_POST['er_kunde']) ? true : false; // Check if checkbox is checked
    $beskrivelse = $_POST['beskrivelse'];
    
    
    $upload_path = ""; 
    if (isset($_FILES["logo"]) && $_FILES["logo"]["error"] == UPLOAD_ERR_OK) {
        $bedrift_name = $_POST["navn"]; 
        $upload_dir = "images/";
        $logo_name = "logo_" . strtolower(str_replace(" ", "_", $bedrift_name));
        $file_extension = pathinfo($_FILES["logo"]["name"], PATHINFO_EXTENSION);
        $upload_path = $upload_dir . $logo_name . "." . $file_extension;
        $upload_path_temp = "../" . $upload_dir . $logo_name . "." . $file_extension;
        
        if (move_uploaded_file($_FILES["logo"]["tmp_name"], $upload_path_temp)) {
            echo "Logo uploaded successfully.";
        } else {
            echo "Error uploading logo.";
            exit(); 
        }
    }
    
    
    if (CreateSQLRow($conn, $navn, $adresse, $orgform, $orgnummer, $postnummer, $poststed, $upload_path, $er_kunde, $beskrivelse)) {
        header("Location: ../");
        exit();
    } else {
        echo "Error inserting data into database.";
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
    <title>Bedriftsportalen</title>
</head>
<body>
    <h1>Legg til bedrifter</h1>
    <main>
        <form id="bedriftForm" method="POST" action="Create-bedrift.php" enctype="multipart/form-data">
            <table>
                <thead>
                    <tr>
                        <th>Navn</th>
                        <td><input type="text" name="navn" required></td>
                    </tr>
                    <tr>
                        <th>Adresse</th>
                        <td><input type="text" name="adresse" required></td>
                    </tr>
                    <tr>
                        <th>Postnummer</th>
                        <td><input type="text" name="postnummer" id="postnummer" maxlength="4" required></td>
                    </tr>
                    <tr>
                        <th>Poststed</th>
                        <td><input type="text" name="poststed" id="poststed" required></td>
                    </tr>
                    <tr>
                        <th>Org-form</th>
                        <td><input type="text" name="orgform" required></td>
                    </tr>
                    <tr>
                        <th>Org-nummer</th>
                        <td><input type="text" name="orgnummer" required></td>
                    </tr>
                    <tr>
                        <th>Er kunde</th>
                        <td><input type="checkbox" name="er_kunde"></td>
                    </tr>
                    <tr>
                        <th>Beskrivelse</th>
                        <td><textarea name="beskrivelse" rows="4" cols="50"></textarea></td>
                    </tr>
                    <tr>
                        <th>Logo</th>
                        <td height="59.5px"><input type="file" name="logo"></td>
                    </tr>
                </thead>
            </table>
            <div class="submit-btn-container">
                <a href="../"><button type="button" class="back-btn-create-bedrift">Exit</button></a>
                <input type="submit" name="submit" class="submit-btn">
            </div>
        </form>
    </main>
    <script src="../JavaScript/post.js?v1.0"></script>
</body>
</html>
