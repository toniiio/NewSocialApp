<?php
include('../autoload.php'); 
$userManager = new userManager();
$user = $userManager->findByEmail($_GET['email']); 
?>
<!doctype HTML>
<head>
    <meta charset="UTF-8">
    <title>Compte perso</title>
    <link rel="stylesheet" crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">     
</head>
<body>
<div class="card" style="width: 18rem;">
  <img src="..." class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title"><?php echo $user->getName()." ".$user->getFirstName()?></h5>
    <p class="card-text"><?php echo $user->getEmail()?></p>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">An item</li>
    <li class="list-group-item">A second item</li>
    <li class="list-group-item">A third item</li>
  </ul>
  <div class="card-body">
    <a href="update.php" class="btn btn-info">Modifier</a>
    <a href="delete.php" class="btn btn-danger">Supprimer compte</a>
  </div>
</div>
<a href="home.php" class="btn btn-link">retour</button>                
</body>       