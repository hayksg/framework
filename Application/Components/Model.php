<?php

namespace Application\Components;

use Application\Components\DB;

class Model
{
    public static $tableName;
    public $data = [];
    public $dataForUpdate = [];

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function __get($name)
    {
        return $this->data[$name];
    }

    public static function getOneById($id)
    {
        $className = get_called_class();
        $primaryKeyName = self::getPrimaryKeyName();

        DB::setClassName($className);
        $db = DB::getConnection();

        $sql  = "SELECT * FROM ";
        $sql .=  static::$tableName;
        $sql .= " WHERE ";
        $sql .= $primaryKeyName . ' = :' . $primaryKeyName;

        $stmt = $db->prepare($sql);
        $stmt->bindParam('id', $id, \PDO::PARAM_INT);
        $stmt->execute();

        $stmt->setFetchMode(\PDO::FETCH_CLASS, $className);
        $row = $stmt->fetchAll()[0];

        return $row ?: false;
    }

    public static function getAll()
    {
        $db = DB::getConnection();

        $sql = "SELECT * FROM " . static::$tableName;

        $result = $db->query($sql);

        $row = $result->fetchAll(\PDO::FETCH_OBJ);
        return $row ?: false;
    }

    protected function add()
    {
        $params = [];
        foreach ($this->data as $key => $value) {
            $params[':' . $key] = $value;
        }

        $sql  = "INSERT INTO ";
        $sql .= static::$tableName;
        $sql .= "(" . implode(', ', array_keys($this->data)) . ")";
        $sql .= " VALUES ";
        $sql .= "(" . implode(', ', array_keys($params)) . ")";

        return DB::persist($sql, $params);
    }

    public function fieldsForUpdate($fields)
    {
        foreach ($this->data as $key => $value) {
            if (in_array($key, $fields)) {
                $this->dataForUpdate[$key] = $value;
            }
        }
    }

    private static function getPrimaryKeyName()
    {
        $sql = "SHOW KEYS FROM " . static::$tableName . " WHERE Key_name = 'PRIMARY'";
        $db = DB::getConnection();
        $result = $db->query($sql);
        $row = $result->fetch();
        if ($row) {
            return $row['Column_name'];
        }
    }

    protected function update()
    {
        $primaryKeyName = self::getPrimaryKeyName();

        $params = [];
        $newData = [];

        foreach ($this->data as $key => $value) {
            if ($key == $primaryKeyName) {
                $params[':' . $key] = $value;
            }

            if (! in_array($key, array_keys($this->dataForUpdate))) {
                continue;
            }

            $params[':' . $key] = $value;
            $newData[] = $key . ' = :' . $key;
        }

        $sql  = "UPDATE ";
        $sql .= static::$tableName;
        $sql .= " SET ";
        $sql .= implode(', ', $newData);
        $sql .= " WHERE ";
        $sql .= $primaryKeyName . ' = :' . $primaryKeyName;

        return DB::persist($sql, $params);
    }

    public function save()
    {
        if (isset($this->data['id'])) {
            return $this->update();
        } else {
            return $this->add();
        }
    }

    public function delete()
    {
        $primaryKeyName = self::getPrimaryKeyName();
        $id = (int)$this->data[$primaryKeyName];

        $sql  = "DELETE FROM ";
        $sql .= static::$tableName;
        $sql .= " WHERE ";
        $sql .= $primaryKeyName . ' = :' . $primaryKeyName;

        return DB::persist($sql, [$primaryKeyName => $id]);
    }
}
