<?php include 'header.php'; ?>

<section class="section-header">
    <h2>Available Series</h2>
    <p>Select a series to start answering questions.</p>
</section>

<section class="cards">
    <?php
    // Example: $series_list = [...];
    if (!empty($series_list)):
        foreach ($series_list as $s):
            ?>
            <article class="card series-card">
                <h3><?= htmlspecialchars($s['title']); ?></h3>
                <p><?= htmlspecialchars($s['description']); ?></p>
                <p class="meta">
                    Questions: <?= (int)$s['question_count']; ?> · Difficulty: <?= htmlspecialchars($s['difficulty']); ?>
                </p>
                <a href="series.php?id=<?= (int)$s['id']; ?>" class="btn primary small">Play</a>
            </article>
        <?php
        endforeach;
    else:
        ?>
        <p class="empty-state">No series available right now. Check back soon.</p>
    <?php endif; ?>
</section>
