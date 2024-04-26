<?php
// Définir les variables de connexion à la base de données
$host = "localhost";
$username = "root";
$password = "";
$dbname = "crud";

// Vérifier si un ID utilisateur est passé par URL et le sécuriser en le convertissant en entier
$user_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Vérifier si le formulaire a été soumis
if (isset($_POST['send'])) {
    // Vérifier si les champs 'username' et 'email' sont bien remplis
    if (!empty($_POST['username']) && !empty($_POST['email'])) {
        // Établir une connexion à la base de données
        $conn = mysqli_connect($host, $username, $password, $dbname);
        if (!$conn) {
            die('Échec de la connexion : ' . mysqli_connect_error());
        }

        // Préparer une requête SQL pour mettre à jour les informations de l'utilisateur
        $stmt = mysqli_prepare($conn, "UPDATE users SET username=?, email=? WHERE user_id=?");
        mysqli_stmt_bind_param($stmt, "ssi", $_POST['username'], $_POST['email'], $user_id);

        // Exécuter la requête et rediriger selon le résultat
        if (mysqli_stmt_execute($stmt)) {
            header("Location: montrer_utilisateur.php"); // Redirection en cas de succès
        } else {
            header("Location: montrer_utilisateur.php?message=ModifyFail"); // Redirection avec message d'erreur
        }

        // Fermer la déclaration et la connexion
        mysqli_stmt_close($stmt);
        mysqli_close($conn);
    } else {
        header("Location: montrer_utilisateur.php?message=EmptyFields"); // Rediriger si des champs sont vides
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Document</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <?php
    // Établir à nouveau la connexion pour afficher les informations de l'utilisateur
    $conn = mysqli_connect($host, $username, $password, $dbname);
    if (!$conn) {
        die('Échec de la connexion : ' . mysqli_connect_error());
    }

    // Préparer et exécuter une requête pour obtenir les données de l'utilisateur spécifié
    $stmt = mysqli_prepare($conn, "SELECT * FROM users WHERE user_id=?");
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Boucler sur le résultat pour afficher les données dans un formulaire
    while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <form action="" method="post">
            <h1>Modifier un utilisateur</h1>
            <input type="text" name="username" value="<?= htmlspecialchars($row['username']) ?>" placeholder="Username">
            <input type="email" name="email" value="<?= htmlspecialchars($row['email']) ?>" placeholder="Email">
            <input type="submit" name="send" value="Send">
            <a class="link back" href="modifier_utilisateur.php">Annuler</a>
        </form>
    <?php
    }

    // Fermer la déclaration et la connexion
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    ?>
    
</body>
</html>


