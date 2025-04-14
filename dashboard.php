<?php
require_once 'includes/auth.php';
redirect_if_not_logged_in(); // Redirect to login if not logged in
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - WIX</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> <!-- Font Awesome for icons -->
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }
        body {
            background-color: #f1f1f1;
            color: #2c3338;
            min-height: 100vh;
            display: flex;
            flex-direction: row;
            margin: 0;
        }
        /* Header */
        .wp-header {
            background-color: #23282d;
            color: #fff;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .wp-header .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: #fff;
        }
        .wp-header .user-menu {
            display: flex;
            align-items: center;
        }
        .wp-header .user-menu span {
            margin-right: 15px;
            font-weight: 500;
        }
        .wp-header .logout-link {
            color: #fff;
            text-decoration: none;
            padding: 5px 10px;
            background: #d54e21;
            border-radius: 3px;
        }
        .wp-header .logout-link:hover {
            background: #c6461f;
        }
        /* Sidebar */
        .wp-sidebar {
            width: 160px;
            background: #23282d;
            color: #fff;
            position: fixed;
            top: 46px;
            bottom: 0;
            padding-top: 20px;
            transition: width 0.3s;
        }
        .wp-sidebar ul {
            list-style: none;
            padding: 0;
        }
        .wp-sidebar ul li {
            padding: 10px 20px;
        }
        .wp-sidebar ul li a {
            color: #fff;
            text-decoration: none;
            display: flex;
            align-items: center;
        }
        .wp-sidebar ul li a:hover {
            background: #191e23;
            color: #00a0d2;
        }
        .wp-sidebar ul li a i {
            margin-right: 10px;
        }
        /* Main Content */
        .wp-main {
            margin-left: 160px;
            padding: 60px 20px 20px;
            flex: 1;
        }
        .wp-welcome-panel {
            background: #fff;
            padding: 20px;
            border-left: 4px solid #0073aa;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        .wp-welcome-panel h2 {
            font-size: 1.5rem;
            margin-bottom: 10px;
            color: #23282d;
        }
        .wp-welcome-panel p {
            color: #666;
            margin-bottom: 15px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #23282d;
            font-weight: 500;
        }
        .form-control {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 1rem;
            box-sizing: border-box;
        }
        .form-control:focus {
            outline: none;
            border-color: #0073aa;
            box-shadow: 0 0 5px rgba(0, 115, 170, 0.3);
        }
        .btn-submit {
            background: #0073aa;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            transition: background 0.3s;
        }
        .btn-submit:hover {
            background: #005d87;
        }
        .alert {
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 4px;
            font-size: 0.9rem;
        }
        .alert-success {
            background-color: #e7f1f5;
            border-left: 4px solid #00a0d2;
            color: #00a0d2;
        }
        .alert-danger {
            background-color: #fef5f5;
            border-left: 4px solid #dc3232;
            color: #dc3232;
        }
        @media (max-width: 600px) {
            .wp-sidebar {
                width: 100%;
                height: auto;
                position: relative;
            }
            .wp-main {
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="wp-header">
        <div class="logo">WIX</div>
        <div class="user-menu">
            <span>Welcome, <?php echo $_SESSION['username']; ?></span>
            <a href="logout.php" class="logout-link">Log Out</a>
        </div>
    </header>

    <!-- Sidebar -->
    <aside class="wp-sidebar">
        <ul>
            <li><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Reset Password</a></li>
            
            <!-- Add more navigation items as needed -->
        </ul>
    </aside>

    <!-- Main Content -->
    <main class="wp-main">
        <div class="wp-welcome-panel">
            <h2>Dashboard</h2>
            <p>Welcome to your WIX dashboard, <?php echo $_SESSION['username']; ?>! Manage your account and settings here.</p>
            
            <?php if (isset($success_message)): ?>
                <div class="alert alert-success"><?php echo $success_message; ?></div>
            <?php endif; ?>
            
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <?php foreach ($errors as $error): ?>
                        <div><?php echo $error; ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <h3>Reset Password</h3>
            <form method="post" action="">
                <div class="form-group">
                    <label for="current_password">Current Password</label>
                    <input type="password" id="current_password" name="current_password" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="new_password">New Password</label>
                    <input type="password" id="new_password" name="new_password" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="confirm_new_password">Confirm New Password</label>
                    <input type="password" id="confirm_new_password" name="confirm_new_password" class="form-control" required>
                </div>
                
                <button type="submit" name="reset_password" class="btn-submit">Reset Password</button>
            </form>
        </div>
    </main>
</body>
</html>