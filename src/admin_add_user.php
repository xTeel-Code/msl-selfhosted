<?php require_once 'partials/header.php'; ?>

<section class="auth-wrapper">
    <div class="auth-card">
        <h2>Add User</h2>

        <form action="admin_add_user.php" method="post" class="auth-form">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="role">Role</label>
                <select id="role" name="role">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <button type="submit" class="btn primary full" style="margin-bottom: 10px;">Create User</button>
            <a href="admin.php" class="btn outline full">Cancel</a>
        </form>
        <?php
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $db = new Database();
                $pdo = $db->getConnection();
                $user = new user($pdo,$_POST);
                if ($user->store()) {
                    echo "User Added";
                }
            }
        ?>
    </div>
</section>