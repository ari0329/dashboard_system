<?php
require_once 'auth.php';
redirect_if_logged_in(); // Redirect to dashboard if logged in
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Roboto', sans-serif;
        }
        body {
            background-color: #1f2937;
            color: white;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .header {
            background-color: #1f2937;
            padding: 1rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #374151;
        }
        .logo {
            font-size: 1.5rem;
            font-weight: bold;
            color: white;
        }
        .header-right {
            display: flex;
            align-items: center;
        }
        .nav-link {
            margin: 0 10px;
            color: #9ca3af;
            text-decoration: none;
        }
        .nav-link:hover {
            color: white;
        }
        .main-content {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }
        .form-container {
            background-color: #111827;
            border-radius: 8px;
            padding: 2.5rem;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .form-title {
            text-align: center;
            font-size: 2rem;
            margin-bottom: 2rem;
            color: white;
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #d1d5db;
        }
        .form-control {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #374151;
            border-radius: 4px;
            background-color: #1f2937;
            color: white;
            font-size: 1rem;
        }
        .form-control:focus {
            outline: none;
            border-color: #3b82f6;
        }
        .btn-submit {
            width: 100%;
            padding: 0.75rem;
            background-color: #3b82f6;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            margin-top: 1rem;
        }
        .btn-submit:hover {
            background-color: #2563eb;
        }
        .form-footer {
            text-align: center;
            margin-top: 1.5rem;
            color: #9ca3af;
        }
        .form-footer a {
            color: #3b82f6;
            text-decoration: none;
        }
        .progress-container {
            margin-top: 2rem;
            margin-bottom: 1rem;
        }
        .progress-bar {
            width: 100%;
            height: 8px;
            background-color: #374151;
            border-radius: 4px;
            overflow: hidden;
        }
        .progress {
            height: 100%;
            background-color: #3b82f6;
            width: 75%;
        }
        .alert {
            padding: 0.75rem;
            margin-bottom: 1rem;
            border-radius: 4px;
            font-size: 0.875rem;
        }
        .alert-success {
            background-color: rgba(16, 185, 129, 0.1);
            border: 1px solid #10b981;
            color: #10b981;
        }
        .alert-danger {
            background-color: rgba(239, 68, 68, 0.1);
            border: 1px solid #ef4444;
            color: #ef4444;
        }
        .social-icons {
            display: flex;
            justify-content: center;
            margin-top: 2rem;
        }
        .social-icon {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 1px solid #374151;
            margin: 0 0.5rem;
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="logo">WIX</div>
        <div class="header-right">
            <a href="index.php" class="nav-link">HOME</a>
            <?php if (is_logged_in()): ?>
                <span style="color: white; margin-left: 20px;">Welcome, <?php echo $_SESSION['username']; ?></span>
                <a href="logout.php" class="nav-link" style="color: #ef4444;">LOGOUT</a>
            <?php else: ?>
                <a href="login.php" class="nav-link">LOGIN</a>
                <a href="register.php" class="nav-link">REGISTER</a>
            <?php endif; ?>
        </div>
    </header>

    <div class="main-content">
        <div class="form-container">
            <h2 class="form-title">Login</h2>
            
            <?php if (isset($_GET['registered']) && $_GET['registered'] == 'true'): ?>
                <div class="alert alert-success">Registration successful! You can now login.</div>
            <?php endif; ?>

            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <?php foreach ($errors as $error): ?>
                        <div><?php echo $error; ?></div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <form method="post" action="">
                <div class="form-group">
                    <label for="username">Username or Email</label>
                    <input type="text" id="username" name="username" class="form-control" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                
                <button type="submit" name="login" class="btn-submit">Login</button>
            </form>
            
            <div class="progress-container">
                <div class="progress-bar">
                    <div class="progress"></div>
                </div>
                <div style="display: flex; justify-content: space-between; color: #9ca3af; font-size: 0.75rem;">
                    <span>0%</span>
                    <span>100%</span>
                </div>
            </div>
            
            <div class="form-footer">
                Don't have an account? <a href="register.php">Register here</a>
            </div>
            
            <div class="social-icons">
                <a href="#" class="social-icon">f</a>
                <a href="#" class="social-icon">in</a>
                <a href="#" class="social-icon">ig</a>
                <a href="#" class="social-icon">tw</a>
            </div>
        </div>
    </div>
</body>
</html>