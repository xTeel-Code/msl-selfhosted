<?php
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: /index.php');
    exit;
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/app/core/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/series.php';

$error   = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db     = new Database();
    $pdo    = $db->getConnection();
    $series = new Series($pdo, $_POST);

    if ($series->store()) {
        $success = "Series added successfully.";
    } else {
        $error = "Title is required.";
    }
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/partials/header.php';
?>

<section class="auth-wrapper">
    <div class="auth-card">
        <h2>Add Series</h2>

        <?php if ($success): ?>
            <div class="alert success"><?= htmlspecialchars($success) ?></div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="alert error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form action="admin_add_series.php" method="post" class="auth-form">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" required
                    value="<?= isset($_POST['title']) ? htmlspecialchars($_POST['title']) : '' ?>">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="3"><?= isset($_POST['description']) ? htmlspecialchars($_POST['description']) : '' ?></textarea>
            </div>

            <button type="submit" class="btn primary full" style="margin-bottom:10px">Add Series</button>
            <a href="admin.php" class="btn outline full">Cancel</a>
        </form>
    </div>
</section>