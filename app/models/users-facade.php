<?php

class UsersFacade extends DBConnection
{

    function verifyEmail($email)
    {
        $sql = $this->connect()->prepare("SELECT * FROM users_tbl WHERE email = ?");
        $sql->execute([$email]);
        $count = $sql->rowCount();
        return $count;
    }

    function verifyEmailPassword($email, $password)
    {
        $sql = $this->connect()->prepare("SELECT * FROM users_tbl WHERE email = ? AND password = ?");
        $sql->execute([$email, $password]);
        $count = $sql->rowCount();
        return $count;
    }

    function addUser($name, $address, $email, $password)
    {
        $sql = $this->connect()->prepare("INSERT INTO users_tbl (name, address, email, password) VALUES (?, ?, ?, ?)");
        $sql->execute([$name, $address, $email, $password]);
        return $sql;
    }

    function login($email, $password)
    {
        $sql = $this->connect()->prepare("SELECT * FROM users_tbl WHERE email = ? AND password = ?");
        $sql->execute([$email, $password]);
        return $sql;
    }
    
    function fetchByUserId($userId)
    {
        $sql = $this->connect()->prepare("SELECT * FROM users_tbl WHERE id = ?");
        $sql->execute([$userId]);
        return $sql;
    }












    function create($data)
    {
        $sql = $this->connect()->prepare("INSERT INTO dalira_table (data) VALUES (?)");
        $sql->execute([$data]);
        return $sql;
    }

    function read()
    {
        $sql = $this->connect()->prepare("SELECT * FROM dalira_table");
        $sql->execute();
        return $sql;
    }

    function update($data, $dataId)
    {
        $sql = $this->connect()->prepare("UPDATE dalira_table SET data = '$data' WHERE id = '$dataId'");
        $sql->execute();
        return $sql;
    }

    function delete($dataId)
    {
        $sql = $this->connect()->prepare("DELETE FROM dalira_table WHERE id = ?");
        $sql->execute([$dataId]);
        return $sql;
    }
}
