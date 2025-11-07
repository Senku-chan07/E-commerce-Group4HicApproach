<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Function to check if user is logged in
function is_logged_in() {
    return isset($_SESSION['user_id']) && !empty($_SESSION['user_id']);
}

// Function to get current user's data
function get_session_user() {
    if (!is_logged_in()) {
        return null;
    }
    return [
        'id' => $_SESSION['user_id'] ?? null,
        'name' => $_SESSION['user_name'] ?? null,
        'user' => $_SESSION['user'] ?? null
    ];
}

// Function to require login for protected pages
function require_login() {
    if (!is_logged_in()) {
        header('Location: /E-commerce-HicApproach/login.html');
        exit;
    }
}

// Function to get cart items count
function get_cart_count() {
    return isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
}

// Function to check if user has admin role
function is_admin() {
    return isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'admin';
}

// Function to set flash message
function set_flash_message($type, $message) {
    $_SESSION['flash'] = [
        'type' => $type,
        'message' => $message
    ];
}

// Function to get and clear flash message
function get_flash_message() {
    // First check session-based flash
    if (isset($_SESSION['flash'])) {
        $flash = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $flash;
    }
    
    // Then check cookie-based flash
    if (isset($_COOKIE['flash_message'])) {
        $flash = json_decode($_COOKIE['flash_message'], true);
        setcookie('flash_message', '', time() - 3600, '/'); // Delete the cookie
        return $flash;
    }
    
    return null;
}
?>