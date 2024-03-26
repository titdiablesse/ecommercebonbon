<?php 
require 'bdd.php';
session_start();
$pdo = Database::connect();

$couponUser = htmlspecialchars($_POST["code"]);
$dateJour = date('Y-m-d H:i:s');



$stmt = $pdo-> prepare("SELECT * FROM coupons WHERE code = :coupon AND debut <= :dateJ AND fin >= :dateJ ");

$stmt-> execute(["coupon"=>$couponUser, "dateJ"=>$dateJour]);


$coupon = $stmt -> fetch(PDO::FETCH_ASSOC);



// var_dump($_POST["totalPanier"]);
// die();
if(!empty($coupon) ){
    $totalPanier = filter_var($_POST["totalPanier"], FILTER_VALIDATE_FLOAT);
    $remise = $coupon["remise"] ;



    if($coupon["type"] == "%"){
        $remiseValue  = ($remise/100) * $totalPanier ;
        $_SESSION["remise"] = $coupon["remise"] ;
        $_SESSION["typeRemise"] = "%";
        $_SESSION["remiseVal"] = $remiseValue;
    }else{
        $_SESSION["remiseVal"] = $remise;
        $_SESSION["typeRemise"] = "";
        $_SESSION["remise"] = $coupon["remise"] ;
  
    }

    
    header("Location:panier.php?success=valid");
    
    exit();
}else{
    header("Location:panier.php?error=invalid");
    exit();
}
?>