<?php
class Squad {
    private const DATA_FILE = __DIR__ . '/../data/squads.json';
    private const SQUAD_DIR  = __DIR__ . '/../data/squads';

    private static function slugify(string $name): string {
        $slug = strtolower(preg_replace('/[^a-z0-9]+/i', '-', $name));
        return trim($slug, '-');
    }

    public static function getBySlug(string $slug): ?array {
        foreach (self::getAll() as $squad) {
            if ($squad['slug'] === $slug) {
                return $squad;
            }
        }
        return null;
    }

    public static function getAll(): array {
        if (!file_exists(self::DATA_FILE)) {
            return [];
        }
        $data = json_decode(file_get_contents(self::DATA_FILE), true);
        return is_array($data) ? $data : [];
    }

    public static function add(string $name, string $emoji): void {
        $name = trim($name);
        $emoji = trim($emoji);
        if ($name === '') {
            return;
        }

        $squads = self::getAll();
        $baseSlug = self::slugify($name);
        $slug = $baseSlug;
        $i = 1;
        while (is_dir(self::SQUAD_DIR . '/' . $slug)) {
            $slug = $baseSlug . '-' . $i++;
        }

        if (!is_dir(self::SQUAD_DIR)) {
            mkdir(self::SQUAD_DIR, 0777, true);
        }
        mkdir(self::SQUAD_DIR . '/' . $slug, 0777, true);

        Pauta::create($slug, 'Pauta Principal', '');

        $squads[] = ['name' => $name, 'slug' => $slug, 'emoji' => $emoji];

        if (!is_dir(dirname(self::DATA_FILE))) {
            mkdir(dirname(self::DATA_FILE), 0777, true);
        }
        file_put_contents(self::DATA_FILE, json_encode($squads, JSON_PRETTY_PRINT));
    }
}
?>
