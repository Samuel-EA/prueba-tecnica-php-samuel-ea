<?php

namespace App;

class UserRepository
{
    private $_db;

    public function __construct()
    {
        $this->_db = new Database();
    }

    /**
     * Creates a new user in database and returns its id when done
     * @param User $model
     * @return string
     */
    public function add(User $model): string{

        $_open_connection = $this->_db->getConnection();

        
        $query = "INSERT INTO user(id,name,lastname,email,password) VALUES (:id,:name,:lastname,:email,:password);";

        // prepare query
        $stmt = $_open_connection->prepare($query);

        // sanitize
        $model->setId(htmlspecialchars(strip_tags($model->getId())));
        $model->setName(htmlspecialchars(strip_tags($model->getName())));
        $model->setLastname(htmlspecialchars(strip_tags($model->getLastname())));
        $model->setEmail(htmlspecialchars(strip_tags($model->getEmail())));
        $model->setPassword(htmlspecialchars(strip_tags($model->getPassword())));

         // execute query
        $stmt->execute([
            "id" => $model ->getId(),
            "name" => $model->getName(),
            "lastname" => $model->getLastname(),
            "email" => $model->getEmail(),
            "password" => $model->getPassword()
        ]);


        return $_open_connection->lastInsertId();

    }


    /**
     * Function that finds users by id, just returns one result in boject format
     * @param int $id
     * @return User|null
     */
    public function find(int $id): ?User
    {
        $_open_connection = $this->_db->getConnection();

        $result = null;
        $query = "SELECT * FROM user WHERE id = :userId ";

        // prepare query
        $stmt = $_open_connection->prepare($query);

        // sanitize
        $_userId = htmlspecialchars(strip_tags($id));

        // bind values
        $stmt->bindParam(":userId", $_userId);

        // execute query
        $stmt->execute();

        $data = $stmt->fetchObject('\\App\\User');

        if ($data) {
            $result = $data;
        }

        return $result;
    }


    public function update(User $model): ?User{

        //UPDATE RECORD
        $_open_connection = $this->_db->getConnection();

        
        $query = "UPDATE user SET name = :name, lastname = :lastname,email = :email,password = :password WHERE id = :id ;";

        // prepare query
        $stmt = $_open_connection->prepare($query);

        // sanitize
        $model->setId(htmlspecialchars(strip_tags($model->getId())));
        $model->setName(htmlspecialchars(strip_tags($model->getName())));
        $model->setLastname(htmlspecialchars(strip_tags($model->getLastname())));
        $model->setEmail(htmlspecialchars(strip_tags($model->getEmail())));
        $model->setPassword(htmlspecialchars(strip_tags($model->getPassword())));

        // bind values
        $stmt->bindParam(":userId", $id);

         // execute query
        $stmt->execute([
            "id" => $model->getId(),
            "name" => $model->getName(),
            "lastname" => $model->getLastname(),
            "email" => $model->getEmail(),
            "password" => $model->getPassword()
        ]);

        //SELECT RECORD UPDATED TO RETURN

        $_open_connection = $this->_db->getConnection();

        $result = null;
        $query = "SELECT * FROM user WHERE id = :userId ";

        // prepare query
        $stmt = $_open_connection->prepare($query);

        // sanitize
        $_userId = htmlspecialchars(strip_tags($model->getId()));

        // bind values
        $stmt->bindParam(":userId", $_userId);

        // execute query
        $stmt->execute();

        $data = $stmt->fetchObject('\\App\\User');

        if ($data) {
            $result = $data;
        }

        return $result;
    

    }


    /**
     * Function that deletes record by id, returns true if success
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $_open_connection = $this->_db->getConnection();

        $result = null;
        $query = "DELETE FROM user WHERE id = :userId ";

        // prepare query
        $stmt = $_open_connection->prepare($query);

        // sanitize
        $_userId = htmlspecialchars(strip_tags($id));

        // bind values
        $stmt->bindParam(":userId", $_userId);

        // execute query
        $result = $stmt->execute();

        return $result;
    }
}