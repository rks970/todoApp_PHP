<?php
require_once __DIR__ . '/../db/db.php';

$id = $_GET['id'] ?? null;
$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET' && $id !== null) {
    // 編集フォーム表示
    $stmt = $pdo->prepare("SELECT * FROM todos WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $todo = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$todo) {
        echo "TODOが見つかりませんでした。";
        exit;
    }
} elseif ($method === 'POST') {
    // フォーム送信（更新処理）
    $id = $_POST['id'] ?? null;
    $task = $_POST['task'] ?? '';
    $dueDate = $_POST['due_date'] ?? null;

    if ($id !== null && trim($task) !== '') {
        $stmt = $pdo->prepare("UPDATE todos SET task = :task, due_date = :due_date WHERE id = :id");
        $stmt->execute([
            'task' => $task,
            'due_date' => $dueDate !== '' ? $dueDate : null,
            'id' => $id
        ]);
    }

    header('Location: /');
    exit;
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>TODO編集</title>
</head>
<body>
    <h1>TODO編集</h1>

    <form action="/edit" method="POST">
        <input type="hidden" name="id" value="<?= htmlspecialchars($todo['id']) ?>">
        <p>
            内容：<input type="text" name="task" value="<?= htmlspecialchars($todo['task']) ?>" required>
        </p>
        <p>
            期限：<input type="date" name="due_date" value="<?= htmlspecialchars($todo['due_date'] ?? '') ?>">
        </p>
        <button type="submit">更新</button>
        <a href="/">キャンセル</a>
    </form>
</body>
</html>