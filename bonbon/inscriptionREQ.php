<?php
require 'bdd.php';
$pdo = Database::connect();
if 
(!empty(trim($_POST["nom"])) && filter_var($_POST["email"],FILTER_VALIDATE_EMAIL) && !empty(trim($_POST["pswd"])))
{
$stmt= $pdo->prepare("SELECT * FROM users WHERE email=:mail");
$stmt-> bindValue("mail",$_POST["email"],PDO::PARAM_STR);
$stmt-> execute();
// PDO FETCH_ASSOC permet d'envoyer uniquement un tableau avec des indices alphabétiques, s'il est pas spécifié il retourne 2 tableaux: indices numeriques+indices alpha
$userExists=$stmt->fetch(PDO::FETCH_ASSOC);
if(empty($userExists)){
 $pwdhash= password_hash($_POST["pswd"],PASSWORD_DEFAULT); //Password default utilise la méthode la plus puissante du système actuelle qui existe  
$stmt=$pdo-> prepare("INSERT INTO users (nom, email, mdp) VALUES (?,?,?)");
$success=$stmt-> execute([$_POST["nom"],$_POST["email"],$pwdhash]);
header("location:inscription.php?success=registration");
}else{
    // header permet de rediriger sur une autre page
    header("location:inscription.php?error=authMail");

}

}else{
    header("location:inscription.php?error=fields");
}
