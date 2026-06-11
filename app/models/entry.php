<?php
class Entry {
    private PDO $db;
    private int $user_id;
    private string $series_name;
    private int $episodes;
    private int $score;

    public function __construct(PDO $db, array $data) {
        $this->db               = $db;
        $this->user_id          = (int)($data['user_id'] ?? 0);
        $this->series_name      = trim($data['series_name'] ?? '');
        $this->episodes = (int)($data['episodes'] ?? 0);
        $this->score            = (int)($data['score'] ?? 0);
    }

    public function store(): bool {
        if ($this->user_id <= 0 || $this->series_name === '') {
            return false;
        }

        $sql = "INSERT INTO entries (user_id, series_name, episodes, score)
                VALUES (:user_id, :series_name, :episodes, :score)";
        $stmt = $this->db->prepare($sql);

        return $stmt->execute([
            'user_id'          => $this->user_id,
            'series_name'      => $this->series_name,
            'episodes' => $this->episodes,
            'score'            => $this->score
        ]);
    }

    public static function getLeaderboard(PDO $db): array {
        $sql = "SELECT u.username, e.series_name, e.episodes, e.score
                FROM entries e
                JOIN users u ON u.id = e.user_id
                ORDER BY e.score DESC, e.created_at DESC";
        $stmt = $db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}