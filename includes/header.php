<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

?>

<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>
        GlobalNest
    </title>

    <link rel="stylesheet"
          href="css/style.css">

</head>

<body>


<header class="navbar">

    <div class="logo">
        Global<span>Nest</span>
    </div>


    <nav>

        <a href="index.php">
            Home
        </a>

        <a href="countries.php">
            Countries
        </a>

        <a href="explore.php">
            Find a Home
        </a>

        <a href="roommates.php">
            Roommates
        </a>

        <a href="travel.php">
            Travel
        </a>

    </nav>


    <div class="nav-buttons">

        <?php if (isset($_SESSION['user_id'])): ?>

            <a href="dashboard.php"
               class="login-btn">
                Dashboard
            </a>

            <a href="logout.php"
               class="signup-btn">
                Logout
            </a>

        <?php else: ?>

            <a href="login.php"
               class="login-btn">
                Login
            </a>

            <a href="register.php"
               class="signup-btn">
                Sign Up
            </a>

        <?php endif; ?>

    </div>

</header>