<?php
class user {
    private PDO $db;
    private string $id;
    private string $username;
    private string $password;
    private string $role;

    public function __construct(PDO $db, array $data) {
        $this->db = $db;
        $this->id = $data['id'] ?? '';
        $this->username = $data['username'] ?? '';
        $this->password = $data['password'] ?? '';
        $this->role = $data['role'] ?? 'user';
    }

    public function store(): bool {
        if (empty($this->username) || empty($this->password) || empty($this->role)) {
            echo "Fill out all the fields.";
            return false;
        }

        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, password, role) VALUES (:username, :password, :role)";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'username' => $this->username,
            'password' => $hashedPassword,
            'role'     => $this->role
        ]);
    }
    public function userValidation()
    {
    $sql = "SELECT id, username, password, role FROM users WHERE username = :username LIMIT 1";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['username' => $this->username]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($this->password, $user['password'])) {
        session_regenerate_id(true);
        $_SESSION['id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        return true;
        }
        if (!$user){echo "Bad username or password.";}   
        return false;

    }
}