<?php
require_once('./connection.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    $date_of_birth = filter_var($_POST['date_of_birth'], FILTER_SANITIZE_STRING);
    $date_of_death = filter_var($_POST['date_of_death'], FILTER_SANITIZE_STRING);
    $content = filter_var($_POST['content'], FILTER_SANITIZE_STRING);
    $author = filter_var($_POST['author'], FILTER_SANITIZE_STRING);

    $dob_timestamp = strtotime($date_of_birth);
    $dod_timestamp = strtotime($date_of_death);

    if (!$dob_timestamp || !$dod_timestamp) {
        echo "Invalid date format.";
        exit;
    }

    if ($dod_timestamp < $dob_timestamp) {
        echo "Date of death cannot be earlier than the date of birth.";
        exit;
    }

    $sql = "INSERT INTO orbit_form (name, date_of_birth, date_of_death, content, author) VALUES (?, ?, ?, ?, ?)";

    try {
        if ($stmt = $pdo->prepare($sql)) {
            $stmt->bindParam(1, $name, PDO::PARAM_STR);
            $stmt->bindParam(2, $date_of_birth, PDO::PARAM_STR);
            $stmt->bindParam(3, $date_of_death, PDO::PARAM_STR);
            $stmt->bindParam(4, $content, PDO::PARAM_STR);
            $stmt->bindParam(5, $author, PDO::PARAM_STR);

            if ($stmt->execute()) {
                echo "Form submitted successfully";
                header('Location: view_obituaries.php');
                exit;
            } else {
                throw new Exception("Error executing the command statement.");
            }
        } else {
            throw new Exception("Error preparing the SQL statement.");
        }
    } catch (Exception $e) {
        error_log("Error: " . $e->getMessage());
        echo "An error occurred. Please try again later.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Obituary Form</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Submit Obituary</h1>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" action="submit_obituary.php">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>">
            </div>

            <div class="form-group">
                <label for="date_of_birth">Date of Birth:</label>
                <input type="date" id="date_of_birth" name="date_of_birth" required value="<?php echo isset($_POST['date_of_birth']) ? htmlspecialchars($_POST['date_of_birth']) : ''; ?>">
            </div>

            <div class="form-group">
                <label for="date_of_death">Date of Death:</label>
                <input type="date" id="date_of_death" name="date_of_death" required value="<?php echo isset($_POST['date_of_death']) ? htmlspecialchars($_POST['date_of_death']) : ''; ?>">
            </div>

            <div class="form-group">
                <label for="content">Content:</label>
                <textarea id="content" name="content" rows="5" required><?php echo isset($_POST['content']) ? htmlspecialchars($_POST['content']) : ''; ?></textarea>
            </div>

            <div class="form-group">
                <label for="author">Author:</label>
                <input type="text" id="author" name="author" required value="<?php echo isset($_POST['author']) ? htmlspecialchars($_POST['author']) : ''; ?>">
            </div>

            <button type="submit" value="Submit">Submit Obituary</button>
        </form>
    </div>
</body>
</html>
