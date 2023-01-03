<?php
    class postManager{
     function insert($post){
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
        return $PostSend;
     }
     function select(){
        $pdo = new PDO("mysql:host=localhost;dbname=book","root");
        $select = 'select * from post inner join user on post.userId = user.id';
        $stmt = $pdo->prepare($select); 
        $result = $stmt->execute();
        $recupSelect = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $recupSelect;
     }   
    }
?>