<?php
    class userManager{
        function pdo(){
            $pdo="";
            try{
                $pdo = new PDO("mysql:host=localhost;dbname=book","root");
            }catch(PDOException $e){
               $pdo = 'erreur PDO: '.$e->getMessage();
               die();
            }
            return $pdo;
        }
        function insert($user){
           $pdo = new PDO("mysql:host=localhost;dbname=book","root");
           $query = "Insert into user(name,firstName,email,password,birthDate)
            values(:name,:firstName,:email,:password,:birthDate)";
            $stmt="";
            try{
                $stmt = $pdo->prepare($query);
            }catch(PDOexception $e){
                $stmt = 'erreur requete: '.$e->getMessage();
            }
            $result = $stmt->execute([
                ':name' => $user->getName(),
                ':firstName' => $user->getFirstName(),
                ':email' => $user->getEmail(),
                ':password' => password_hash($user->getPassword(),PASSWORD_BCRYPT),
                ':birthDate' => $user->getBirthdate(),
            ]);
            return $result; 
        }
        function searchEmail($email,$password=null){
            $pdo = new PDO("mysql:host=localhost;dbname=book","root");
            $query = "Select email,password from user where email=:email";
            try{
                $stmt = $pdo->prepare($query);
            }catch(PDOException $e){
                echo $e->getMessage();    
            }
            try
            {
                $result = $stmt->execute([
                    ':email' =>$email,
                ]);
            }catch(PDOException $e){
               echo $e->getMessage();        
            }
            $tabSelect = $stmt->fetch(PDO::FETCH_ASSOC);
            $passBdd = $tabSelect['password'];
            $verif = password_verify($password,$passBdd);
            return  $verif;
        }
        function findByEmail($email){
            $pdo = new PDO("mysql:host=localhost;dbname=book","root");
            $query = "Select id,name,firstname,password,birthdate,email,image,metier,couleur,description from user where email=:email";
            $stmt="";
            try{
                $stmt = $pdo->prepare($query);
                }catch(PDOException $e){
                    echo $e->getMessage();    
                }
            $stmt->bindValue(':email',$email);
            $stmt->execute();
            $tabSelect = $stmt->fetch(PDO::FETCH_ASSOC);
            if($tabSelect != false)
            {
                $id = $tabSelect['id'];
                $name = $tabSelect['name'];
                $FirstName = $tabSelect['firstname'];
                $Email= $tabSelect['email'];
                $pass = $tabSelect['password'];
                $date = $tabSelect['birthdate'];
                $img = $tabSelect['image'];
                $metier = $tabSelect['metier'];
                $couleur = $tabSelect['couleur'];
                $descript = $tabSelect['description'];
                return $user = new User($id,$name,$FirstName,$Email,$pass,$date,$img,$metier,$couleur,$descript);
             }            
        }
        function update($user){
            $pdo = new PDO('mysql:host=localhost;dbname=book','root');
            $req = "update user SET name=:name,firstName=:firstname,
            password=:password,birthDate=:birthdate,email=:email where email=:email";
            $stmt="";
            try{
                $stmt = $pdo->prepare($req);
            }catch(PDOException $e){
               echo $e->getMessage();
            }
            $result = $stmt->execute([
                ':name' => $user->getName(),
                ':firstname' => $user->getFirstName(),
                ':password' => $user->getPassword(),
                ':birthdate' => $user->getBirthdate(),
                ':email' => $user->getEmail(),
            ]);
            return $result;
        }
        function delete($user){
         $pdo = new PDO('mysql:host=localhost;dbname=book','root');
         $req = 'Delete from user where email=:email';
         $stmt = $pdo->prepare($req);
         $result = $stmt->execute([
            ':email' => $user->getEmail(),
         ]);  
         return $result; 
        }
    }
?>