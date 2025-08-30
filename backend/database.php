<?php
// backend/database.php

require_once __DIR__ . '/../config/config.php';

class Database {
    private $conn;

    public function connect() {
        if ($this->conn) {
            return $this->conn; // reuse if already connected
        }

        try {
            $this->conn = new mysqli(
                DB_HOST,
                DB_USER,
                DB_PASS,
                DB_NAME,
                DB_PORT
            );

            if ($this->conn->connect_error) {
                throw new Exception("Database connection failed: " . $this->conn->connect_error);
            }

            // Set charset to UTF8
            $this->conn->set_charset("utf8mb4");
        } catch (Exception $e) {
            die("DB Connection Error: " . $e->getMessage());
        }

        return $this->conn;
    }
}
