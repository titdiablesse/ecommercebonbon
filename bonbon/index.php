<?php
require 'bdd.php';
$pdo = Database::connect();
session_start();

$_SESSION["userTemp"] = $_SESSION['userTemp'] ?? time();


// if(isset($_SESSION[userId]))
// {
//     $id =htmlspecialchars($_SESSION['userId']);

//     $stmt = $db->prepare('SELECT id FROM utilisateurs WHERE id = :Id');
//     $stmt-> bindValue('id', $id, PDO::PARAM_INT);
//     $stmt->execute();
// }

$categs = $pdo->query('SELECT * FROM categories')->fetchAll();
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Bonbon retro</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
        
        <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <div class="container site">
            <!-- Inscription -->
            <?php if (isset($_SESSION['userId'])) { ?>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-circle"></i>
              </a>
              <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="inscription.php">acceuil</a></li>
                <li><a class="dropdown-item" href="./admin/index.php">admin</a></li>
                <li><a class="dropdown-item" href="">Profil</a></li>
                <li><a class="dropdown-item" href="commande.php">Commande</a></li>
                <li><a class="dropdown-item" href="deconnexion.php">Déconnexion</a></li>
              </ul>
            </li>
          <?php } else { ?>
            <li class="nav-item">
              <a class="nav-link" href="inscription.php">Acceuil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="inscription.php">Connexion</a>
            </li>
          <?php } ?>
           
            <div style="text-align:center; display:flex; justify-content:center; align-items:center" class="text-logo">
                <h1 >Au pays de notre enfance </h1>

                <a href="panier.php"class="bi bi-basket3 cart-icon"> </a>
                
            </div>
            
            <nav>
                <ul class="nav nav-pills" role="tablist">                                   
                    <?php 
                        foreach ($categs as $categ) {                       
                    ?>
                        <li class="nav-item " role="presentation">
                            <a class="nav-link m-2 <?= $categ['id'] === 1 ? 'active' : ''; ?>" data-bs-toggle="pill" data-bs-target="#<?= htmlspecialchars($categ['id']);?>" role="tab" ><?= htmlspecialchars($categ['name']) ?></a>
                        </li>
                    <?php } ?>                   
                </ul>
            </nav>
        <?php 
            foreach ($categs as $categ) {   
                /* $query = "SELECT  * FROM items WHERE category = :idCat";
                $stmt = $pdo->prepare($query);
                $stmt->execute(["idCat"=> $categ["id"]]);
                $items = $stmt->fetchAll(PDO::FETCH_ASSOC); */
                
                $query = "SELECT  * FROM items WHERE category = :idCat";
                $stmt = $pdo->prepare($query);

                //Cette methode sécurise les types de valeurs attendues
                $stmt -> bindValue("idCat",$categ["id"], PDO::PARAM_INT);
                $stmt->execute();
                $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>

            <div class="tab-content">
                <div class="tab-pane <?= $categ['id'] === 1 ? 'active' : ''; ?>" id="<?= htmlspecialchars($categ['id']);?>" role="tabpanel">

                    <div class="row">
                        <?php foreach ($items as $item) { ?>
                        <div class="col-md-6 col-lg-4">
                                <div class="img-thumbnail">
                                    <img src="images/<?= htmlspecialchars($item['image']);?>" class="img-fluid" alt="...">
                                    <div class="price"><?= htmlspecialchars($item['price']);?> €</div>
                                    <div class="caption">
                                        <h4><?= htmlspecialchars($item['name']);?></h4>                                   
                                        <p><?= htmlspecialchars($item['description']);?></p>
                                        <a href="addPanierREQ.php?id=<?=htmlspecialchars($item['id']);?>" class="btn btn-order" role="button"><span class="bi-cart-fill"></span> Commander</a>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                </div>
            </div>
        <?php } ?>
        <?php Database::disconnect(); ?>

    </body>
</html>