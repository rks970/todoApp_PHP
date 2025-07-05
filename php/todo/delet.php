<?php
require_once __DIR__ . '/../db/db.php';

$id = $_POST['id'] ?? null;

if ($id !== null) {
    $stmt = $pdo->prepare("DELETE FROM todos WHERE id = :id");
    $stmt->execute(['id' => $id]);
}

header('Location: /');
exit;