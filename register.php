<?php
// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=devSpace', 'root', '');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $pdo->prepare("INSERT INTO Users (username, email, password_hash) VALUES (:username, :email, :password_hash)");
    $stmt->execute([':username' => $username, ':email' => $email, ':password_hash' => $password]);

    echo "<p>Inscription réussie !</p>";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>devSpace-Inscription</title>
</head>
<body>
    <h1>devSpace</h1>
    <form method="POST">
        <input type="text" name="username" placeholder="Nom d'utilisateur" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <button type="submit">S'inscrire</button>
    </form>
    <a href="login.php">Déjà inscrit ? Connectez-vous ici</a>
</body>
</html>
