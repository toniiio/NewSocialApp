<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Home</title>
        <link rel="stylesheet" href="../css/style.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous"> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">           
    </head>  
    <body>
      <div class="main"> 
      <?php
       session_start(); 
        ?>
            <nav class="bg-light">
                <div class="container-fluid">
                      <ul class="navbar">
                            <li class="nav-item"><a href="home.php"><img src="../images/accueil.png"></a></li>
                                <?php
                                if(isset($_SESSION['username'])){    
                                ?>
                                <li class="nav-item"><a href="message.php"><img src="../images/messenger.png"></a></li>
                                <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                  <img src="../images/user.png">
                                </a>
                                <ul class="dropdown-menu">
                                <?php echo '<li><a class="dropdown-item" href="comptePerso.php?email='.$_SESSION['email'].'">Compte perso</a></li>' ?>
                                <?php echo '<li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModal" href="deconnexion.php?email='.$_SESSION['email'].'">Déconnexion</a></li>' ?>
                                </ul>
                                </li>
                              </li>           
                                <?php                
                                }else{
                                ?> 
                                <li class="nav-item"><a href='inscription.php'>Inscription</a></li>
                                <li class="nav-item"><a href='connexion.php'>Connexion</a></li>
                                <?php    
                                }
                                ?>    
                      </ul>      
                </div>            
            </nav>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Achtung</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  Etes vous sur de vouloir vous déconnecter ?
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <a href="deconnexion.php" class="btn btn-primary">Déconnexion</a>  
                </div>
              </div>
            </div>
          </div>
        <?php require_once '_partials/snow.php' ?>
          <?php 
            if(isset($_GET['peace'])) {
             ?>
             <img id='bye' src="../images/bye.gif" alt='bye'>
             <?php
            }
          ?>
          <?php
          if(isset($_SESSION['username'])){ 
          ?>  
          <div class="card" style ="width: 25rem;text-align: center;margin-left: 38%;">
            <div class="card-body">
            <button type="button" class="card-text" data-bs-toggle="modal" data-bs-target="#exampleModall" style="border: 3px solid dodgerblue;
            border-radius: 20px;">Écrire un nouveau post</button>
            </div>
            <div class="modal fade" id="exampleModall" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
              <div class="modal-content">
              <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">New Post</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <?php
              include('../autoload.php');
              $userManager = new userManager();
              $user = $userManager->findByEmail($_SESSION['email']);
              ?>
              <div class="userPosition" style="text-align: left;
              margin-bottom: 1%;
              font-weight: bold;">
              <?php
              echo $user->getName()." ".$user->getFirstName();
              ?>
              </div>
              <form method="post">
                <div class="mb-3">
                <textarea class="form-control" id="message-text" name="message" rows="5" required placeholder="Balance ton post"></textarea>
                </div>
            </div>
                <div class="modal-footer">
                  <input type="submit" value="Publier" class="btn btn-primary" style="margin-top:10px;" name="btn-submitPost">
                </div>
              </form>
            </div>
            </div>
            </div>
            </div>
            <?php
              if (isset($_POST['btn-submitPost']))
              {
                $postService = new postService();
                $post = $postService->handleRequest();
                $postManager = new postManager();
                $post->setUserId($user->getId());

                $pdo = new PDO("mysql:host=localhost;dbname=book","root");
                $Insert = 'Insert into post (message,date,userId) values (:mess,:date,:userID)';
                $stmt = $pdo->prepare($Insert);
                $date = new DateTime();
                $interval2h = new DateInterval("PT1H");
                $date->add($interval2h);
                $post->setDate($date->format("d/m/Y"));

                $PostSend = $stmt->execute([
                ':mess' => $post->getMessage(),
                ':date' => $post->getDate(),
                ':userID' => $post->getUserId(),
                ]);
              }
              $pdo = new PDO("mysql:host=localhost;dbname=book","root");
              $select = 'select * from post inner join user on post.userId = user.id';
              $stmt = $pdo->prepare($select); 
              $result = $stmt->execute();
              $recupSelect = $stmt->fetchAll(PDO::FETCH_ASSOC);
              if ($recupSelect != false){
              foreach($recupSelect as $aff){
                
                echo'
                <div class="card" style ="width: 25rem;text-align: center;margin-left: 38%;margin-top: 2%;">
                <div class="card-header">
                <img src="../images/'.$aff['image'].'" style ="height:35px"; alt="profil">'.$aff['name'].' '.$aff['firstName'].'
                <div class="metier">'.utf8_encode($aff['metier']).'</div>
                </div>
                <div class="card-body">
                <p class="card-text" data-bs-toggle="modal" data-bs-target="#exampleModall";>
                '.$aff['message'].'</p>
                </div>
                <div class="card-footer text-muted">
                <img src ="../images/like.png" id="like" style="height:20px" alt="aime">
                <span id="compteurLike"></span>
                <a href="home.php"><img src ="../images/comment.png" id="comment" style="height:20px" alt="commentaire"></a>
                <img src ="../images/share.png" id="share" style="height:25px" alt="partage">
                </div>';
              }
            }
            ?>
          <?php
          }else{
            echo 'haaha';
          }
          ?>
          <footer class="bg-light">
            <?php require_once '_partials/footer.php'; ?>
          </footer>
          <script src="../js/javascript.js"></script> 
          <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
          <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js" integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous"></script>  
        </div>      
    </body>         
</html> 
