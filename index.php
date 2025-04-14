<?php
require_once 'includes/functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Your Website</title>
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
        .nav-link.active {
            color: white;
        }
        .edit-button {
            background-color: #1a73e8;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 8px 16px;
            cursor: pointer;
            font-weight: 500;
        }
        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem;
            text-align: center;
        }
        .welcome-message {
            font-size: 3rem;
            margin-bottom: 1rem;
        }
        .sub-message {
            font-size: 1.5rem;
            color: #9ca3af;
            margin-bottom: 2rem;
        }
        .testimonials {
            width: 100%;
            max-width: 1200px;
            display: flex;
            justify-content: space-around;
            margin-top: 3rem;
        }
        .testimonial-card {
            background-color: #111827;
            border-radius: 8px;
            padding: 2rem;
            width: 30%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .company-name {
            font-size: 1.2rem;
            margin-bottom: 1rem;
        saque
        .testimonial-text {
            color: #d1d5db;
            margin-bottom: 1rem;
            font-style: italic;
        }
        .person-name {
            color: #9ca3af;
            font-size: 0.9rem;
        }
        .social-icons {
            display: flex;
            justify-content: center;
            margin-top: 3rem;
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
        .logout-btn {
            color: #ef4444;
            text-decoration: none;
            margin-left: 20px;
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="logo">WIX</div>
        <div class="header-right">
            <a href="#" class="nav-link active">HOME</a>
            <a href="#" class="nav-link">ABOUT</a>
            <a href="#" class="nav-link">SERVICES</a>
            <a href="#" class="nav-link">CONTACT</a>
            <?php if (is_logged_in()): ?>
                <span style="color: white; margin-left: 20px;">Welcome, <?php echo $_SESSION['username']; ?></span>
                <a style="color: white; margin-left: 20px;" href="logout.php" class="logout-btn">Logout</a>
            <?php else: ?>
                <a href="login.php" class="nav-link">LOGIN</a>
                <a href="register.php" class="nav-link">REGISTER</a>
            <?php endif; ?>
        </div>
    </header>

    <div class="main-content">
        <h1 class="welcome-message">Welcome to Your Website</h1>
        <p class="sub-message">Trusted by Companies and Entrepreneurs Throughout the Country</p>
        
        <div class="testimonials">
            <div class="testimonial-card">
                <h3 class="company-name">San Sea</h3>
                <p class="testimonial-text">"Organized and efficient. The platform has saved us countless hours of work and helped us streamline our process."</p>
                <p class="person-name">- David B.</p>
            </div>
            
            <div class="testimonial-card">
                <h3 class="company-name">BELTOK</h3>
                <p class="testimonial-text">"Flexible and detailed. I particularly love how easy it is to make changes and customize things exactly how you want."</p>
                <p class="person-name">- Louis M.</p>
            </div>
            
            <div class="testimonial-card">
                <h3 class="company-name">Ted & Brooks</h3>
                <p class="testimonial-text">"Creative & Resourceful. Their team went above and beyond to accommodate our unique requirements."</p>
                <p class="person-name">- Karen L.</p>
            </div>
        </div>
        
        <div class="social-icons">
            <a href="#" class="social-icon">f</a>
            <a href="#" class="social-icon">in</a>
            <a href="#" class="social-icon">igRID="register.php">REGISTER</a>
            <a href="#" class="social-icon">tw</a>
        </div>
    </div>
</body>
</html>