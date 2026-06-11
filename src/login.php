<?php
if (session_status() == PHP_SESSION_NONE){
    session_start();
}
$my_session_id = session_id();
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/core/database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/app/models/users.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $database = new Database();
    $pdo = $database->getConnection();
    $user = new user($pdo, $_POST);

    if ($user->userValidation()) {
        header('Location: /index.php');
        exit;
    } else {
        $error = "Bad username or password.";
    }
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/partials/header.php';
?>

<section class="auth-wrapper">
    <div class="auth-card">
        <h2>Login</h2>

        <?php if (!empty($error)): ?>
            <div class="alert error">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form action="login.php" method="post" class="auth-form">
            <div class="form-group">
                <label for="username">Username</label>
                <input
                    type="text"
                    id="username"
                    name="username"
                    required
                    value="<?= isset($_POST['username']) ? htmlspecialchars($_POST['username']) : '' ?>"
                >
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    required
                >
            </div>

            <button type="submit" class="btn primary full">Sign In</button>
        </form>

        <p class="auth-note">Don't have an account? Contact the admin to get access.</p>
    </div>
</section>
<?php include 'partials/footer.php';?>