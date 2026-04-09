<?php include 'partials/header.php'; ?>

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
            <th>Points</th>
        </tr>
        </thead>
        <tbody>
        <?php
        // Example structure – replace with your real data loop
        // $leaderboard = [...];
        if (!empty($leaderboard)):
            $rank = 1;
            foreach ($leaderboard as $row):
                ?>
                <tr>
                    <td><?= $rank++; ?></td>
                    <td><?= htmlspecialchars($row['username']); ?></td>
                    <td><?= (int)$row['points']; ?></td>
                </tr>
            <?php
            endforeach;
        else:
            ?>
            <tr>
                <td colspan="3" class="empty-state">No results yet. Be the first to play!</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</section>
