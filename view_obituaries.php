<?php
require_once('./connection.php');

$searchTerm = '';
if (isset($_GET['search'])) {
    $searchTerm = htmlspecialchars($_GET['search']);
}

$sql = 'SELECT * FROM orbit_form WHERE name LIKE :searchTerm ORDER BY id DESC';
$stmt = $pdo->prepare($sql);
$stmt->execute(['searchTerm' => '%' . $searchTerm . '%']);
$feedbackList = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campaign Feedback</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
    </style>
</head>
<body>

<h1>Obituary Data</h1>

<h2>Data List:</h2>

<form method="get" class="search-box">
    <input type="text" name="search" value="<?php echo $searchTerm; ?>" placeholder="Search by name..." />
    <input type="submit" value="Search">
</form>

<table>
    <tr>
        <th>Name</th>
        <th>DOB</th>
        <th>DOD</th>
        <th>Content</th>
        <th>Author</th>
        <th>Submission_date</th>
    </tr>

    <?php
    foreach ($feedbackList as $row) {
        echo "<tr>
                <td>" . htmlspecialchars($row['name']) . "</td>
                <td>" . htmlspecialchars($row['date_of_birth']) . "</td>
                <td>" . htmlspecialchars($row['date_of_death']) . "</td>
                <td>" . htmlspecialchars($row['content']) . "</td>
                <td>" . htmlspecialchars($row['author']) . "</td>
                <td>" . htmlspecialchars($row['submission_date']) . "</td>
              </tr>";
    }
    ?>
</table>

</body>
</html>
