<?php

namespace App\Base;

class Model
{
    private $db;

    public function __construct()
    {
        $this->$db = new \PDO("sqlite:db/database.db");
    }

    public function get($table, $data = "*")
    {
        $sql = "SELECT $data FROM $table";
        $result = $this->$db->query($sql);
        return $result;
    }

    public function insert($table, $data = [])
    {
        if ($data) {
            $count = count($data);
            $sqlData = "INSERT INTO `$table` (";
            foreach ($data as $key => $value) {
                if ($count > 1) {
                    $sqlData .= "`$key`,";
                    $count--;
                } else {
                    $sqlData .= "`$key`";
                }
            }
            $count = count($data);
            $sqlData .= ") VALUES(";
            foreach ($data as $key => $value) {
                if ($count > 1) {
                    $sqlData .= "'$value',";
                    $count--;
                } else {
                    $sqlData .= "'$value'";
                }
            }
            $sqlData .= ")";
        }
        $stmt = $this->$db->prepare($sqlData);
        $stmt->execute();
    }

    public function update($table, $id)
    {
        $sql = "SELECT `check` FROM $table WHERE id='$id'";
        $result = $this->$db->query($sql);
        $curst = !$result->fetchAll(\PDO::FETCH_ASSOC)[0]['check'];
        $sql = "UPDATE $table SET `check`='$curst' WHERE id='$id'";
        $this->$db->prepare($sql)->execute();
    }

}
