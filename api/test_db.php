<?php
require __DIR__ . '/db.php';

try {
    $pdo = get_pdo();
    echo "Successfully connected to the database!\n";
    
    // Try to create the database and table
    $pdo->exec("CREATE DATABASE IF NOT EXISTS eshop");
    $pdo->exec("USE eshop");
    
    $create_table = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        email VARCHAR(255) NOT NULL UNIQUE,
        password_hash VARCHAR(255) NOT NULL,
        first_name VARCHAR(100) NOT NULL,
        last_name VARCHAR(100) NOT NULL,
        contact VARCHAR(50),
        address TEXT,
        role VARCHAR(20) NOT NULL DEFAULT 'customer',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        last_login_at TIMESTAMP NULL
    )";
    
    $pdo->exec($create_table);
    echo "Database and table created successfully!\n";
    
    // Test if we can insert data
    $test_insert = $pdo->prepare("INSERT INTO users (email, password_hash, first_name, last_name, role) VALUES (:e, :p, :f, :l, :r)");
    $test_insert->execute([
        ':e' => 'test@test.com',
        ':p' => password_hash('test123', PASSWORD_DEFAULT),
        ':f' => 'Test',
        ':l' => 'User',
        ':r' => 'customer'
    ]);
    
    echo "Test user created successfully!\n";
    
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>