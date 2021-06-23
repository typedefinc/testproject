<?php

namespace App\Models;

class MainModel
{
    public $start;
    public $end;

    public function getData()
    {
        $db = new \PDO("sqlite:db/database.db");

        $sql = "SELECT * FROM vacation";
        $result = $db->query($sql);
        return $result->fetchAll(\PDO::FETCH_CLASS);
        $db = null;
    }
    public function save()
    {
        $db = new \PDO("sqlite:db/database.db");
        $sql = 'INSERT INTO vacation(`author`,`start`,`end`) VALUES(:author,:start,:end)';
        $stmt = $db->prepare($sql);
        $stmt->execute([
            'author' => $_SERVER['PHP_AUTH_USER'],
            'start' => $this->start,
            'end' => $this->end,
        ]);
        $db = null;
    }
    public static function editCheck($id)
    {
        if ($id) {
            $db = new \PDO("sqlite:db/database.db");

            $sql = "SELECT `check` FROM `vacation` WHERE id='$id'";
            $result = $db->query($sql);
            $curst = !$result->fetchAll(\PDO::FETCH_ASSOC)[0]['check'];
            $sql = "UPDATE `vacation` SET `check`='$curst' WHERE id='$id'";
            $db->prepare($sql)->execute();
            $db = null;
        }
    }
}
