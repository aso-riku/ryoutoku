<?php
    require_once '../ryoutoku/connectDB.php';
    if($_POST['username'] && $_POST['password']){
        $pdo = connectDB();
        $sql='SELECT user_name,id FROM user WHERE user_name = ? AND id = ?';
        $stmt=$pdo->prepare($sql);
        $stmt->execute([$_POST['mail'], $_POST['pass']]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!empty($result)){
            session_start();
            $_SESSION['id'] = $result['user_id'];
            $_SESSION['name'] = $result['user_name'];
        }else{
            header('Location: login.php');
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
    <form action="post.php" method="post">
        <p>名前：<input type="text" name="name" required></p>
        <p>コメント：<br>
        <textarea name="comment" rows="4" cols="40" required></textarea></p>
        <p><button type="submit">投稿する</button></p>
    </form>
    <p><a href="view.php">▶ 投稿一覧を見る</a></p>
</body>
</html>