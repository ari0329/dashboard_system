<?php
// Include required files
require_once 'includes/config.php';
require_once 'includes/db.php';
require_once 'includes/functions.php';

// Rest of the code...

// Handle registration form submission
if (isset($_POST['register'])) {
    $username = sanitize_input($_POST['username']);
    $email = sanitize_input($_POST['email']);
    $password = sanitize_input($_POST['password']);
    $confirm_password = sanitize_input($_POST['confirm_password']);
    
    // Validate input
    $errors = [];
    
    if (empty($username)) {
        $errors[] = "Username is required";
    }
    
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }
    
    if (empty($password)) {
        $errors[] = "Password is required";
    }
    
    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match";
    }
    
    // Check if username or email already exists
    $check_query = "SELECT * FROM users WHERE username = ? OR email = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($row['username'] === $username) {
            $errors[] = "Username already exists";
        }
        if ($row['email'] === $email) {
            $errors[] = "Email already exists";
        }
    }
    
    // If no errors, insert user into database
    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        $insert_query = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param("sss", $username, $email, $hashed_password);
        
        if ($stmt->execute()) {
            header("Location: login.php?registered=true");
            exit();
        } else {
            $errors[] = "Error: " . $stmt->error;
        }
    }
}

// Handle login form submission
if (isset($_POST['login'])) {
    $username = sanitize_input($_POST['username']);
    $password = sanitize_input($_POST['password']);
    
    // Validate input
    $errors = [];
    
    if (empty($username)) {
        $errors[] = "Username is required";
    }
    
    if (empty($password)) {
        $errors[] = "Password is required";
    }
    
    // If no errors, check if user exists
    if (empty($errors)) {
        $query = "SELECT * FROM users WHERE username = ? OR email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss", $username, $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            
            if (password_verify($password, $user['password'])) {
                // Password is correct, start a new session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                
                // Redirect to dashboard
                header("Location: dashboard.php"); // Changed to dashboard.php
                exit();
            } else {
                $errors[] = "Invalid password";
            }
        } else {
            $errors[] = "User does not exist";
        }
    }
}

// Handle reset password form submission
if (isset($_POST['reset_password'])) {
    $current_password = sanitize_input($_POST['current_password']);
    $new_password = sanitize_input($_POST['new_password']);
    $confirm_new_password = sanitize_input($_POST['confirm_new_password']);
    
    $errors = [];
    
    if (empty($current_password)) {
        $errors[] = "Current password is required";
    }
    
    if (empty($new_password)) {
        $errors[] = "New password is required";
    }
    
    if ($new_password !== $confirm_new_password) {
        $errors[] = "New passwords do not match";
    }
    
    if (empty($errors)) {
        // Verify current password
        $user_id = $_SESSION['user_id'];
        $query = "SELECT password FROM users WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            
            if (password_verify($current_password, $user['password'])) {
                // Update password
                $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);
                $update_query = "UPDATE users SET password = ? WHERE id = ?";
                $stmt = $conn->prepare($update_query);
                $stmt->bind_param("si", $hashed_new_password, $user_id);
                
                if ($stmt->execute()) {
                    $success_message = "Password updated successfully!";
                } else {
                    $errors[] = "Error updating password: " . $stmt->error;
                }
            } else {
                $errors[] = "Current password is incorrect";
            }
        } else {
            $errors[] = "User not found";
        }
    }
}
?>