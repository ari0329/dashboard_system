<?php
require_once 'config.php';

// Create database connection
function connect_db() {
    // First, connect without specifying a database
    $conn = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Check if database exists, create if it doesn't
    $db_check_query = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '" . DB_NAME . "'";
    $result = $conn->query($db_check_query);
    
    if ($result->num_rows == 0) {
        // Database doesn't exist, create it
        $create_db_query = "CREATE DATABASE " . DB_NAME;
        if (!$conn->query($create_db_query)) {
            die("Error creating database: " . $conn->error);
        }
    }
    
    // Select the database
    $conn->select_db(DB_NAME);
    
    // Check if users table exists, create if it doesn't
    $table_check_query = "SHOW TABLES LIKE 'users'";
    $result = $conn->query($table_check_query);
    
    if ($result->num_rows == 0) {
        // Table doesn't exist, create it
        $create_table_query = "CREATE TABLE `users` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `username` varchar(50) NOT NULL,
            `email` varchar(100) NOT NULL,
            `password` varchar(255) NOT NULL,
            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`id`),
            UNIQUE KEY `username` (`username`),
            UNIQUE KEY `email` (`email`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
        
        if (!$conn->query($create_table_query)) {
            die("Error creating table: " . $conn->error);
        }
    }
    
    return $conn;
}

// Get database connection
$conn = connect_db();
?>