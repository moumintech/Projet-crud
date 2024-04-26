<?php
// Définition des variables nécessaires pour se connecter à la base de données MySQL
$host = "localhost"; // L'adresse du serveur de base de données, ici c'est localhost, signifiant que la base de données est sur le même serveur
$username = "root"; // Le nom d'utilisateur pour se connecter à la base de données, 'root' est souvent utilisé pour les environnements de développement
$password = ""; // Le mot de passe associé à l'utilisateur de la base de données, ici laissé vide
$dbname = "crud"; // Le nom de la base de données spécifique à laquelle se connecter

// Création de la connexion à la base de données en utilisant les variables définies ci-dessus
$conn = mysqli_connect($host, $username, $password, $dbname);

// Vérification de la connexion
if (!$conn) {
    // Si mysqli_connect retourne false, cela signifie que la connexion a échoué
    die("Connection failed: " . mysqli_connect_error());
    // die() est utilisé pour arrêter le script immédiatement et affiche le message d'erreur fourni par mysqli_connect_error()
}
?>

