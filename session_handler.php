<?php
class MySQLSessionHandler implements SessionHandlerInterface {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function open(string $savePath, string $sessionName): bool {
        return true;
    }

    public function close(): bool {
        return true;
    }

    public function read(string $id): string|false {
        $stmt = $this->pdo->prepare("SELECT data FROM php_sessions WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $row['data'] : '';
    }

    public function write(string $id, string $data): bool {
        $stmt = $this->pdo->prepare(
            "REPLACE INTO php_sessions (id, data, timestamp) VALUES (:id, :data, NOW())"
        );
        return $stmt->execute(['id' => $id, 'data' => $data]);
    }

    public function destroy(string $id): bool {
        $stmt = $this->pdo->prepare("DELETE FROM php_sessions WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    public function gc(int $max_lifetime): int|false {
        $stmt = $this->pdo->prepare(
            "DELETE FROM php_sessions WHERE timestamp < (NOW() - INTERVAL :lifetime SECOND)"
        );
        return $stmt->execute(['lifetime' => $max_lifetime]);
    }
}

// Inicjalizacja sesji
$handler = new MySQLSessionHandler($pdo);
session_set_save_handler($handler, true);
session_start();
?>
