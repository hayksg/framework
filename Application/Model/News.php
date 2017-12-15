<?php

namespace Application\Model;

use Application\Components\DB;

class News
{
    public static function getOneById($id)
    {
        $db = DB::getConnection();

        $sql = "SELECT * FROM article WHERE id = :id";
        $stmt = $db->prepare($sql);
        $stmt->bindParam('id', $id, \PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(\PDO::FETCH_OBJ);
        return $row ?: false;
    }

    public static function getAll()
    {
        $db = DB::getConnection();

        $sql = "SELECT * FROM article";
        $result = $db->query($sql);

        $row = $result->fetchAll(\PDO::FETCH_OBJ);
        return $row ?: false;
    }
}
