<?php
session_start();
if (!isset($_SESSION['id'])) {
    header('Location: /login.php');
    exit;
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/app/core/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/entry.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db  = new Database();
    $pdo = $db->getConnection();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $data = [
        'user_id'          => $_SESSION['id'],
        'series_name'      => $_POST['series_name'] ?? '',
        'episodes' => $_POST['episodes'] ?? 0,
        'score'            => $_POST['score'] ?? 0
    ];

    try {
        $entry = new Entry($pdo, $data);
        if ($entry->store()) {
            header('Location: /leaderboard.php');
        } else {
            $error = "Store returned false.";
        }
    } catch (PDOException $e) {
        $error = $e->getMessage();
    }
}
require_once $_SERVER['DOCUMENT_ROOT'] . '/partials/header.php';
?>

<?php if ($error): ?>
    <div class="alert error"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form action="add_series.php" method="post" class="auth-form">
    <div class="form-group">
        <label for="series_name">Series Name</label>
        <input
            type="text"
            id="series_name"
            name="series_name"
            placeholder="e.g. Breaking Bad"
            required
            value="<?= isset($_POST['series_name']) ? htmlspecialchars($_POST['series_name']) : '' ?>"
        >
    </div>

    <div class="form-group">
        <label for="episodes">Episodes</label>
        <input type="number" id="episodes" name="episodes" min="0" required>
    </div>

    <div class="form-group">
        <label for="score">Your Score</label>
        <input type="number" id="score" name="score" min="0" max="10" required>
    </div>

    <button type="submit" class="btn primary full">Submit</button>
    <a href="index.php" class="btn outline full" style="margin-top:8px">Cancel</a>
</form>
<?php include 'partials/footer.php';?>