<?php
class PautaStatus {
    private const FILE = __DIR__ . '/../data/pauta_statuses.json';

    public static function ensure(): void {
        if (!file_exists(self::FILE)) {
            $default = [
                ['name' => 'Aberto', 'color' => '#ff0000'],
                ['name' => 'Em Andamento', 'color' => '#ffff00'],
                ['name' => 'Resolvido', 'color' => '#00ff00']
            ];
            if (!is_dir(dirname(self::FILE))) {
                mkdir(dirname(self::FILE), 0777, true);
            }
            file_put_contents(self::FILE, json_encode($default, JSON_PRETTY_PRINT));
        }
    }

    public static function getAll(): array {
        self::ensure();
        $data = json_decode(file_get_contents(self::FILE), true);
        if (is_array($data) && isset($data[0]) && is_string($data[0])) {
            $data = array_map(fn($s) => ['name' => $s, 'color' => '#ffffff'], $data);
            file_put_contents(self::FILE, json_encode($data, JSON_PRETTY_PRINT));
        }
        return is_array($data) ? $data : [];
    }

    public static function add(string $status, string $color): void {
        $status = trim($status);
        $color = trim($color);
        if ($status === '' || $color === '') {
            return;
        }
        $statuses = self::getAll();
        foreach ($statuses as $st) {
            if ($st['name'] === $status) {
                return;
            }
        }
        $statuses[] = ['name' => $status, 'color' => $color];
        file_put_contents(self::FILE, json_encode($statuses, JSON_PRETTY_PRINT));
    }

    public static function updateColor(string $status, string $color): void {
        $statuses = self::getAll();
        foreach ($statuses as &$st) {
            if ($st['name'] === $status) {
                $st['color'] = $color;
            }
        }
        file_put_contents(self::FILE, json_encode($statuses, JSON_PRETTY_PRINT));
    }

    public static function remove(string $status): void {
        $statuses = self::getAll();
        $statuses = array_values(array_filter($statuses, fn($s) => $s['name'] !== $status));
        file_put_contents(self::FILE, json_encode($statuses, JSON_PRETTY_PRINT));
    }
}
?>
