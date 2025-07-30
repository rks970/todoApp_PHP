<?php
// session_start();

// $index = $_POST['index'] ?? null;

// // 指定インデックスが存在する場合のみ削除
// if (isset($_SESSION['todos'][$index])) {
//     unset($_SESSION['todos'][$index]);
//     // 添え字の振り直し（連番維持のため）
//     $_SESSION['todos'] = array_values($_SESSION['todos']);
// }

// header('Location: /');
// exit;
require_once __DIR__ . '/../db/db.php';

$id = $_POST['id'] ?? null;

if ($id !== null) {
    $stmt = $pdo->prepare("DELETE FROM todos WHERE id = :id");
    $stmt->execute(['id' => $id]);
}

header('Location: /');
exit;