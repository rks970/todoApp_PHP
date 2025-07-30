<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>TODOアプリ</title>
    <style>
        .completed {
            text-decoration: line-through;
            color: gray;
        }
        .due {
            font-size: 0.9em;
            color: #666;
        }
    </style>
</head>
<body>
    <h1>TODOリスト</h1>

    <!-- TODO追加フォーム -->
    <form action="/add" method="POST">
        <input type="text" name="task" placeholder="やることを入力" required>
        <input type="date" name="due_date">
        <button type="submit">追加</button>
    </form>

    <h2>やること一覧</h2>

<!-- フィルターリンク -->
<div>
    <a href="/?filter=all">すべて</a> |
    <a href="/?filter=active">未完了</a> |
    <a href="/?filter=completed">完了済み</a>
</div>

<ul>
    <!-- ここにフィルター結果のTODOが並ぶ -->
</ul>
    <ul>
        <?php foreach ($todos as $todo): ?>
            <li class="<?= $todo['is_completed'] ? 'completed' : '' ?>">
                <?= htmlspecialchars($todo['task'], ENT_QUOTES, 'UTF-8') ?>

                <?php if ($todo['due_date']): ?>
                    <span class="due">（期限：<?= htmlspecialchars($todo['due_date'], ENT_QUOTES, 'UTF-8') ?>）</span>
                <?php endif; ?>

                <!-- 完了トグル -->
                <form action="/complete" method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $todo['id'] ?>">
                    <button type="submit">
                        <?= $todo['is_completed'] ? '未完了に戻す' : '完了' ?>
                    </button>
                </form>
                    <!-- 編集ボタン追加 -->
<form action="/edit" method="GET" style="display:inline;">
    <input type="hidden" name="id" value="<?= $todo['id'] ?>">
    <button type="submit">編集</button>
</form>

                <!-- 削除 -->
                <form action="/delete" method="POST" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $todo['id'] ?>">
                    <button type="submit">削除</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>