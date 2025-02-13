<?php
// Database Configuration
$host = "localhost";
$dbname = "elibrary"; // Ensure this matches your actual database name
$username = "root"; // Change if needed
$password = ""; // Change if your MySQL has a password

try {
    // Create a PDO connection
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Enable error reporting
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Fetch results as associative arrays
        PDO::ATTR_EMULATE_PREPARES => false // Use native prepared statements
    ]);
} catch (PDOException $e) {
    // Log error instead of showing it in production (for security)
    error_log("Database Connection Failed: " . $e->getMessage());
    die("Database Connection Failed. Please try again later.");
}
?>
