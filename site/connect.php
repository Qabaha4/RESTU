<?php
$servername = "db";
$username   = "root";
$password   = "malik"; 
$dbname     = "mydb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo "<div class='alert alert-danger text-center'>
            <strong>Database Connection Failed:</strong> " . htmlspecialchars($conn->connect_error) . "
          </div>";
    exit;
}
?>
