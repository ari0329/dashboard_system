<?php
// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Function to sanitize user inputs
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Function to check if user is logged in
function is_logged_in() {
    return isset($_SESSION['user_id']);
}

// Function to redirect user if not logged in
function redirect_if_not_logged_in() {
    if (!is_logged_in()) {
        header("Location: login.php");
        exit();
    }
}

// Function to redirect user if already logged in
function redirect_if_logged_in() {
    if (is_logged_in()) {
        header("Location: dashboard.php"); // Changed to dashboard.php
        exit();
    }
}

// Function to display error messages
function display_errors($errors) {
    if (!empty($errors)) {
        echo '<div class="alert alert-danger">';
        foreach ($errors as $error) {
            echo '<div>' . $error . '</div>';
        }
        echo '</div>';
    }
}

// Function to display success message
function display_success($message) {
    if (!empty($message)) {
        echo '<div class="alert alert-success">' . $message . '</div>';
    }
}
?>