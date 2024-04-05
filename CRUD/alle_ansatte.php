<?php
include 'connect.php';

$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

$sql = "SELECT a.*, b.bedrift_navn  
        FROM ansatte_tb a
        LEFT JOIN bedrifter_tb b ON a.ansatte_bedrifts_id = b.bedrift_id";

if (!empty($searchQuery)) {
    $sql .= " WHERE ansatte_etternavn LIKE '%$searchQuery%' OR ansatte_fornavn LIKE '%$searchQuery%'";
}

$sort = isset($_GET['sort']) ? $_GET['sort'] : 'ansatte_id';
$order = isset($_GET['order']) && $_GET['order'] == 'desc' ? 'DESC' : 'ASC';

$sql .= " ORDER BY $sort $order";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../stylesheets/stylesheet.css">
    <title>All Ansatte</title>
    <style>
        #search {
            width:500px;
        }
    </style>
</head>
<body>

    <a href="../"><button type="button" class="btn">Hjem </button></a>

    <div class="logo-alle_ansatte-con">
        <img class="logo-alle_ansatte" src="../images/logo_no_slogan.png">
    </div>

    <h1>Se Alle Ansatte</h1>

    <div class="ansatte-search-box">
    <form action="alle_ansatte.php" method="GET">
        <input type="text" id="search" name="search" placeholder="Search...">
        <button type="submit" class="btn">Search</button>
        <a href="alle_ansatte.php" ><button class="reset-btn">Reset</button></a>
    </form>
    </div>

    <table class="all-view-table">
        <thead>
            <tr class="alle-ansatte">
            <th><a href="?sort=ansatte_id&order=<?php echo $order == 'ASC' ? 'desc' : 'asc'; ?>">Ansatte ID<span class="sort-arrow <?php echo $order == 'ASC' && $sort == 'ansatte_id' ? 'asc' : ($order == 'DESC' && $sort == 'ansatte_id' ? 'desc' : ''); ?>"></span></a></th>
                <th><a href="?sort=ansatte_etternavn&order=<?php echo $order == 'ASC' ? 'desc' : 'asc'; ?>">Etternavn<span class="sort-arrow <?php echo $order == 'ASC' && $sort == 'ansatte_etternavn' ? 'asc' : ($order == 'DESC' && $sort == 'ansatte_etternavn' ? 'desc' : ''); ?>"></span></a></th>
                <th><a href="?sort=ansatte_fornavn&order=<?php echo $order == 'ASC' ? 'desc' : 'asc'; ?>">Fornavn<span class="sort-arrow <?php echo $order == 'ASC' && $sort == 'ansatte_fornavn' ? 'asc' : ($order == 'DESC' && $sort == 'ansatte_fornavn' ? 'desc' : ''); ?>"></span></a></th>
                <th><a href="?sort=ansatte_stilling&order=<?php echo $order == 'ASC' ? 'desc' : 'asc'; ?>">Stilling<span class="sort-arrow <?php echo $order == 'ASC' && $sort == 'ansatte_stilling' ? 'asc' : ($order == 'DESC' && $sort == 'ansatte_stilling' ? 'desc' : ''); ?>"></span></a></th>
                <th><a href="?sort=ansatte_kontakt_person&order=<?php echo $order == 'ASC' ? 'desc' : 'asc'; ?>">Kontakt Person<span class="sort-arrow <?php echo $order == 'ASC' && $sort == 'ansatte_kontakt_person' ? 'asc' : ($order == 'DESC' && $sort == 'ansatte_kontakt_person' ? 'desc' : ''); ?>"></span></a></th>
                <th><a href="?sort=ansatte_tlf_nr&order=<?php echo $order == 'ASC' ? 'desc' : 'asc'; ?>">Telefonnummer<span class="sort-arrow <?php echo $order == 'ASC' && $sort == 'ansatte_tlf_nr' ? 'asc' : ($order == 'DESC' && $sort == 'ansatte_tlf_nr' ? 'desc' : ''); ?>"></span></a></th>
                <th><a href="?sort=ansatte_epost&order=<?php echo $order == 'ASC' ? 'desc' : 'asc'; ?>">Epost<span class="sort-arrow <?php echo $order == 'ASC' && $sort == 'ansatte_epost' ? 'asc' : ($order == 'DESC' && $sort == 'ansatte_epost' ? 'desc' : ''); ?>"></span></a></th>
                <th><a href="?sort=bedrift_navn&order=<?php echo $order == 'ASC' ? 'desc' : 'asc'; ?>">Bedrift<span class="sort-arrow <?php echo $order == 'ASC' && $sort == 'bedrift_navn' ? 'asc' : ($order == 'DESC' && $sort == 'bedrift_navn' ? 'desc' : ''); ?>"></span></a></th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?php echo $row['ansatte_id']; ?></td>
                    <td><?php echo $row['ansatte_etternavn']; ?></td>
                    <td><?php echo $row['ansatte_fornavn']; ?></td>
                    <td><?php echo $row['ansatte_stilling']; ?></td>
                    <td><?php echo $row['ansatte_kontakt_person'] ? 'Yes' : 'No'; ?></td>
                    <td><?php echo $row['ansatte_tlf_nr']; ?></td>
                    <td><?php echo $row['ansatte_epost']; ?></td>
                    <td><?php echo $row['bedrift_navn']; ?></td>
                </tr>
        </tbody>
        <?php endwhile; ?>
    </table>
</body>
</html>