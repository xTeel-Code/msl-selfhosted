<!-- header.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quiz App</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <div class="topbar">
        <div class="brand">
            <h1>Quiz Arena</h1>
            <p>Compete, learn, and climb the leaderboard</p>
        </div>
        <nav>
            <ul>
                <li><a href="index.php" class="<?= basename($_SERVER['PHP_SELF']) === 'index.php' ? 'active' : '' ?>">Home</a></li>
                <li><a href="leaderboard.php" class="<?= basename($_SERVER['PHP_SELF']) === 'leaderboard.php' ? 'active' : '' ?>">Leaderboard</a></li>
                <li><a href="series.php" class="<?= basename($_SERVER['PHP_SELF']) === 'series.php' ? 'active' : '' ?>">Series</a></li>
                <li><a href="login.php" class="<?= basename($_SERVER['PHP_SELF']) === 'login.php' ? 'active' : '' ?>">Login</a></li>
            </ul>
        </nav>
    </div>
</header>
<main>
