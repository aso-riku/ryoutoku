<?php
session_Start();
require_once 'connectDB.php';
$pdo = connectDB();

$name = htmlspecialchars($_POST['name'] ?? '名無し');
$comment = htmlspecialchars($_POST['comment'] ?? '');
$time = date('Y-m-d H:i:s');

if (trim($comment) === '') {
    header("Location: form.php");
    exit;
}

$stmt = $pdo->prepare("INSERT INTO comment (user_id, content, created_at) VALUES (?, ?)");
$stmt->execute([$_SESSION['id'], $comment, $time]);

// $entry = "$time\t$name\t$comment\n";
// file_put_contents('comments.txt', $entry, FILE_APPEND);
header("Location: view.php");
exit;
?>
