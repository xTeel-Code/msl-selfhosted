<?php include 'partials/header.php'; ?>

<section class="auth-wrapper">
    <div class="auth-card">
        <h2>Login</h2>

        <?php if (!empty($error_message)): ?>
            <div class="alert error">
                <?= htmlspecialchars($error_message) ?>
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
            <button type="submit" class="btn primary full" style="margin-bottom: 10px;">Sign In</button>
            <button type="submit" class="btn outline full">Register</button>
        </form>

        <p class="auth-note">Don’t have an account? Contact the admin to get access.</p>
    </div>
</section>
