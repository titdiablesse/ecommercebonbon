<?php 
require 'bdd.php';
session_start();
$pdo = Database::connect();

$stmt = $pdo-> prepare(" UPDATE panier SET qte = ? WHERE id = ?");
$upPanier = $stmt->execute([$_POST["qte"],$_POST["id"]]); 
if($upPanier){
    echo "success";
}  else{
    echo "error";
}
?>