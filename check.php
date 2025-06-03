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
            header('Location: form.php');
            exit;
        }else{
            header('Location: login.php');
            exit;
        }
    }   
?>