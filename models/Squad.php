<?php
class Squad {
    private const DATA_FILE = __DIR__ . '/../data/squads.json';

    public static function getAll(): array {
        if (!file_exists(self::DATA_FILE)) {
            return [];
        }
        $data = json_decode(file_get_contents(self::DATA_FILE), true);
        return is_array($data) ? $data : [];
    }

    public static function add(string $name): void {
        $name = trim($name);
        if ($name === '') {
            return;
        }
        $squads = self::getAll();
        $squads[] = $name;
        if (!is_dir(dirname(self::DATA_FILE))) {
            mkdir(dirname(self::DATA_FILE), 0777, true);
        }
        file_put_contents(self::DATA_FILE, json_encode($squads, JSON_PRETTY_PRINT));
    }
}
?>
