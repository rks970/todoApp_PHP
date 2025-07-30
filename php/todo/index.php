<?php
require_once __DIR__ . '/../db/db.php';
// クエリパラメータから絞り込み条件取得
$filter = $_GET['filter'] ?? 'all';

switch ($filter) {
    case 'completed':
        $stmt = $pdo->prepare("SELECT * FROM todos WHERE is_completed = 1 ORDER BY due_date IS NULL, due_date ASC");
        break;
    case 'active':
        $stmt = $pdo->prepare("SELECT * FROM todos WHERE is_completed = 0 ORDER BY due_date IS NULL, due_date ASC");
        break;
    default:
        $stmt = $pdo->prepare("SELECT * FROM todos ORDER BY due_date IS NULL, due_date ASC");
}

$stmt->execute();
$todos = $stmt->fetchAll(PDO::FETCH_ASSOC);
require_once __DIR__ . '/../views/todo.php';
