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

$id = (int)($_GET['id'] ?? 0);

if ($id === (int)$_SESSION['id']) {
    die('You cannot delete your own account.');
}

$stmt = $pdo->prepare("DELETE FROM users WHERE id = :id");
$stmt->execute(['id' => $id]);

header('Location: /admin.php');
exit;