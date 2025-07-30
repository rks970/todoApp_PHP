<?php
require_once __DIR__ . '/../db/db.php';

$task = $_POST['task'] ?? '';
$dueDate = $_POST['due_date'] ?? null;

if (trim($task) !== '') {
    $stmt = $pdo->prepare("INSERT INTO todos (task, due_date) VALUES (:task, :due_date)");
    $stmt->execute([
        'task' => $task,
        'due_date' => $dueDate !== '' ? $dueDate : null

    ]);
}

header('Location: /');
exit;