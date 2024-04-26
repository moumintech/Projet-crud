<?php
// Variables de connexion à la base de données
$host = "localhost";
$username = "root";
$password = "";
$dbname = "crud";

// Assurer que l'user_id est un entier pour éviter l'injection SQL
$user_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Établir une connexion à la base de données
$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
    die('Échec de la connexion : ' . mysqli_connect_error());
}

// Préparer une déclaration SQL pour supprimer un utilisateur afin de prévenir l'injection SQL
$stmt = mysqli_prepare($conn, "DELETE FROM users WHERE user_id = ?");
mysqli_stmt_bind_param($stmt, "i", $user_id);

// Exécuter la requête et rediriger en fonction du résultat
if (mysqli_stmt_execute($stmt)) {
    header("Location: montrer_utilisateur.php?message=DeleteSuccess");
} else {
    header("Location: montrer_utilisateur.php?message=DeleteFail");
}

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
