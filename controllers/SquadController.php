<?php
require_once __DIR__ . '/../models/Squad.php';
require_once __DIR__ . '/../models/Pauta.php';

class SquadController {
    public function addSquad(string $name): void {
        Squad::add($name);
    }

    public function getSquads(): array {
        return Squad::getAll();
    }

    public function getPautas(string $slug): array {
        return Pauta::list($slug);
    }

    public function getPauta(string $slug, string $file): ?array {
        return Pauta::load($slug, $file);
    }

    public function savePauta(string $slug, string $file, string $content, ?array $upload): void {
        Pauta::save($slug, $file, $content, $upload);
    }

    public function addPauta(string $slug, string $name): void {
        Pauta::create($slug, $name, '');
    }

    public function addComment(string $slug, string $file, string $user, string $text, string $status): void {
        Pauta::addComment($slug, $file, $user, $text, $status);
    }

    public function updateCommentStatus(string $slug, string $file, int $index, string $status): void {
        Pauta::updateCommentStatus($slug, $file, $index, $status);
    }
}
?>
