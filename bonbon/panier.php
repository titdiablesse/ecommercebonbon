<?php 
require 'bdd.php';
session_start();
$pdo = Database::connect();
//Si la session usertemp et userID existent on leur affecte leur valeur et si ça n'exite pas ça devient null
$userTemp = $_SESSION["userTemp"]??null;
$userId = $_SESSION["userId"]??null;
// var_dump ($_SESSION);
// die();
$stmt = $pdo->prepare(
    'SELECT panier.*, items.name, items.price, items.image  
    FROM panier
    JOIN items ON panier.produit_id = items.id
    WHERE (userTemp = ? OR user_id = ?)');

$stmt->execute([$userTemp, $userId]);

$panierItems = $stmt-> fetchAll(PDO::FETCH_ASSOC);

$totalPanier=0 ;
// $totalPanier += $panierItems['price'] * $panierItems['qte'];

$pdo = Database::disconnect();
// unset($_SESSION["typeRemise"]);

?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="styles.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    </head>

    <body>
        <div class="cart ">
            <!-- <div class="alert alert-danger" role="alert" style="text-align:center;">
                Votre panier est vide !
            </div> -->
        
            <div class="cart-container">
                <div class="row justify-content-between">
                    <div class="col-12">
                        <div class="">
                            <div class="">
                                <table class="table table-bordered mb-30">
                                    <thead>
                                        <tr>
                                            <th scope="col"></th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Produit</th>
                                            <th scope="col">Prix unitaire</th>
                                            <th scope="col">Quantité</th>
                                            <th scope="col">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($panierItems as $items){ ?>
                                        <tr>
                                            <th scope="row">
                                                <a class="delete" data-id="<?= $items["id"];?>" href="">
                                                    <i class="bi bi-archive"></i>
                                                </a>
                                            </th>

                                            <td>
                                                <img src="images/<?php echo $items['image'] ?>" alt="Product" style="width:100px">
                                            </td>
                                            <td>
                                                <a href=""></a><br>
                                                <span ><small><?php echo $items['name'] ?></small></span>
                                            </td>
                                            <td class="prix-unitaire"><?php echo $items['price'] ?> €</td>
                                            <td>
                                                <div  class="quantity"
                                                    style="display:flex; justify-content:center; align-items:center">

                                                    <!-- <a href=""
                                                        style="border:none; background-color:white; text-decoration:none; color:black">
                                                    </a> -->
                                                    <button
                                                        data-action="decrease"
                                                        data-id="<?php echo $items['id'];?>"
                                                        class="changeQte"
                                                        style="font-size:40px; margin-right:10px; margin-left:10px">-</button>
                                                    <span id="qtpanier"><?php echo $items['qte'] ?></span>
                                                    <button
                                                        data-action="increase"
                                                        data-id="<?php echo $items['id'];?>"
                                                        class="changeQte"
                                                        style="font-size:40px; margin-left:10px; margin-right:10px">+</button>
                                                    <!-- <a href=""
                                                        style="border:none; background-color:white; text-decoration:none;  color:black">
                                                    </a> -->
                                                </div>
                                            </td>
                                            <td class="sous-total"><?php echo $items['price'] * $items['qte']; ?>  €</td>
                                            
                                        </tr>
                                        <?php $totalPanier += $items['price'] * $items['qte']; ?>
                                        <?php } ?>

                                        <!-- Récup avec la session -->

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Coupon -->
                    <div class="col-12 col-lg-6">
                        <div class=" mb-30">
                            <h6>Avez vous un coupon?</h6>
                            <p>Entrer le code de la remise</p>

                            <?php if (isset($_GET["error"]) && $_GET["error"] === "invalid"){?>
                            <div class="alert alert-danger" role="alert">
                                Attention : le code remise saisi est incorrect !
                            </div>
                            <?php }?>

                            <?php if (isset($_GET["success"]) && $_GET["success"] === "valid"){?>
                            <div class="alert alert-primary" role="alert">
                                Vous avez ajouté un code de réduction !
                            </div>
                            <?php }?>
                        <!-- Coupon -->
                            <div class="coupon-form">
                                <form action="couponREQ.php" method="POST">
                                    <input type="text" class="form-control" name="code" placeholder="Entrer le code">
                                    <input type="hidden" name="totalPanier" value="<?= $totalPanier ?>">
                                    <button type="submit" class="btn btn-primary"
                                        style="margin-top:20px">Valider</button>
                                </form>
                            </div>
                            <br>

                            <!-- Coupon -->
                        <form action="couponREQ.php" method="POST">
                             <input type="text" class="form-control" name="code" placeholder="Entrer le code">
                             <input type="hidden" name="totalPanier" value="<?= $totalPanier ?>">
                                 <button type="submit" class="btn btn-primary" style="margin-top:20px">Valider</button>
                            <a class="btn btn-success" href="commande.php" style="margin-top:20px">Valider la commande</a>
                        </form>


                        </div>
                    </div>


                    <div class="col-12 col-lg-5">
                        <div class=" mb-30">
                            <h5 class="mb-3">Total panier</h5>
                            <div class="">
                                <table class="table mb-3">
                                    <tbody>
                                        <tr>
                                            <td>Total produit HT</td>
                                            <td class="total-panier"> <?php echo $totalPanier ?> €</td>
                                        </tr>
                                        <tr>
                                            <td>TVA</td>
                                            <td id="TVA"> <?php echo $tvaPanier = $totalPanier * 0.2 ?> €</td>
                                        </tr>
                                        <?php if(isset($_SESSION["remiseVal"])){ ?> 
                                        <tr>
                                            <td>Remise</td>
                                            
                                            <td id="remise">- <?php echo $_SESSION["remiseVal"];?> </td>
                                        </tr>
                                        <?php }?>
                                        
                                        
                                        <tr>
                                            <td>TOTAL TTC</td>
                                            <?php if (isset($_SESSION["remiseVal"])){
                                                $remise = $_SESSION["remiseVal"];
                                               ?>
                                                <td id='TTC'> <?php echo ($totalPanier + $tvaPanier) - $remise?> €</td>
                                            <?php } else {?>
                                                <td id='TTC'> <?php echo ($totalPanier + $tvaPanier) ?> €</td>
                                                <?php } ?>
                                            
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
                <a class="btn btn-primary" href="index.php"><span class="bi-arrow-left"></span> Retour</a>
            </div>
        </div>
     
    </body>

</html>
<script>
    // Mettre à jour la quantité
    // On récupère tous les boutons de changement de quantité
    document.querySelectorAll('.changeQte').forEach(function(btn){
        //  On crée un écouteur d'événement sur chaque bouton

        btn.addEventListener('click', function(e){
            
            const action = this.dataset.action 
            const id = this.dataset.id
            // On récupère le tr sur lequel se trouve le span
            let row = this.closest('tr')
            let qteEle = row.querySelector('#qtpanier')
            let sousTotal = row.querySelector('.sous-total')
            let prixUnitaire = parseFloat(row.querySelector('.prix-unitaire').textContent)
            let totalPanier = 0
            let typeRemise = "<?= isset($_SESSION["typeRemise"])?$_SESSION["typeRemise"]:null;?>"
            let remiseRel = "<?= isset($_SESSION["remise"])?$_SESSION["remise"]:null ;?>"
            

           console.log( "azert"+typeRemise,remiseRel)
      
            
            // On récupère la qte 
            let newQte = parseInt(qteEle.textContent)

            if(action === 'increase'){
                newQte++
            }
            if(action === 'decrease' && newQte > 1){
                newQte--
            }

            // qteEle.textContent = newQte

            // On créer une requête asynchrone pour mettre à jour la qte en bdd
            fetch('updateREQ.php', {
                // method : comment on envoie les données
                method: 'POST',
                // headers  sous quelle forme on envoie les données
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                // Les données qu'on envoie
                body: `id=${id}&qte=${newQte}`
            })

            // Réagir à la réponse
            .then(response => response.text())
            .then(data => {
                    if(data.trim() === 'success'){
                        qteEle.textContent = newQte

                        // Mettre à jour le sous-total
                        sousTotal.textContent = (prixUnitaire * newQte).toFixed(2) + '€'

                        // Mettre à jour le total du panier
                        document.querySelectorAll('.sous-total').forEach(function(st){
                            totalPanier += parseFloat(st.textContent)
                        })
                        document.querySelector('.total-panier').textContent = totalPanier.toFixed(2) + '€'
                    //    Mettre à jour la TVA
                    let TVA = totalPanier * 0.2
                        document.querySelector('#TVA').textContent = TVA.toFixed(2) + '€'

                    //  Mettre à jour le montant TTC

                    let TTC = totalPanier + TVA
                
                        
                    // Mettre à jour le motant total TTC avec remise 
                        if(typeRemise === "%"){
                            let remise = TTC*(remiseRel / 100)
                           TTC = TTC - remise
                           document.querySelector("#remise").textContent = remise.toFixed(2) + '€'
                           
                        } else {
                            TTC = TTC-remiseRel
                          if (TTC >0){
                            TTC=TTC
                          }else{
                            TTC=0
                          }
                        }

                        document.querySelector('#TTC').textContent = TTC.toFixed(2) + '€'

                    }else{
                        console.log("Erreur")
                    }
            })      



        })

    })          
    // Supprimer un produit du panier en utilisant une méthode asynchrone
                document.querySelectorAll(".delete").forEach(function(ele){
                    ele.addEventListener("click",function(e){
                        e.preventDefault()
                        let id = this.dataset.id
                        let typeRemise = "<?= isset($_SESSION["typeRemise"])?$_SESSION["typeRemise"]:null;?>"
                        let remiseRel = "<?= isset($_SESSION["remise"])?$_SESSION["remise"]:null ;?>"
                        let conf = confirm("Etes-vous sur de vouloir confirmer cet article?")
                        if(conf){
                            fetch("suppitems.php",{
                                method:"POST",
                                headers: {
                                        'Content-Type': 'application/x-www-form-urlencoded'
                                         },  
                                // Les données qu'on envoie
                                body: `id=${id}`
                                })

                                // Réagir à la réponse
                                .then(response => response.text())
                                .then(data => {
                                if(data.trim() === 'success'){
                                    let row = this.closest("tr")
                                    row.remove()
                                    let totalPanier = 0
                                    document.querySelectorAll('.sous-total').forEach(function(st){
                                    totalPanier += parseFloat(st.textContent)})
                                    document.querySelector('.total-panier').textContent = totalPanier.toFixed(2) + '€'
                   
                                let TVA = totalPanier * 0.2
                                    document.querySelector('#TVA').textContent = TVA.toFixed(2) + '€'
                                let TTC = totalPanier + TVA     
                                if(typeRemise === "%"){
                                    let remise = TTC*(remiseRel / 100)
                                    TTC = TTC - remise
                                    document.querySelector("#remise").textContent = remise.toFixed(2) + '€'
                           
                                } else {
                                    TTC = TTC-remiseRel
                                if (TTC >0){
                                    TTC=TTC
                                }else{
                                    TTC=0
                          }
                        }

                                    document.querySelector('#TTC').textContent = TTC.toFixed(2) + '€'
                                } else {
                                    console.log("erreur")
                                }

                            })
                        }
                    })
                }) 
</script>
</body>
</html>