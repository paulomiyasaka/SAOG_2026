<?php

namespace Saog\Config;

use PDO;
use PDOException;

class Database
{
    private string $host = "localhost";
    private string $dbName = "saog";
    private string $username = "root";
    private string $password = "";
    public ?PDO $conn = null;

    public function getConnection(): ?PDO
    {
        $this->conn = null;

        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->dbName};charset=utf8mb4",
                $this->username,
                $this->password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]
            );
        } catch (PDOException $exception) {
            http_response_code(500);
            echo json_encode([
                "status" => "error",
                "message" => "Erro de conexão com o banco de dados: " . $exception->getMessage()
            ], JSON_UNESCAPED_UNICODE);
            exit;
        }

        return $this->conn;
    }
}