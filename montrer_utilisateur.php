<!DOCTYPE html>
<html lang="fr">
<head>
    <!-- Définit le jeu de caractères pour le contenu de la page -->
    <meta charset="UTF-8">
    <!-- Assure la compatibilité avec Internet Explorer -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Titre de la page visible dans l'onglet du navigateur -->
    <title>Document</title>
    <!-- Lien vers la feuille de style CSS externe pour styliser la page -->
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <main>
        <!-- Conteneur pour un lien permettant d'ajouter un nouvel utilisateur -->
        <div class="link_container">
            <a class="link" href="ajouter_utilisateur.php">Ajouter un utilisateur</a>
        </div>
        <!-- Tableau pour afficher les utilisateurs existants -->
        <table>
            <thead>
                <!-- Code PHP pour inclure la connexion à la base de données -->
                <?php
                include_once "../connection_ddb.php";
                // Requête SQL pour sélectionner tous les utilisateurs de la base de données
                $sql = "SELECT * FROM users";
                $result = mysqli_query($conn, $sql);
                // Vérifie si la requête retourne des résultats
                if (mysqli_num_rows($result) > 0) {
                    // Entête du tableau où seront listés les utilisateurs
                    ?>
                   
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Modifier</th>
                </tr>
            </thead>
            <tbody>
               <?php
               // Boucle sur chaque utilisateur retourné par la requête
               while ($row = mysqli_fetch_array($result)) {
                ?>
                <tr>
                <!-- Affiche le nom d'utilisateur et l'email dans le tableau -->
                <td><?=$row['username']?></td>
                <td><?= $row['email']?></td>
                <!-- Lien pour modifier l'utilisateur, avec passage de l'ID en paramètre -->
                <td class="image"><a href="modifier_utilisateur.php?id=<?= $row['user_id']?>"><img src="../image/modifier.png" alt="Modifier"></a>
                <!-- Lien pour supprimer l'utilisateur, avec passage de l'ID en paramètre -->
                <td class="image"><a href="supprimer_utilisateur.php?id=<?= $row['user_id']?>"><img src="../image/delect.png" alt="Supprimer"></a>
               </tr>
               <?php
               }
               } else {
                // Message affiché si aucun utilisateur n'est trouvé
                echo "<p class='message'>0 utilisateur présent ! </p>";
               }
               ?>
            </tbody>
        </table>
    </main>
</body>
</html>
