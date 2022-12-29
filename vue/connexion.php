<?php
    include('../autoload.php');
    if(isset($_POST['btn-submit'])){
        $userService = new userService();
        $email = filter_input(INPUT_POST,"email");
        $password = filter_input(INPUT_POST,"password");
        $userManager = new userManager();
        $verif = $userManager->searchEmail($email,$password); 
        $user = $userManager->findByEmail($email);
    }
?>
<!doctype html>
<html>
    <head>
    <meta charset="UTF-8">
        <title>Connexion</title>
        <link rel="stylesheet" crossorigin="anonymous" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/style.css">    
    </head>
    <body>
    <?php
           if(isset($verif)){
                if($verif == true){     
                    ?>
                    <div class="alert alert-primary" role="alert">
                    <?php
                    echo 'Connexion etablie';
                    ?>
                    </div>
                    <?php
                     session_start();   
                     $_SESSION['username'] = $user->getFirstName();
                     $_SESSION['email'] = $user->getEmail();
                    header("Location: home.php");
                    exit;
                }else{
                    ?>
                    <div class="alert alert-danger" role="alert">
                    <?php    
                    echo'Email ou mot de passe incorrect';
                    ?>
                    </div>
                <?php        
                }
            } 
        ?>
        <div class="col-sm-3">
        <form method="post">    
            <div class="card" style="position:absolute;top:30%;left:35%;width:25%;">
                <div class="card-body">
                    <p class="card-text">
                    <div class="form-group">
                        <input type="email" name="email" id="email" placeholder="Email" required class="form-control">
                    </div>
                    </p>
                    <p class="card-text">
                    <div class="form-group">
                        <input type="password" name="password" id="password" required placeholder="Mot de passe" minlength="6" class="form-control">
                    </div>
                    </p>    
                      <input type="submit" value="Se connecter" class="btn btn-primary" name="btn-submit">  
                      <div class="card-footer bg-transparent border-dark" style="margin-top:5%;"></div>
                      <a href="inscription.php" class="btn btn-success">Inscription</a>        
                </div>
            </div>
        </form> 
        </div>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>
    </body>    
