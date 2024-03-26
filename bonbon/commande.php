<?php
require 'bdd.php';
$pdo = Database::connect();
session_start();

$_SESSION["userTemp"] = $_SESSION['userTemp'] ?? time();

$categs = $pdo->query('SELECT * FROM categories')->fetchAll();
// Vérifier si le panier existe dans la session, sinon le créer
if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = array();
}

// Ajouter un article au panier
function ajouterAuPanier($article) {
    $_SESSION['panier'][] = $article;
}

// Exemple d'utilisation pour ajouter un article au panier
$article = array(
    'nom' => 'Article 1',
    'prix' => 10.00,
    'quantite' => 1
);

ajouterAuPanier($article);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="styles.css">

    <title>Passer une commande</title>
</head>
<body>
    <header>
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
                <h1>Au pays de notre enfance</h1>
            </div>
        </div>
    </header>

    <main>
    <div class="container">
        <h1 style="margin-bottom: 20px;">Passer une commande</h1>
        <form action="traitement_commande.php" method="post">
    <div style="margin-bottom: 20px;">
        <label for="nom">Nom :</label><br>
        <input type="text" id="nom" name="nom" required>
    </div>

    <div style="margin-bottom: 20px;">
        <label for="adresse">Adresse :</label><br>
        <input type="text" id="adresse" name="adresse" required>
    </div>

    <div style="margin-bottom: 20px;">
        <label for="telephone">Téléphone :</label><br>
        <input type="text" id="telephone" name="telephone" required>
    </div>

    <div style="margin-bottom: 20px;">
    <label for="articles">Articles commandés :</label><br>
    <?php
    if (isset($_SESSION['panierItems']) && !empty($_SESSION['panierItems'])) {
        $panierItems = $_SESSION['panierItems'];
        foreach ($panierItems as $item) {
            echo "Article : " . $item['name'] . "<br>";
            echo "Quantité : " . $item['qte'] . "<br>";
            echo "Prix total : " . ($item['price'] * $item['qte']) . "<br>"; // Prix total après remise à ajouter ici
            // Vous pouvez ajouter d'autres détails ici
        }
    } else {
        echo "Votre panier est vide.";
    }
    ?>
</div>

    <div style="margin-bottom: 20px;">
        <label for="methode_paiement">Méthode de paiement :</label><br>
        <select id="methode_paiement" name="methode_paiement" required>
            <option value="carte_credit">Carte de crédit</option>
            <option value="paypal">PayPal</option>
            <option value="virement">Virement bancaire</option>
        </select>
    </div>

    <!-- Champ caché pour transmettre le panier -->
    <input type="hidden" name="panier" value="<?php echo htmlspecialchars(json_encode($_SESSION['panier'])); ?>">

    <input type="submit" value="Valider la commande">
</form>
    </div>
</main>
</body>
</html>