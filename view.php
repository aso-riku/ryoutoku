

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>一言掲示板 - 投稿一覧</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>📜 投稿一覧</h1>
    <p><a href="form.php">← 投稿フォームへ戻る</a></p>
    <hr>
    <?php
    require_once 'connectDB.php';
    $pdo = connectDB_local();

    // データベースからコメントを取得
    $stmt = $pdo->query("SELECT user_name, content, A.created_at FROM comment A, user B WHERE A.user_id = B.id ORDER BY created_at DESC");
    if ($stmt->rowCount() > 0) {
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $name = htmlspecialchars($row['user_name']);
            $comment = htmlspecialchars($row['content']);
            $time = date('Y-m-d H:i:s', strtotime($row['created_at']));
            echo "<div class='post'>";
            echo "<p><strong>$name</strong> さん ($time)</p>";
            echo "<p>" . nl2br($comment) . "</p>";
            echo "</div><hr>";
        }
    } else {
        echo "<p>まだ投稿がありません。</p>";
    }

    // $filename = 'comments.txt';
    // if (file_exists($filename)) {
    //     $lines = file($filename, FILE_IGNORE_NEW_LINES);
    //     foreach (array_reverse($lines) as $line) {
    //         [$time, $name, $comment] = explode("\t", $line);
    //         echo "<div class='post'>";
    //         echo "<p><strong>$name</strong> さん ($time)</p>";
    //         echo "<p>" . nl2br($comment) . "</p>";
    //         echo "</div><hr>";
    //     }
    // } else {
    //     echo "<p>まだ投稿がありません。</p>";
    // }
    ?>
</body>
</html>
