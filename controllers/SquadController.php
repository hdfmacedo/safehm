<?php
require_once __DIR__ . '/../models/Squad.php';

class SquadController {
    public function addSquad(string $name): void {
        Squad::add($name);
    }

    public function getSquads(): array {
        return Squad::getAll();
    }
}
?>
