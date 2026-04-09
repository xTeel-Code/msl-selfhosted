<?php
declare(strict_types=1);

class Database{
    private string $host = "msl-selfhosted-db-1";
    private string $username = "root";
    private string $password = "secret";
    private string $dbname = "myapp";
    private PDO $connection;
    public function __construct(){
        $this->connect();
    }
    private function connect(): void{
        $dsn = "mysql:host={$this->host};dbname=$this->dbname;charset=utf8mb4";
        $this->connection = new PDO($dsn, $this->username,$this->password);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
    }
    public function getConnection(): PDO{
        return $this->connection;
    }
}
?>