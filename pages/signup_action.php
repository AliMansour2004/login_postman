<?php
require 'db.php';

//$host = "localhost";
//$dbname = "login_postman";
//$username = "root";
//$password = "";

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ );
$dotenv->load();

try {
    $database = new db($_ENV['DB_HOST'], $_ENV['DB_NAME'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}

$first_name = $_POST['first_name'] ?? '';
$last_name = $_POST['last_name'] ?? '';
$username = $_POST['username'] ?? '';
$email = $_POST['email'] ?? '';
$password = $_POST['password'] ?? '';



if (empty($first_name) || empty($last_name) || empty($username) || empty($email) || empty($password)) {
    die(json_encode(["status" => "error", "message" => "All fields are required"]));
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die(json_encode(["status" => "error", "message" => "Invalid email format"]));
}

$hashed_password = password_hash($password, PASSWORD_BCRYPT);

$query = "INSERT INTO users (first_name, last_name, username, email, password) VALUES (?, ?, ?, ?, ?)";

try {
    $database->Insert($query, [$first_name, $last_name, $username, $email, $hashed_password]);
    echo json_encode(["status" => "success", "message" => "User registered successfully"]);
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => "Signup failed: " . $e->getMessage()]);
}
?>