<?php
require_once __DIR__ . '/db/db.php';

$task = $_POST['task'] ?? '';

if (trim($task) !== '') {
    $stmt = $pdo->prepare("INSERT INTO todos (task) VALUES (:task)");
    $stmt->execute(['task' => $task]);
}

header('Location: /');
exit;