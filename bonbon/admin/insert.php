
<?php
require '../bdd.php';
session_start();
if (!isset($_SESSION['userRole']) || $_SESSION['userRole'] !== 'admin') {
    header('Location: ../index.php');
    exit();
}

$db = Database::connect();

$categories = $db->query('SELECT * FROM categories')->fetchAll(PDO::FETCH_ASSOC);

Database::disconnect();



?>

<!DOCTYPE html>
<html>
    <head>
        <title>Burger Code</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link rel="stylesheet" href="../styles.css">
    </head>
    
    <body>
        <h1 class="text-logo">Burger Code</h1>
        <div class="container admin">
            <div class="row">
                <h1><strong>Ajouter un item</strong></h1>
                <br>
                <form class="form" action="addProdREQ.php" method="POST" enctype="multipart/form-data" >
                    <br>
                    <div>
                        <label class="form-label" for="name">Nom:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nom" value="">
                        <span class="help-inline"></span>
                    </div>
                    <br>
                    <div>
                        <label class="form-label" for="description">Description:</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="Description" value="">
                        <span class="help-inline"></span>
                    </div>
                    <br>
                    <div>
                        <label class="form-label" for="price">Prix: (en €)</label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="Prix" value="">
                        <span class="help-inline"></span>
                    </div>
                    <br>
                    <div>
                        <label class="form-label" for="qte">Quantité stock: </label>
                        <input type="number" step="0.01" class="form-control" id="qte" name="qte" placeholder="qte" value="">
                        <span class="help-inline"></span>
                    </div>
                    <br>
                    <div>
                        <label class="form-label" for="category">Catégorie:</label>
                        <select class="form-control" id="category" name="category">
                    
                                <?php foreach ($categories as $cat) { ?>
                                    <option value="<?= $cat['id']; ?>"><?= $cat['name']; ?></option>
                                <?php } ?>
                           
                        </select>
                        
                    </div>
                    <br>
                    <div>
                        <label class="form-label" for="img">Sélectionner une image:</label>
                        <input type="file" id="img" name="img"> 
                        <span class="help-inline"></span>
                    </div>
                    <br>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success"><span class="bi-pencil"></span> Ajouter</button>
                        <a class="btn btn-primary" href="index.html"><span class="bi-arrow-left"></span> Retour</a>
                   </div>
                </form>
            </div>
        </div>   
    </body>
</html>