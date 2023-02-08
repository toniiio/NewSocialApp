<?php
    class userService{
        function handleRequest($user=null){
            $name = filter_input(INPUT_POST,'name');
            $firtName = filter_input(INPUT_POST,'firstname');
            $email = filter_input(INPUT_POST,'email');
            $password = filter_input(INPUT_POST,'password');
            $date = filter_input(INPUT_POST,'date');
            $metier = filter_input(INPUT_POST,'metier');
            $description = filter_input(INPUT_POST,'descript');
            $img = filter_input(INPUT_POST,'imgProfil');
            if($user != null)
            {
                $user->setName($name);
                $user->setFirstName($firtName);
                $user->setEmail($email);
                $user->setPassword($password);
                $user->setBirthdate($date);
                $user->setMetier($metier);
                $user->setDescript($description);
                $user->setImg($img);
                return $user;    
            }else
            {
                $user = new User(null,$name,$firtName,$email,$password,$date,$metier,$description,$img);
                return $user;
            }
        }
        function handleRequestPost(){
            $message = filter_input(INPUT_POST,'message');
            
        }
        function isValid($user){
            $errors=[];
            if($user->getName() == "" || mb_strlen($user->getName()) < 2 || mb_strlen($user->getName()) > 30 ){
                $errors["name"] = "Champ nom incorrect veuillez réessayer";
            }
            if($user->getFirstName() == "" || mb_strlen($user->getFirstName()) < 2 || mb_strlen($user->getFirstName()) > 30 ){
                $errors["firstname"] = "Champ prenom incorrect veuillez réessayer";
            }
            if($user->getEmail() == "" || filter_var($user->getEmail(),FILTER_VALIDATE_EMAIL) == false){
                $errors["email"] = "Champ email incorrect veuillez réessayer";
            }
            if($user->getPassword() == "" || !preg_match('#^[a-z0-9A-Z]{6,}$#',$user->getPassword())){
                $errors["password"] = "Champ password incorrect veuillez réessayer";
            }
            if($user->getBirthdate() == ""){
                $errors["birthdate"] = "Champ anniversaire incorrect veuillez réessayer";
            }
            if($user->getMetier() == "" || mb_strlen($user->getMetier()) < 2){
                $errors["metier"] = "Champ métier incorrect veuillez réessayer";
            }
            if($user->getDescript() == "" || mb_strlen($user->getDescript()) < 2){
                $errors["descriptMétier"] = "Champ description métier incorrect veuillez réessayer";
            }
            return $errors;
        }
      
    }
?>