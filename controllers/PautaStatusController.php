<?php
require_once __DIR__ . '/../models/PautaStatus.php';

class PautaStatusController {
    public function getStatuses(): array {
        return PautaStatus::getAll();
    }

    public function addStatus(string $status, string $color): void {
        PautaStatus::add($status, $color);
    }

    public function updateStatus(string $status, string $color): void {
        PautaStatus::updateColor($status, $color);
    }

    public function removeStatus(string $status): void {
        PautaStatus::remove($status);
    }
}
?>
