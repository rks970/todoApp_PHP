<?php
require_once __DIR__ . '/../db/db.php';

$id = $_POST['id'] ?? null;

if ($id !== null) {
    // 現在の状態を取得
    $stmt = $pdo->prepare("SELECT is_completed FROM todos WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $todo = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($todo) {
        $newStatus = $todo['is_completed'] ? 0 : 1;

        // 状態を反転して更新
        $stmt = $pdo->prepare("UPDATE todos SET is_completed = :status WHERE id = :id");
        $stmt->execute([
            'status' => $newStatus,
            'id' => $id
        ]);
    }
}

header('Location: /');
exit;