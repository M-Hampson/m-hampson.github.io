<?php

namespace Edu\Ccp\Cis244;
use PDO;


class Review {
    private $id;
    private $username;
    private $title;
    private $content;
    
    private const CONNECTION = 'sqlite:finalproject.db';

    static function getConnection() {
        return new PDO(Review::CONNECTION);
    }
    // connect to html and insert into db next
    static function createReview($username, $title, $content, $rating){
        $connection = Review::getConnection();
        $query = $connection->prepare('
            INSERT INTO review (username, title, content, rating)
            VALUES (:username, :title, :content, :rating)
        ');
        $query->execute([
            ':username' => $username,
            ':title' => $title,
            ':content' => $content,
            ':rating' => $rating
        ]);
    }

    static function returnReview(){
        $connection = Review::getConnection();
        $query = $connection->prepare('SELECT username, title, content, rating
                                       FROM review ORDER BY id DESC'
                
        );
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }
    static function oldestReview(){
        $connection = Review::getConnection();
        $query = $connection->prepare('SELECT username, title, content, rating
                                       FROM review ORDER BY id ASC'
                
        );
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }


    // what would be the best way to handle and sort the $result we have from returnReview?
    static function highestReview(){
        $connection = Review::getConnection();
        $query = $connection->prepare('SELECT username, title, content, rating
                                       FROM review ORDER BY rating DESC'
                
        );
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }
    static function lowestReview(){
        $connection = Review::getConnection();
        $query = $connection->prepare('SELECT username, title, content, rating
                                       FROM review ORDER BY rating ASC'
                
        );
        $query->execute();
        $result = $query->fetchAll();
        return $result;
    }



    function __construct($id, $username, $title, $content, $rating){
        $this->id = $id;
        $this->username = $username;
        $this->title = $title;
        $this->content = $content;
        $this->rating = $rating;
    }

    // get functions
    function getId(){
        return $this->id;
    }
    function getUsername(){
        return $this->username;
    }
    function getTitle(){
        return $this->title;
    }
    function getContent(){
        return $this->content;
    }
    function getRating(){
        return $this->rating;
    }

}
?>
