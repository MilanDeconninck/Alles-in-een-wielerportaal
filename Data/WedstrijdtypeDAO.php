<?php

declare(strict_types=1);

namespace Data;

use \PDO;

class WedstrijdtypeDAO
{
    public function getAll(): array
    {
        $sql = "select * from wedstrijdtypes";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);
        $lijst = array();
        foreach ($resultSet as $rij) {
            array_push($lijst, $rij);
        }
        $dbh = null;
        return $lijst;
    }

    public function getTypeById(int $id)
    {
        $sql = "select * from wedstrijdtypes where id = :id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $type = $stmt->fetch(PDO::FETCH_ASSOC);
        $dbh = null;
        return $type;
    }

    public function create(string $type)
    {
        $sql = "insert into wedstrijdtypes (type) values (:type)";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':type' => $type));
        $dbh = null;
    }

    public function update(int $id, string $type)
    {
        $sql = "update wedstrijdtypes set type = :type where id = :id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':id' => $id, ':type' => $type));
        $dbh = null;
    }

    public function delete(int $id)
    {
        $sql = "delete * from wedstrijdtypes where id = :id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':id' => $id));
        $dbh = null;
    }
}