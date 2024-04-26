<?php
// Assurer que l'user_id est un entier pour éviter l'injection SQL
$user_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Vérifier si le formulaire a été soumis
if (isset($_POST['send'])) {
    // Vérifier si les champs 'username' et 'email' sont présents et non vides
    if (!empty($_POST['username']) && !empty($_POST['email'])) {
        // Inclure le fichier de connexion à la base de données
        include_once "../connection_ddb.php"; // Assurez-vous que le nom du fichier est correct

        // Établir une connexion à la base de données
        $conn = mysqli_connect($host, $username, $password, $dbname);
        if (!$conn) {
            die('Échec de la connexion : ' . mysqli_connect_error());
        }

        // Préparer une requête SQL pour insérer les données et éviter l'injection SQL
        $stmt = mysqli_prepare($conn, "INSERT INTO users (username, email) VALUES (?, ?)");
        mysqli_stmt_bind_param($stmt, "ss", $_POST['username'], $_POST['email']);

        // Exécuter la requête et rediriger en fonction du résultat
        if (mysqli_stmt_execute($stmt)) {
            header("Location: montrer_utilisateur.php");
        } else {
            header("Location: ajouter_utilisateur.php?message=AddFail");
        }

        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    } else {
        header("Location: ajouter_utilisateur.php?message=EmptyFields");
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ajouter un utilisateur</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <form action="" method="post">
        <h1>Ajouter un utilisateur</h1>
        <input type="text" name="username" placeholder="Nom d'utilisateur" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="submit" name="send" value="Envoyer">
        <a class="link back" href="modifier_utilisateur.php">Annuler</a>
    </form>
</body>
</html>

