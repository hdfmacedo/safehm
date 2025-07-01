<?php
class Pauta {
    private const BASE_DIR = __DIR__ . '/../data/squads';

    private static function slugify(string $name): string {
        $slug = strtolower(preg_replace('/[^a-z0-9]+/i', '-', $name));
        return trim($slug, '-');
    }

    public static function create(string $squadSlug, string $name, string $content): string {
        $date = date('Y-m-d');
        $slug = self::slugify($name);
        $file = "$date-$slug.json";
        $dir = self::BASE_DIR . "/$squadSlug";
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
        $data = [
            'name' => $name,
            'content' => $content,
            'created_at' => $date,
            'updated_at' => $date
        ];
        file_put_contents("$dir/$file", json_encode($data, JSON_PRETTY_PRINT));
        return $file;
    }

    public static function list(string $squadSlug): array {
        $dir = self::BASE_DIR . "/$squadSlug";
        if (!is_dir($dir)) {
            return [];
        }
        $files = glob("$dir/*.json");
        $pautas = [];
        foreach ($files as $path) {
            $data = json_decode(file_get_contents($path), true);
            if (!$data) {
                continue;
            }
            $data['file'] = basename($path);
            $pautas[] = $data;
        }
        return $pautas;
    }

    public static function load(string $squadSlug, string $file): ?array {
        $path = self::BASE_DIR . "/$squadSlug/$file";
        if (!file_exists($path)) {
            return null;
        }
        $data = json_decode(file_get_contents($path), true);
        return $data ?: null;
    }

    public static function save(string $squadSlug, string $file, string $content, ?array $upload = null): void {
        $path = self::BASE_DIR . "/$squadSlug/$file";
        if (!file_exists($path)) {
            return;
        }
        $data = json_decode(file_get_contents($path), true);
        if (!$data) {
            $data = [];
        }
        if ($upload && isset($upload['tmp_name']) && $upload['tmp_name'] !== '') {
            $imagesDir = self::BASE_DIR . "/$squadSlug/images";
            if (!is_dir($imagesDir)) {
                mkdir($imagesDir, 0777, true);
            }
            $target = $imagesDir . '/' . basename($upload['name']);
            if (move_uploaded_file($upload['tmp_name'], $target)) {
                $content .= "\n![" . basename($upload['name']) . "](images/" . basename($upload['name']) . ")";
            }
        }
        $data['content'] = $content;
        $data['updated_at'] = date('Y-m-d');
        file_put_contents($path, json_encode($data, JSON_PRETTY_PRINT));
    }
}
?>

