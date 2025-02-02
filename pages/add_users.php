<?php
require 'db.php';
require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

try {
    $database = new db($_ENV['DB_HOST'], $_ENV['DB_NAME'], $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}

$faker = Faker\Factory::create();

try {
    for ($i = 0; $i < 50; $i++) {
        $first_name = $faker->firstName;
        $last_name = $faker->lastName;
        $username = strtolower($first_name . '.' . $last_name . rand(100, 999));
        $email = $username . "@example.com";

        $query = "INSERT INTO users (first_name, last_name, username, email) VALUES (?, ?, ?, ?)";
        $database->Insert($query, [$first_name, $last_name, $username, $email]);
    }

    echo "✅ 50 fake users inserted successfully.\n";
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage();
}
