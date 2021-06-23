<?php

namespace App\Base;

class Model
{
    public static function connectSqliteDB()
    {
        return new \PDO("sqlite:db/database.db");
    }
    public static function get($table, $data = "*", $param = '')
    {
        $db = Model::connectSqliteDB();
        $sql = "SELECT $data FROM $table";
        $result = $db->query($sql);
        return $result;
        $db = null;
    }
    public static function set($table, $data = [])
    {
        $db = Model::connectSqliteDB();
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
        $stmt = $db->prepare($sqlData);
        $stmt->execute();
    }
    public static function edit($table, $id)
    {
        $db = Model::connectSqliteDB();
        $sql = "SELECT `check` FROM $table WHERE id='$id'";
        $result = $db->query($sql);
        $curst = !$result->fetchAll(\PDO::FETCH_ASSOC)[0]['check'];
        $sql = "UPDATE $table SET `check`='$curst' WHERE id='$id'";
        $db->prepare($sql)->execute();
        $db = null;
    }
}
