<?php
    session_start();
    require_once '../ryoutoku/connectDB.php';
    if(isset($_POST['username']) && isset($_POST['password'])){
        $pdo = connectDB();
        $sql='SELECT * FROM user WHERE user_name = ? AND password = ?';
        $stmt=$pdo->prepare($sql);
        $stmt->execute([$_POST['username'], $_POST['password']]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!empty($result)){
            $_SESSION['id'] = $result['id'];
            $_SESSION['name'] = $result['user_name'];
        }else{
            header('Location: login.php');
            exit;
        }
    }   
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>一言掲示板 - 投稿</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>💬 一言掲示板</h1>
    <?= $_SESSION['id']. $_SESSION['name'] ? "<p>ようこそ、{$_SESSION['name']}さん！</p>" : '' ?>
    <form action="post.php" method="post">
        <p>コメント：<br>
        <textarea name="comment" rows="4" cols="40" required></textarea></p>
        <p><button type="submit">投稿する</button></p>
    </form>
    <p><a href="view.php">▶ 投稿一覧を見る</a></p>
</body>
</html>