<?php

class ModelsFacade extends DBConnection
{

    function create($data)
    {
        $sql = $this->connect()->prepare("INSERT INTO users_tbl (data) VALUES (?)");
        $sql->execute([$data]);
        return $sql;
    }

    function read()
    {
        $sql = $this->connect()->prepare("SELECT * FROM users_tbl");
        $sql->execute();
        return $sql;
    }

    function update($data, $dataId)
    {
        $sql = $this->connect()->prepare("UPDATE users_tbl SET data = '$data' WHERE id = '$dataId'");
        $sql->execute();
        return $sql;
    }

    function delete($dataId)
    {
        $sql = $this->connect()->prepare("DELETE FROM users_tbl WHERE id = ?");
        $sql->execute([$dataId]);
        return $sql;
    }
}
