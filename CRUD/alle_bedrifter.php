<?php
include 'connect.php';

$searchQuery = isset($_GET['search']) ? $_GET['search'] : '';

$sql = "SELECT b.*, COUNT(a.ansatte_id) AS ansatte_count
        FROM bedrifter_tb b
        LEFT JOIN ansatte_tb a ON b.bedrift_id = a.ansatte_bedrifts_id";

if (!empty($searchQuery)) {
    // Check if the initial query already contains a WHERE clause
    if (strpos($sql, 'WHERE') !== false) {
        // If the WHERE clause exists, append the condition using AND
        $sql .= " AND (bedrift_navn LIKE '%$searchQuery%' OR bedrift_id LIKE '%$searchQuery%')";
    } else {
        // If the WHERE clause doesn't exist, add the condition directly
        $sql .= " WHERE bedrift_navn LIKE '%$searchQuery%' OR bedrift_id LIKE '%$searchQuery%'";
    }
}

$sort = isset($_GET['sort']) ? $_GET['sort'] : 'bedrift_id';
$order = isset($_GET['order']) && $_GET['order'] == 'desc' ? 'DESC' : 'ASC';

$sql .= " GROUP BY b.bedrift_id ORDER BY $sort $order";

$result = mysqli_query($conn, $sql);

if (!$result) {
    // Handle the SQL error
    echo "Error: " . mysqli_error($conn);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../stylesheets/stylesheet.css?v=1.0">
    <link rel="icon" href="../images/logo_no_slogan.png">
    <title>Se Alle Bedrifter</title>
    <style>
        #search {
            width:300px;
        }

        .kunde-yes {
            background-color: #FF5A5F;
        }

        .kunde-no {
            background-color: #3E92CC;
        }
    </style>
</head>
<body>

    <a href="../"><button type="button" class="btn">Hjem </button></a>
    
    <div class="logo-alle_ansatte-con">
        <img class="logo-alle_ansatte" src="../images/logo_no_slogan.png">
    </div>

    <h1>View All Bedrifter</h1>

    <div class="ansatte-search-box">
    <form action="alle_bedrifter.php" method="GET">
        <input type="text" id="search" name="search" placeholder="Search...">
        <button type="submit" class="btn">Search</button>
        <a href="alle_ansatte.php" ><button class="reset-btn">Reset</button></a>
    </form>
    </div>

    <table class="all-view-table">
        <thead>
            <tr class="alle-ansatte">
                <th><a href="?sort=bedrift_id&order=<?php echo $order == 'ASC' ? 'desc' : 'asc'; ?>">Bedrift ID<span class="sort-arrow <?php echo $order == 'ASC' && $sort == 'bedrift_id' ? 'asc' : ($order == 'DESC' && $sort == 'bedrift_id' ? 'desc' : ''); ?>"></span></a></th>
                <th><a href="?sort=bedrift_navn&order=<?php echo $order == 'ASC' ? 'desc' : 'asc'; ?>">Navn<span class="sort-arrow <?php echo $order == 'ASC' && $sort == 'bedrift_navn' ? 'asc' : ($order == 'DESC' && $sort == 'bedrift_navn' ? 'desc' : ''); ?>"></span></a></th>
                <th><a href="?sort=bedrift_org_form&order=<?php echo $order == 'ASC' ? 'desc' : 'asc'; ?>">Org. form<span class="sort-arrow <?php echo $order == 'ASC' && $sort == 'bedrift_org_form' ? 'asc' : ($order == 'DESC' && $sort == 'bedrift_org_form' ? 'desc' : ''); ?>"></span></a></th>
                <th><a href="?sort=bedrift_reg_dato&order=<?php echo $order == 'ASC' ? 'desc' : 'asc'; ?>">Reg. dato<span class="sort-arrow <?php echo $order == 'ASC' && $sort == 'bedrift_reg_dato' ? 'asc' : ($order == 'DESC' && $sort == 'bedrift_reg_dato' ? 'desc' : ''); ?>"></span></a></th>
                <th><a href="?sort=bedrift_post_nr&order=<?php echo $order == 'ASC' ? 'desc' : 'asc'; ?>">Postnr<span class="sort-arrow <?php echo $order == 'ASC' && $sort == 'bedrift_post_nr' ? 'asc' : ($order == 'DESC' && $sort == 'bedrift_post_nr' ? 'desc' : ''); ?>"></span></a></th>
                <th><a href="?sort=bedrift_post_sted&order=<?php echo $order == 'ASC' ? 'desc' : 'asc'; ?>">Poststed<span class="sort-arrow <?php echo $order == 'ASC' && $sort == 'bedrift_post_sted' ? 'asc' : ($order == 'DESC' && $sort == 'bedrift_post_sted' ? 'desc' : ''); ?>"></span></a></th>
                <th><a href="?sort=bedrift_beskrivelse&order=<?php echo $order == 'ASC' ? 'desc' : 'asc'; ?>">Beskrivelse<span class="sort-arrow <?php echo $order == 'ASC' && $sort == 'bedrift_beskrivelse' ? 'asc' : ($order == 'DESC' && $sort == 'bedrift_beskrivelse' ? 'desc' : ''); ?>"></span></a></th>
                <th><a href="?sort=ansatte_count&order=<?php echo $order == 'ASC' ? 'desc' : 'asc'; ?>">Antall Ansatte<span class="sort-arrow <?php echo $order == 'ASC' && $sort == 'ansatte_count' ? 'asc' : ($order == 'DESC' && $sort == 'ansatte_count' ? 'desc' : ''); ?>"></span></a></th>
                <th><a href="?sort=bedrift_er_kunde&order=<?php echo $order == 'ASC' ? 'desc' : 'asc'; ?>">Kunde<span class="sort-arrow <?php echo $order == 'ASC' && $sort == 'bedrift_er_kunde' ? 'asc' : ($order == 'DESC' && $sort == 'bedrift_er_kunde' ? 'desc' : ''); ?>"></span></a></th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <?php $kundeClass = $row['bedrift_er_kunde'] == 1 ? 'kunde-yes' : 'kunde-no'; ?> 
                <tr class="<?php echo $kundeClass; ?>">
                    <td><?php echo $row['bedrift_id']; ?></td>
                    <td><a href="Read.php?bedrift_id=<?php echo $row['bedrift_id']; ?>"><?php echo $row['bedrift_navn']; ?> </a></td>
                    <td><?php echo $row['bedrift_org_form']; ?></td>
                    <td><?php echo $row['bedrift_reg_dato']; ?></td>
                    <td><?php echo $row['bedrift_post_nr']; ?></td>
                    <td><?php echo $row['bedrift_post_sted']; ?></td>
                    <td><?php echo $row['bedrift_beskrivelse']; ?></td>
                    <td><?php echo $row['ansatte_count']; ?></td>
                    <td><?php echo $row['bedrift_er_kunde'] == 1 ? 'Yes' : 'No'; ?></td>
                </tr>
        </tbody>
        <?php endwhile; ?>
    </table>
</body>
</html>