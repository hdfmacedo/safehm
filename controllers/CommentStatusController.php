<?php
require_once __DIR__ . '/../models/CommentStatus.php';

class CommentStatusController {
    public function getStatuses(): array {
        return CommentStatus::getAll();
    }

    public function addStatus(string $status): void {
        CommentStatus::add($status);
    }

    public function removeStatus(string $status): void {
        CommentStatus::remove($status);
    }
}
?>
