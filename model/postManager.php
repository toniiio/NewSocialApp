<?php
    class postManager{
     function insert($post){
        $pdo = new PDO("mysql:host=localhost;dbname=book","root");
        $querry = 'Insert into post (message,date) values (:mess,:date)';
        $stmt = $pdo->prepare($querry);
        $date = new DateTime();
        $interval2h = new DateInterval("PT1H");
        $date->add($interval2h);
        $post->setDate($date->format("Y-m-d"));
        $result = $stmt->execute([
            ':mess' => $post->getMessage(),
            ':date' => $post->getDate(),
        ]);
        return $result;
     }   
    }
?>