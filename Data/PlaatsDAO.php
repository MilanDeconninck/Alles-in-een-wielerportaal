<?php

declare(strict_types=1);

namespace Data;

use \PDO;

class PlaatsDAO
{
    public function getAll(): array
    {
        $sql = "select * from plaatsen";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);
        $lijst = array();
        foreach ($resultSet as $rij) {
            array_push($lijst, $rij);
        }
        $dbh = null;
        return $lijst;
    }

    public function getPlaatsById(int $id)
    {
        $sql = "select * from plaatsen where id = :id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        ;
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $plaats = $stmt->fetch(PDO::FETCH_ASSOC);
        $dbh = null;
        return $plaats;
    }

    public function create(string $stad, string $land)
    {
        $sql = "insert into plaatsen (stad, land) values (:stad, :land)";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':stad' => $stad, ':land' => $land));
        $dbh = null;
    }

    public function update(int $id, string $stad, string $land)
    {
        $sql = "update plaatsen set stad = :stad, land = :land where id = :id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':id' => $id, ':stad' => $stad, ':land' => $land));
        $dbh = null;
    }

    public function delete(int $id)
    {
        $sql = "delete * from plaatsen where id = :id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':id' => $id));
        $dbh = null;
    }
}