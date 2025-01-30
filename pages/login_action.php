<?php
session_start();
require 'db.php';

$database = new db();

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if (empty($username) || empty($password)) {
    die(json_encode(["status" => "error", "message" => "Username and password are required"]));
}

// Fetch user from database
$query = "SELECT id, password FROM users WHERE username = ?";
try {//this try and catch, phpstorm suggested it
    $user = $database->Select($query, [$username]);
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => "Login failed: " . $e->getMessage()]);
}

if (count($user) > 0) {
    $db_password = $user[0]['password'];

    if (password_verify($password, $db_password)) {
        $_SESSION['user_id'] = $user[0]['id'];
        echo json_encode(["status" => "success", "message" => "Login successful"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid credentials"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "User not found"]);
}
