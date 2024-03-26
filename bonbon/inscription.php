
<?php
require 'bdd.php';
$pdo = Database::connect();
// $categs = $pdo->query('SELECT * FROM categories')->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration and Login Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css">

    <style>

        .container-account {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .vertical-line {

            border-right: 1px solid black;
            margin-right:50px


        }
    </style>
</head>
<body>
<?php if (isset($_GET["error"]) && $_GET["error"] === "authMail"){?>
    <div class="alert alert-danger" role="alert" style="text-align:center">
        Erreur l'email est déjà utilisé !
    </div>
    <?php }?>
    <?php if (isset($_GET["error"]) && $_GET["error"] === "logMail"){?>
    <div class="alert alert-danger" role="alert" style="text-align:center">
        Erreur le mail n'existe pas !
    </div>
    <?php }?>
    <?php if (isset($_GET["error"]) && $_GET["error"] === "logpwd"){?>
    <div class="alert alert-danger" role="alert" style="text-align:center">
        Erreur le mot de passe ne correspond pas !
    </div>
    <?php }?>
    <?php if (isset($_GET["success"])){?>
    <div class="alert alert-success" role="alert"style="text-align:center">
        Vous êtes inscrit !
    </div>
    <?php }?>

    <?php if (isset($_GET["error"]) && $_GET["error"] === "fields"){?>
    <div class="alert alert-danger" role="alert" style="text-align:center">
        Veuillez remplir tous les champs!
    </div>
    <?php }?>
    <div class="container-account">

        <div class="row">
            <div class="col-md-4">
                <h3>Registration</h3>
                <!-- Acion: envoyer les données dans un fichier de traitement ici ie Inscription.... -->
                <form action="inscriptionREQ.php" method="POST">
                    <div class="mb-3">
                        <label for="regName" class="form-label">Nom</label>
                        <input type="text" name="nom" class="form-control" id="regName" placeholder="Enter your name">
                    </div>
                    <div class="mb-3">
                        <label for="regEmail" class="form-label">Email </label>
                        <input type="email" name="email" class="form-control" id="regEmail" placeholder="Enter your email">
                    </div>
                    <div class="mb-3">
                        <label for="regPassword" class="form-label">Mot de passe</label>
                        <input type="password" name="pswd" class="form-control" id="regPassword" placeholder="Enter a password">
                    </div>
                    <button type="submit" class="btn btn-primary">inscription</button>
                </form>
            </div>
            <div class="col-md-2 vertical-line"></div>
            <div class="col-md-4">
                <h3>Login</h3>
                <form action="connectionREQ.php" method="POST">
                    <div class="mb-3">
                        <label for="loginEmail" class="form-label">Email </label>
                        <input type="email" name="email" class="form-control" id="loginEmail" placeholder="Enter your email">
                    </div>
                    <div class="mb-3">
                        <label for="loginPassword" class="form-label">Mot de passe</label>
                        <input type="password" name="pswd" class="form-control" id="loginPassword" placeholder="Enter your password">
                    </div>
                    <button type="submit" class="btn btn-primary">connexion</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>