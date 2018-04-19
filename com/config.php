<?php
define("DEBUG_MODE", false);

define("SITE_ROOT", $_SERVER['DOCUMENT_ROOT'] . "/");

define("DATABASE_HOST", "localhost");
define("DATABASE_USERNAME", "root");
define("DATABASE_PASSWORD", "68426842");
define("DATABASE_NAME", "buch");

if (DEBUG_MODE) {
    error_reporting(E_ALL);
} else {
// Выключение выдачи отчетов об ошибках
    error_reporting(0);
}
function debug_print($message)
{
    if (DEBUG_MODE) {
        echo $message;
    }
}

function handle_error($user_error_message, $system_error_message)
{
    header("Location: " . SITE_ROOT . "scripts/show_error.php?error_message={$user_error_message}&system_error_message={$system_error_message}");
}

function get_web_path($file_system_path) {
    return str_replace($_SERVER['DOCUMENT_ROOT'], '', $file_system_path);
}
