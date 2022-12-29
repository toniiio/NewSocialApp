<?php
include('../autoload.php');

if(isset($_POST['btn-submit'])){
    $userService = new userService();
    $user = $userService->handleRequest();
    $errors = $userService->isValid($user); 
    if(empty($errors)){
        session_start();
        $userManager = new userManager();
        $result = $userManager->insert($user);
        $_SESSION['username'] =$user->getFirstName();
        $_SESSION['email'] = $user->getEmail(); 
    }
}
?>
<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Inscription</title>
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
                    echo 'Utilisateur bien enregistré';?>
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
      <h1 style="text-align:center;"> Inscription</h1>
      <form method="post">
        <div class="form-group">
            <label for="name">Nom</label>
            <input type="text" name="name" id="name" class="form-control">
        </div>
        <div class="form-group">
            <label for="firstname">Prenom</label>
            <input type="text" name="firstname" id="firstname" class="form-control">
        </div> 
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" minlength="6" class="form-control">
        </div>
        <div class="form-group">
            <label for="date">Anniversaire</label>
            <input type="date" name="date" id="date" class="form-control">
        </div>
        <input type="submit" value="Valider" class="btn btn-primary" style="margin-top:10px;" name="btn-submit">
        <br> 
        <a href="home.php" class="btn btn-secondary" style="margin-top: 10px;">Retour</a>            
      </form>    
    </body>        
</html>

