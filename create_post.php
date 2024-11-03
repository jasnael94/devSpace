<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=devSpace', 'username', 'password');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare("INSERT INTO Posts (user_id, content) VALUES (:user_id, :content)");
    $stmt->execute([':user_id' => $user_id, ':content' => $content]);

    header("Location: home.php");
}
?>
