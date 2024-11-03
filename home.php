<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=devSpace', 'root', '');

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Afficher les publications
$stmt = $pdo->query("SELECT * FROM Posts ORDER BY created_at DESC");
$posts = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Accueil-devSpace</title>
</head>
<body>
    <h1>Accueil</h1>

    <form method="POST" action="create_post.php">
        <textarea name="content" placeholder="Quoi de neuf ?" required></textarea>
        <button type="submit">Publier</button>
    </form>

    <h2>Publications</h2>
    <?php foreach ($posts as $post): ?>
        <div class="post">
            <p><?php echo htmlspecialchars($post['content']); ?></p>
            <p class="date">Posté le <?php echo $post['created_at']; ?></p>
            <form method="POST" action="comment.php">
                <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                <textarea name="content" placeholder="Commentaire" required></textarea>
                <button type="submit">Commenter</button>
            </form>
        </div>
    <?php endforeach; ?>
</body>
</html>
