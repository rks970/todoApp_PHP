<?php
require_once __DIR__ . '/db/db.php';

// 絞り込みフィルター（未指定なら all）
$allowedFilters = ['all', 'completed', 'active'];
$filter = in_array($_GET['filter'] ?? 'all', $allowedFilters) ? $_GET['filter'] : 'all';

// フィルターに応じてクエリ準備
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

// クエリ実行と取得
try {
    $stmt->execute();
    $todos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    error_log('DB Error: ' . $e->getMessage());
    $todos = [];
}

// ビュー読み込み
require_once __DIR__ . '/../views/todo.php';
