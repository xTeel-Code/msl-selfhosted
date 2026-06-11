<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: /index.php');
    exit;
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/app/core/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/entry.php';

$db  = new Database();
$pdo = $db->getConnection();

/* Users table */
$stmt = $pdo->query("SELECT id, username, role FROM users ORDER BY id DESC");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

$stmt = $pdo->query("
    SELECT 
        e.id,
        u.username,
        e.series_name,
        e.episodes,
        e.score,
        e.created_at
    FROM entries e
    JOIN users u ON u.id = e.user_id
    ORDER BY e.id DESC
");
$entries = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total_users = (int)$pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
$total_entries = (int)$pdo->query("SELECT COUNT(*) FROM entries")->fetchColumn();

require_once $_SERVER['DOCUMENT_ROOT'] . '/partials/header.php';
?>
<section class="admin-panel">
    <div class="section-header">
        <h2>Admin Panel</h2>
        <p>Manage users, series, and site settings.</p>
    </div>

    <div class="admin-stats">
        <div class="stat-card">
            <span class="stat-value"><?= $total_users ?></span>
            <span class="stat-label">Users</span>
        </div>
        <div class="stat-card">
            <span class="stat-value"><?= $total_entries ?></span>
            <span class="stat-label">Series</span>
        </div>
        <div class="stat-card">
            <span class="stat-value"><?= $total_entries ?></span>
            <span class="stat-label">Entries</span>
        </div>
    </div>

    <div class="admin-section">
        <div class="admin-section-header">
            <h3>Users</h3>
            <a href="admin_add_user.php" class="btn primary small">+ Add User</a>
        </div>
        <div class="table-wrapper">
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php if (!empty($users)): ?>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= (int)$user['id'] ?></td>
                            <td><?= htmlspecialchars($user['username']) ?></td>
                            <td>
                                <span class="badge <?= $user['role'] === 'admin' ? 'badge-admin' : 'badge-user' ?>">
                                    <?= htmlspecialchars($user['role']) ?>
                                </span>
                            </td>
                            <td class="action-cell">
                                <a href="admin_edit_user.php?id=<?= (int)$user['id'] ?>" class="btn outline small">Edit</a>
                                <a href="admin_delete_user.php?id=<?= (int)$user['id'] ?>" class="btn danger small" onclick="return confirm('Delete this user?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="empty-state">No users found.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

   <div class="admin-section">
    <div class="admin-section-header">
        <h3>Entries</h3>
    </div>
    <div class="table-wrapper">
        <table class="table">
            <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Series Name</th>
                <th>Episodes</th>
                <th>Score</th>
                <th>Created</th>
            </tr>
            </thead>
            <tbody>
            <?php if (!empty($entries)): ?>
                <?php foreach ($entries as $entry): ?>
                    <tr>
                        <td><?= (int)($entry['id'] ?? 0) ?></td>
                        <td><?= htmlspecialchars($entry['username'] ?? '') ?></td>
                        <td><?= htmlspecialchars($entry['series_name'] ?? '') ?></td>
                        <td><?= (int)($entry['episodes'] ?? 0) ?></td>
                        <td><?= (int)($entry['score'] ?? 0) ?></td>
                        <td><?= htmlspecialchars($entry['created_at'] ?? '') ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="empty-state">No entries found.</td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
</section>
<?php include 'partials/footer.php';?>