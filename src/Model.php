<?php

namespace App;

use App\Models\DbConfig;
use Psr\Log\LoggerInterface;

class Model
{
    public $db;
    public $logger;

    public function __construct(DbConfig $dbConfig, LoggerInterface $logger)
    {
        // $this->db = new PDO($dbConfig['dsn']);
        $this->db = new \PDO($dbConfig->dsn);
        $this->logger = $logger;
    }

    public function get($table, $data = "*")
    {
        $sql = "SELECT $data FROM $table";
        $result = $this->db->query($sql);
        $this->logger->info('Get data');
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
        $stmt = $this->db->prepare($sqlData);
        $stmt->execute();
        $this->logger->info('Query: ' . $sqlData . '. Add new record.');
    }

    public function update($table, $id)
    {
        $sql = "SELECT `check` FROM $table WHERE id='$id'";
        $result = $this->db->query($sql);
        $curst = !$result->fetchAll(\PDO::FETCH_ASSOC)[0]['check'];
        $sql = "UPDATE $table SET `check`='$curst' WHERE id='$id'";
        $this->db->prepare($sql)->execute();
        $this->logger->info('Query: ' . $sql . '. Change record with id:' . $id);
    }
}
