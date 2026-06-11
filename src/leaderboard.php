<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/app/core/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/entry.php';

$db = new Database();
$pdo = $db->getConnection();
$leaderboard = Entry::getLeaderboard($pdo);

require_once $_SERVER['DOCUMENT_ROOT'] . '/partials/header.php';
?>

<section class="section-header">
    <h2>Leaderboard</h2>
    <p>Top players ranked by total points.</p>
</section>

<section class="table-wrapper">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Player</th>
                <th>Series</th>
                <th>Episodes</th>
                <th>Score</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($leaderboard)): ?>
                <?php $rank = 1; ?>
                <?php foreach ($leaderboard as $row): ?>
                    <tr>
                        <td><?= $rank++ ?></td>
                        <td><?= htmlspecialchars($row['username']) ?></td>
                        <td><?= htmlspecialchars($row['series_name']) ?></td>
                        <td><?= (int)$row['episodes'] ?></td>
                        <td><?= (int)$row['score'] ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="empty-state">No results yet. Be the first to add one.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</section>
<?php include 'partials/footer.php';?>