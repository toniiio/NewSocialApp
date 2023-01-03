<?php
    class post
    {
        private $id;
        private $message;
        private $date;
        private $userID;
        private $img;

        function __construct(int $id=null,string $message,int $userID=null,string $img){
            $this->id = $id;
            $this->message = $message;
            $this->userID = $userID;
            $this->img = $img;
        }
        function getId(){
            return $this->id;
        }
        function setId(int $id){
            $this->id = $id;
        }
        function getMessage(){
            return $this->message;
        }
        function setMessage(string $message){
            $this->message = $message;
        }
        function getDate(){
            return $this->date;
        }
        function setDate(string $date){
            $this->date = $date;
        }
        function getUserId(){
           return $this->userID;
        }
        function setUserId(string $userID){
            $this->userID = $userID;
        }
        function getImg(){
          return $this->img;
        }
        function setImg(string $img){
            $this->img = $img;
        }
    }
?>