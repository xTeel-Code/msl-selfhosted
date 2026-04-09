<?php include 'partials/header.php'; ?>

<section class="admin-panel">
    <div class="section-header">
        <h2>Admin Panel</h2>
        <p>Manage users, series, and site settings.</p>
    </div>

    <!-- Stats overview -->
    <div class="admin-stats">
        <div class="stat-card">
            <span class="stat-value"><?= isset($total_users) ? (int)$total_users : 0 ?></span>
            <span class="stat-label">Users</span>
        </div>
        <div class="stat-card">
            <span class="stat-value"><?= isset($total_series) ? (int)$total_series : 0 ?></span>
            <span class="stat-label">Series</span>
        </div>
        <div class="stat-card">
            <span class="stat-value"><?= isset($total_entries) ? (int)$total_entries : 0 ?></span>
            <span class="stat-label">Entries</span>
        </div>
    </div>

    <!-- Users table -->
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
                            <td><span class="badge <?= $user['role'] === 'admin' ? 'badge-admin' : 'badge-user' ?>"><?= htmlspecialchars($user['role']) ?></span></td>
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

    <!-- Series table -->
    <div class="admin-section">
        <div class="admin-section-header">
            <h3>Series</h3>
            <a href="admin_add_series.php" class="btn primary small">+ Add Series</a>
        </div>
        <div class="table-wrapper">
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Episodes</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php if (!empty($series)): ?>
                    <?php foreach ($series as $s): ?>
                        <tr>
                            <td><?= (int)$s['id'] ?></td>
                            <td><?= htmlspecialchars($s['title']) ?></td>
                            <td><?= (int)$s['episode_count'] ?></td>
                            <td class="action-cell">
                                <a href="admin_edit_series.php?id=<?= (int)$s['id'] ?>" class="btn outline small">Edit</a>
                                <a href="admin_delete_series.php?id=<?= (int)$s['id'] ?>" class="btn danger small" onclick="return confirm('Delete this series?')">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="empty-state">No series found.</td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
