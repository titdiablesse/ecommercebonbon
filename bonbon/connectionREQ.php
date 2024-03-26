<?php 
require 'bdd.php';
$pdo = Database::connect();
session_start();


if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) && !empty(trim($_POST["pswd"]))) {
    $email = htmlspecialchars($_POST['email']);

    $mdp = htmlspecialchars($_POST['pswd']);

    $stmt =$pdo -> prepare('SELECT * FROM users WHERE email = :mail');
    $stmt ->bindValue(':mail',$email, PDO::PARAM_STR);
    $stmt ->execute();
    $userExist =$stmt ->fetch(PDO::FETCH_ASSOC);
    
    

    if(!empty($userExist)){
    $mdpVerif =password_verify($mdp,$userExist['mdp']);
    if($mdpVerif){
    $_SESSION['userId'] = $userExist['id'];
    $_SESSION['userRole'] = $userExist['role'];

    $updatePanier = $pdo->prepare('UPDATE panier SET user_id = :userId WHERE userTemp = :userTempId');
    $updatePanier->execute(['userId'=>  $_SESSION['userId'], 'userTempId' => $_SESSION["userTemp"]]);

    header('Location: index.php');
}else{
    header('Location: inscription.php?error=logpwd');
}
    }else{
        header('Location: inscription.php?error=logMail');   
    }
}else{
    header('Location: inscription.php?error=fields');
}

