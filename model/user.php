<?php
    class user 
    {
      private $id; 
      private $name;
      private $firstName;
      private $email;
      private $password;
      private $birthDate;
      private $dateTime;

      function __construct(string $id=null,string $name,string $firstName,string $email, string $password,string $birthDate){
        $this->id = $id;
        $this->name = $name;
        $this->firstName = $firstName;
        $this->email = $email;
        $this->password = $password;
        $this->birthDate = $birthDate;
        $date = new DateTime();
        $interval2h = new DateInterval("PT1H");
        $date->add($interval2h);
        $this->dateTime = $date->format("d-m-Y H:i:s");
      }
      function getId(){
        return $this->id;
      }
      function setId($id){
        $this->id = $id;
      }
      function getName(){
        return $this->name;
      }
      function setName($name){
        $this->name = $name;
      }
      function getFirstName(){
        return $this->firstName;
      }
      function setFirstName($firstName){
        $this->firstName = $firstName;
      }
      function getEmail(){
        return $this->email;
      }
      function setEmail($email){
        $this->email = $email;
      }
      function getPassword(){
        return $this->password;
      }
      function setPassword($password){
        $this->password = $password;
      }
      function getBirthdate(){
        return $this->birthDate;
      }
      function setBirthdate($birthDate){
        $this->birthDate = $birthDate;
      }
    }
    
?>