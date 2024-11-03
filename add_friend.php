<?php
session_start();
$pdo = new PDO('mysql:host=localhost;dbname=devSpace', 'root', '');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id_1 = $_SESSION['user_id'];
    $user_id_2 = $_POST['friend_id'];

    $stmt = $pdo->prepare("INSERT INTO Friends (user_id_1, user_id_2) VALUES (:user_id_1, :user_id_2)");
    $stmt->execute([':user_id_1' => $user_id_1, ':user_id_2' => $user_id_2]);

    header("Location: home.php");
}
?>

<!-- Exemple d'utilisation dans home.php pour le formulaire d'ajout d'ami -->
<form method="POST" action="add_friend.php">
    <input type="hidden" name="friend_id" value="ID_DU_MEILLEUR_AMI">
    <button type="submit">Ajouter comme ami</button>
</form>
