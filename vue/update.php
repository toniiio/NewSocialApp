<?php
include('../autoload.php'); 
session_start();
$userManager = new userManager();
$user = $userManager->findByEmail($_SESSION['email']);
if(isset($_POST['btn-submit'])){
    $userService = new userService();
    $newUser = $userService->handleRequest($user);
    $errors = $userService->isValid($newUser);
    var_dump($newUser);
    if(empty($errors)){
      $result = $userManager->update($newUser);    
    }
}

?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Modification</title>
        <link rel="stylesheet" crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">
    </head>
    <body>
        <?php
            if(isset($errors))
            {
            foreach($errors as $error){
                ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error;?>
                </div>
            <?php    
            }
            }
            if(isset($result)){
                if($result == true){
                    ?>
                    <div class="alert alert-primary" role="alert">
                    <?php    
                    echo 'Modification des informations de l\'utilisateur';?>
                    <?php
                    header("Location: home.php");
                    exit;
                }else{
                    ?>
                    <div class="alert alert-danger" role="alert">
                    <?php    
                    echo'probleme serveur';
                    ?>
                    </div>
                <?php        
                }
            }
        ?>
      <h1 style="text-align:center;">Modification</h1>
      <form method="post">
        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" name="name" id="name" class="form-control" <?php echo "value=".$user->getName()."" ?> >
        </div>
        <div class="form-group">
            <label for="firstname">Prenom</label>
            <input type="text" name="firstname" id="firstname" class="form-control" <?php echo "value=".$user->getFirstName()."" ?>>
        </div> 
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" <?php echo "value=".$user->getEmail()."" ?>>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" minlength="6" class="form-control" <?php echo "value=".$user->getPassword()."" ?>>
        </div>
        <div class="form-group">
            <label for="date">Anniversaire</label>
            <input type="date" name="date" id="date" class="form-control" <?php echo "value=".$user->getBirthdate()."" ?>>
        </div>
        <input type="submit" value="Valider" class="btn btn-primary" style="margin-top:10px;" name="btn-submit">
        <br>
        <a href="home.php" style="margin-top:10px;" class="btn btn-secondary">Retour</a>  
      </form>    
    </body>        
</html>
