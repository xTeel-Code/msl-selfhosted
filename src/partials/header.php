<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/core/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/users.php';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quiz App</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<header>
    <div class="topbar">
        <div class="brand">
            <h1>My Series List</h1>
            <p>Compete the series, and climb the leaderboard</p>
        </div>
        <nav>
            <ul>
                <li><a href="index.php" class="<?= basename($_SERVER['PHP_SELF']) === 'index.php' ? 'active' : '' ?>">Home</a></li>
                <li><a href="leaderboard.php" class="<?= basename($_SERVER['PHP_SELF']) === 'leaderboard.php' ? 'active' : '' ?>">Leaderboard</a></li>

                <?php if (isset($_SESSION['id'])): ?>
                    <li><a href="logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="login.php" class="<?= basename($_SERVER['PHP_SELF']) === 'login.php' ? 'active' : '' ?>">Login</a></li>
                <?php endif; ?>

                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                    <li><a href="admin.php" class="<?= basename($_SERVER['PHP_SELF']) === 'admin.php' ? 'active' : '' ?>">Admin</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>
<main>