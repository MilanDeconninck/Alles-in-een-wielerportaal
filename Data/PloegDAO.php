<?php

declare(strict_types=1);

namespace Data;

use \PDO;

class PloegDAO
{
    public function getAll(): array
    {
        $sql = "select * from ploegen";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);
        $lijst = array();
        foreach ($resultSet as $rij) {
            array_push($lijst, $rij);
        }
        $dbh = null;
        return $lijst;
    }

    public function getPloegById(int $id)
    {
        $sql = "select * from ploegen where id = :id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $ploeg = $stmt->fetch(PDO::FETCH_ASSOC);
        $dbh = null;
        return $ploeg;
    }

    public function create(string $naam, int $plaatsId, int $fietsmerkId)
    {
        $sql = "insert into ploegen (naam, plaatsId, fietsmerkId) values (naam, plaatsId, fietsmerkId)";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':naam' => $naam, ':plaatsId' => $plaatsId, ':fietsmerkId' => $fietsmerkId));
        $dbh = null;
    }

    public function update(int $id, string $naam, int $plaatsId, int $fietsmerkId)
    {
        $sql = "update ploegen set naam = :naam, plaatsId = :plaatsId, fietsmerkId = :fietsmerkId where id = :id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare(($sql));
        $stmt->execute(array(':id' => $id, ':naam' => $naam, ':plaatsId' => $plaatsId, ':fietsmerkId' => $fietsmerkId));
        $dbh = null;
    }

    public function delete(int $id)
    {
        $sql = "delete * from ploegen where id = :id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':id' => $id));
        $dbh = null;
    }
}