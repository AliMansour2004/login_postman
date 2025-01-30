<?php
require 'db.php';
require '../vendor/autoload.php';


$database = new db();

$faker = Faker\Factory::create();

// Prompt for user confirmation
echo "This script will add 50 fake users to the database. Do you want to proceed? (yes/no): ";
$response = trim(strtolower(readline()));

if ($response !== 'yes') {
    echo "Operation canceled. No users were added.";
    exit;
}


try {

    for ($i = 0; $i < 50; $i++) {
        $first_name = $faker->firstName;
        $last_name = $faker->lastName;
        $username = strtolower($first_name . '.' . $last_name . rand(100, 999));
        $email = $username . "@example.com";

        $query = "INSERT INTO users (first_name, last_name, username, email) VALUES (?, ?, ?, ?)";
        $d = $database->Insert($query, [$first_name, $last_name, $username, $email]);


    }
    echo "✅ 50 fake users inserted successfully.";
} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage();
}

