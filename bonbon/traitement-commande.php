<?php
// Vérifiez si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $adresse = $_POST['adresse'];
    $telephone = $_POST['telephone'];
    $methode_paiement = $_POST['methode_paiement'];
    $panier = json_decode($_POST['panier'], true);

    // Connexion à la base de données
    require 'bdd.php';
    $pdo = Database::connect();

    // Insertion de la commande dans la base de données
    $stmt = $pdo->prepare("INSERT INTO commandes (nom, adresse, telephone, methode_paiement, panier) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$nom, $adresse, $telephone, $methode_paiement, json_encode($panier)]);

    // Fermeture de la connexion à la base de données
    $pdo = Database::disconnect();
}
?>