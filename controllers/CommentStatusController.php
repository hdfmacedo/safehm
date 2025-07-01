<?php
require_once __DIR__ . '/../models/CommentStatus.php';

class CommentStatusController {
    public function getStatuses(): array {
        return CommentStatus::getAll();
    }

    public function addStatus(string $status, string $color): void {
        CommentStatus::add($status, $color);
    }

    public function updateStatus(string $status, string $color): void {
        CommentStatus::updateColor($status, $color);
    }

    public function removeStatus(string $status): void {
        CommentStatus::remove($status);
    }
}
?>
