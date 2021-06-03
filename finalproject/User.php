<?php

// User.php
namespace Edu\Ccp\Cis244;
use PDO;

class User {
    private $id;
    private $username;

    private const CONNECTION = 'sqlite:finalproject.db';

    static function getConnection() {
        return new PDO(User::CONNECTION);
    }

    static function getUserByLoginCredentials($username, $password) {
        $connection = User::getConnection();
        $query = $connection->prepare('
            SELECT id, username, password
            FROM user 
            WHERE username = :username 
            LIMIT 1');
        $query->execute([':username' => $username ]);

        $result = $query->fetch(PDO::FETCH_ASSOC);
      
        if ($result && password_verify($password, $result['password'])) {
      
            return new User($result['id'], $result['username']);
        } else {
            return NULL;
        }
    }
    // function to hand back full user object based on the id
    static function getUserById($id){
        $connection = User::getConnection();
        $query = $connection->prepare('
            SELECT id, username
            FROM user
            WHERE id = :id
            LIMIT 1
        ');
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return new User($result['id'], $result['username']);
        } else {
            return NULL;
        }
    }

    // create a new User
    // runs the query and saves the newly hashed password into the db
    static function createUser($username, $password){
        $connection = User::getConnection();
        $query = $connection->prepare('
            INSERT INTO user (username, password)
            VALUES (:username, :password)
        ');
        $query->execute([
            ':username' => $username,
            ':password' => password_hash($password, PASSWORD_DEFAULT),
        ]);
    }

    // is user name available to a new user? true if so false if no
    static function usernameIsAvailable($username){
        //connect to db
        $connection = User::getConnection();
        $query = $connection->prepare('
            SELECT id FROM user WHERE username = :username LIMIT 1        
        ');
        // assign this username
        $query->execute([':username' => $username]);
        // by using fetchAll we are seeing how many rows are returned, if any at all
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        // if the count of the number of rows is greater than zero,
        // than the user is taken
        return count($result) === 0;
        // boolean returns true if number of rows in $result is zero
    }

    function __construct($id, $username){
        $this->id = $id;
        $this->username = $username;
    }

    // get functions
    function getId(){
        return $this->id;
    }
    function getUsername(){
        return $this->username;
    }
    
}

?>
