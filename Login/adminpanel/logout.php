<?php
session_start();
// Hapus semua variabel session
$_SESSION = array();

// Hapus cookie session
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Hancurkan session
session_destroy();

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header('Location: login.php');
exit();
?>