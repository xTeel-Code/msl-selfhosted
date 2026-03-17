<header>
    <div class="topbar">
        <div class="brand">
            <h1>My Series List</h1>
            <p>Tracks all your series</p>
        </div>

        <nav>
            <ul>
                <li><a href="index.php" class="<?= $currentPage === 'index.php' ? 'active' : '' ?>">Home</a></li>
                <li><a href="series.php" class="<?= $currentPage === 'series.php' ? 'active' : '' ?>">My Series</a></li>
                <li><a href="leaderboard.php" class="<?= $currentPage === 'leaderboard.php' ? 'active' : '' ?>">Leaderboard</a></li>
                <li><a href="login.php" class="<?= $currentPage === 'login.php' ? 'active' : '' ?>">Login</a></li>

            </ul>
        </nav>
    </div>
</header>