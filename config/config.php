<?php
// config/config.php

// Load .env file function
function loadEnv($path)
{
    if (!file_exists($path)) {
        throw new Exception(".env file not found at: " . $path);
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue;
        }
        list($name, $value) = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value);

        if (!array_key_exists($name, $_SERVER) && !array_key_exists($name, $_ENV)) {
            putenv("$name=$value");
            $_ENV[$name] = $value;
            $_SERVER[$name] = $value;
        }
    }
}

// Load .env
loadEnv(__DIR__ . '/../.env');

// Database Config
define('DB_HOST', getenv('DB_HOST'));
define('DB_PORT', getenv('DB_PORT'));
define('DB_USER', getenv('DB_USER'));
define('DB_PASS', getenv('DB_PASS'));
define('DB_NAME', getenv('DB_NAME'));

// Prokerala API Config
define('PROKERALA_CLIENT_ID', getenv('PROKERALA_CLIENT_ID'));
define('PROKERALA_CLIENT_SECRET', getenv('PROKERALA_CLIENT_SECRET'));
define('PROKERALA_TOKEN_URL', getenv('PROKERALA_TOKEN_URL'));
define('PROKERALA_API_BASE', getenv('PROKERALA_API_BASE'));

// App Config
define('APP_URL', getenv('APP_URL'));
define('APP_ENV', getenv('APP_ENV'));
define('APP_DEBUG', getenv('APP_DEBUG') === 'true');
