<?php

declare(strict_types=1);

namespace Data;

use \PDO;

class FietsmerkDAO {
    public function getAll(): array {
        $sql = "select * from fietsmerken";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);
        $lijst = array();
        foreach($resultSet as $rij) {
            array_push($lijst, $rij);
        }
        $dbh = null;
        return $lijst;
    }

    public function getMerkById(int $id) {
        $sql = "select * from fietsmerken where id = :id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':id' => $id));
        $merk = $stmt->fetch(PDO::FETCH_ASSOC);
        $dbh = null;
        return $merk;
    }

    public function create(string $naam) {
        $sql = "insert into fietsmerken (naam) values (:naam)";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':naam', $naam);
        $stmt->execute();
        $dbh = null;
    }

    public function update (int $id, string $naam) {
        $sql = "update fietsmerken set naam = :naam where id = :id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':id' => $id, ':naam' => $naam));
        $dbh = null;
    }

    public function delete(int $id) {
        $sql = "delete from fietsmerken where id = :id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':id' => $id));
        $dbh = null;
    }
}