<?php 
require 'bdd.php';
session_start();
$pdo = Database::connect();
$user_id = isset($_SESSION['userId']) ? $_SESSION['userId'] : null;
$userTemp = isset($_SESSION['userTemp']) ? $_SESSION['userTemp'] : null;

$idItem = isset($_POST['id']) ? $_POST['id'] : null;
// Suppression au panier du l'idproduit qui correspond au produit qu'on veut supprimer pour le propriétaire du panier
$stmt = $pdo->prepare("DELETE FROM panier WHERE produit_id = ? AND user_id =? OR userTemp =?");
if ($stmt -> execute([$idItem,$user_id,$userTemp])){
    echo"success";

}else{
    echo"erreur";
}












?>





