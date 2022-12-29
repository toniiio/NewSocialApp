<?php
    class userService{
        function handleRequest($user=null){
            $name = filter_input(INPUT_POST,'name');
            $firtName = filter_input(INPUT_POST,'firstname');
            $email = filter_input(INPUT_POST,'email');
            $password = filter_input(INPUT_POST,'password');
            $date = filter_input(INPUT_POST,'date');
            
            if($user != null)
            {
                $user->setName($name);
                $user->setFirstName($firtName);
                $user->setEmail($email);
                $user->setPassword($password);
                $user->setBirthdate($date);
                return $user;    
            }else
            {
                $user = new User(null,$name,$firtName,$email,$password,$date);
                return $user;
            }
        }
        function handleRequestPost(){
            $message = filter_input(INPUT_POST,'message');
            
        }
        function isValid($user){
            $errors=[];
            if($user->getName() == "" || mb_strlen($user->getName()) < 2 || mb_strlen($user->getName()) > 30 ){
                $errors["name"] = "Champ nom incorrect veuillez reessayer";
            }
            if($user->getFirstName() == "" || mb_strlen($user->getFirstName()) < 2 || mb_strlen($user->getFirstName()) > 30 ){
                $errors["firstname"] = "Champ prenom incorrect veuillez reessayer";
            }
            if($user->getEmail() == "" || filter_var($user->getEmail(),FILTER_VALIDATE_EMAIL) == false){
                $errors["email"] = "Champ email incorrect veuillez ressayer";
            }
            if($user->getPassword() == "" || !preg_match('#^[a-z0-9A-Z]{6,}$#',$user->getPassword())){
                $errors["password"] = "Champ password incorrect veuillez reesayer";
            }
            if($user->getBirthdate() == ""){
                $errors["Birthdate"] = "Champ anniversaire incorrect veuillez reesayer";
            }
            return $errors;
        }
      
    }
?>