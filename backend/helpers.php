<?php
// backend/helpers.php
declare(strict_types=1);

require_once __DIR__ . '/../config/config.php';

function e(string $v): string { return htmlspecialchars($v, ENT_QUOTES, 'UTF-8'); }

function redirect(string $path): void {
    header("Location: $path");
    exit;
}

function hash_password(string $plain): string {
    return password_hash($plain, PASSWORD_DEFAULT);
}

function verify_password(string $plain, string $hash): bool {
    return password_verify($plain, $hash);
}

function require_login(): void {
    if (!isset($_SESSION['user'])) redirect('/public/login.php');
}

function current_user_id(): ?int {
    return $_SESSION['user']['id'] ?? null;
}

/**
 * Very simple sun-sign calc (Western) from month/day.
 * You can replace with API if needed.
 */
function zodiac_from_date(string $dob): string {
    [$y,$m,$d] = array_map('intval', explode('-', $dob));
    $md = (int)($m * 100 + $d);
    return match (true) {
        $md >= 321 && $md <= 419 => 'aries',
        $md >= 420 && $md <= 520 => 'taurus',
        $md >= 521 && $md <= 620 => 'gemini',
        $md >= 621 && $md <= 722 => 'cancer',
        $md >= 723 && $md <= 822 => 'leo',
        $md >= 823 && $md <= 922 => 'virgo',
        $md >= 923 && $md <= 1022 => 'libra',
        $md >= 1023 && $md <= 1121 => 'scorpio',
        $md >= 1122 && $md <= 1221 => 'sagittarius',
        ($md >= 1222 && $md <= 1231) || ($md >= 101 && $md <= 119) => 'capricorn',
        $md >= 120 && $md <= 218 => 'aquarius',
        $md >= 219 && $md <= 320 => 'pisces',
        default => 'aries',
    };
}

function json_out($data, int $code = 200): void {
    http_response_code($code);
    header('Content-Type: application/json');
    echo json_encode($data);
    exit;
}
