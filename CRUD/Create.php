<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../stylesheets/stylesheet.css">
    <title> Bedriftsportalen </title>
</head>
<body>
    

    <h1> Bedriftsportalen </h1>

    <a href="Create.php"><button type="button" class="btn"> Create</button></a>
    <a href="Read.php"><button type="button" class="btn"> Read</button></a>
    <a href="Update.php"><button type="button" class="btn"> Update</button></a>
    <a href="Delete.php"><button type="button" class="btn"> Delete</button></a>
    <a href="../index.php"><button type="button" class="btn"> Index</button></a>


    <main>
        <table>
            <thead>
                <tr>
                    <th>Kjnr</th>
                    <th>Rase</th>
                    <th>Navn</th>
                    <th>Rediger</th>
                    <th>Slett</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><a class="Update">Rediger</a></td>
                    <td><a class="Delete">Slett</a></td>
                 </tr>
            </tbody>
        </table>
    </main>


    <script src="JavaScript/script.js">
</body>
</html>