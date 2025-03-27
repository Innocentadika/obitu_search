<?php
$server = "localhost";
$db_name = "zu_record";
$username = "root";
$password = "";

try {
    $pdo = new PDO("mysql:host=$server;dbname=$db_name", $username, $password);
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
   
    echo "Connection failed: " . $e->getMessage();
    die(); 
}
?>
