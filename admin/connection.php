<?php
require_once '../vendor/autoload.php'; // Include Composer's autoload file

// Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Establish the database connection
$conn = mysqli_connect(
    $_ENV["DB_HOST"], 
    $_ENV["DB_USER"], 
    $_ENV["DB_PASS"], 
    $_ENV["DB_NAME"]
);

// Check the database connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
