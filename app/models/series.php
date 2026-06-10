<?php
class Series {
    private PDO $db;
    private string $title;
    private string $description;

    public function __construct(PDO $db, array $data) {
        $this->db          = $db;
        $this->title       = trim($data['title'] ?? '');
        $this->description = trim($data['description'] ?? '');
    }

    public function store(): bool {
        if (empty($this->title)) {
            return false;
        }

        $sql  = "INSERT INTO series (title, description) VALUES (:title, :description)";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'title'       => $this->title,
            'description' => $this->description
        ]);
    }

    public static function getAll(PDO $db): array {
        $stmt = $db->query("SELECT * FROM series ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}