<?php
// Load environment variables
$env = parse_ini_file(__DIR__ . '/../.env');

// Database connection
$con = new mysqli($env['DB_HOST'], $env['DB_USER'], $env['DB_PASS'], $env['DB_NAME']);
if ($con->connect_error) {
    die("Database Connection Failed: " . $con->connect_error);
}

// API key
define("ASTRO_API_KEY", $env['ASTRO_API_KEY']);
