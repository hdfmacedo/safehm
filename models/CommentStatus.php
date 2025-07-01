<?php
class CommentStatus {
    private const FILE = __DIR__ . '/../data/comment_statuses.json';

    public static function ensure(): void {
        if (!file_exists(self::FILE)) {
            $default = ['Aberto', 'Em Andamento', 'Resolvido'];
            if (!is_dir(dirname(self::FILE))) {
                mkdir(dirname(self::FILE), 0777, true);
            }
            file_put_contents(self::FILE, json_encode($default, JSON_PRETTY_PRINT));
        }
    }

    public static function getAll(): array {
        self::ensure();
        $data = json_decode(file_get_contents(self::FILE), true);
        return is_array($data) ? $data : [];
    }

    public static function add(string $status): void {
        $status = trim($status);
        if ($status === '') {
            return;
        }
        $statuses = self::getAll();
        if (in_array($status, $statuses)) {
            return;
        }
        $statuses[] = $status;
        file_put_contents(self::FILE, json_encode($statuses, JSON_PRETTY_PRINT));
    }

    public static function remove(string $status): void {
        $statuses = self::getAll();
        $statuses = array_values(array_filter($statuses, fn($s) => $s !== $status));
        file_put_contents(self::FILE, json_encode($statuses, JSON_PRETTY_PRINT));
    }
}
?>
