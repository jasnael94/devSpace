<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=devSpace', 'root', '');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $content = $_POST['content'];
    $post_id = $_POST['post_id'];
    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare("INSERT INTO Comments (post_id, user_id, content) VALUES (:post_id, :user_id, :content)");
    $stmt->execute([':post_id' => $post_id, ':user_id' => $user_id, ':content' => $content]);

    header("Location: home.php");
}
?>
