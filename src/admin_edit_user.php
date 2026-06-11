<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: /index.php');
    exit;
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/app/core/database.php';

$db = new Database();
$pdo = $db->getConnection();

$id = (int)($_GET['id'] ?? $_POST['id'] ?? 0);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $role = $_POST['role'] ?? 'user';
    $newPassword = trim($_POST['password'] ?? '');

    if ($newPassword !== '') {
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $sql = "UPDATE users
                SET username = :username, role = :role, password = :password
                WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'username' => $username,
            'role' => $role,
            'password' => $hashedPassword,
            'id' => $id
        ]);
    } else {
        $sql = "UPDATE users
                SET username = :username, role = :role
                WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'username' => $username,
            'role' => $role,
            'id' => $id
        ]);
    }

    header('Location: /admin.php');
    exit;
}

$stmt = $pdo->prepare("SELECT id, username, role FROM users WHERE id = :id LIMIT 1");
$stmt->execute(['id' => $id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    die('User not found.');
}

require_once $_SERVER['DOCUMENT_ROOT'] . '/partials/header.php';
?>

<section class="auth-wrapper">
    <div class="auth-card">
        <h2>Edit User</h2>

        <form action="admin_edit_user.php" method="post" class="auth-form">
            <input type="hidden" name="id" value="<?= (int)$user['id'] ?>">

            <div class="form-group">
                <label for="username">Username</label>
                <input
                    type="text"
                    id="username"
                    name="username"
                    required
                    value="<?= htmlspecialchars($user['username']) ?>"
                >
            </div>

            <div class="form-group">
                <label for="role">Role</label>
                <select id="role" name="role" required>
                    <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
                    <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                </select>
            </div>

            <div class="form-group">
                <label for="password">New Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Leave blank to keep current password"
                >
            </div>

            <button type="submit" class="btn primary full">Save Changes</button>
            <a href="admin.php" class="btn outline full" style="margin-top:8px;">Cancel</a>
        </form>
    </div>
</section>
<?php include 'partials/footer.php';?>