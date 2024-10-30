<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Ajout d'une publication
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['content'])) {
    $stmt = $pdo->prepare("INSERT INTO posts (user_id, content) VALUES (?, ?)");
    $stmt->execute([$user_id, $_POST['content']]);
}

$posts = $pdo->query("SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id ORDER BY created_at DESC")->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Accueil</h1>
    <form method="POST">
        <textarea name="content" placeholder="Quoi de neuf ?" required></textarea>
        <button type="submit">Publier</button>
    </form>

    <h2>Publications</h2>
    <?php foreach ($posts as $post): ?>
        <div class="post">
            <p><strong><?php echo htmlspecialchars($post['username']); ?></strong>: <?php echo htmlspecialchars($post['content']); ?></p>
            <small><?php echo $post['created_at']; ?></small>
        </div>
    <?php endforeach; ?>
</body>
</html>
