<?php

declare(strict_types=1);

namespace Data;

use \PDO;

class DeelnemerDAO {
    public function getAll(): array {
        $sql = "select * from deelnemers";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);
        $lijst = array();
        foreach($resultSet as $rij) {
            array_push($lijst, $rij);
        }
        $dbh = null;
        return $lijst;
    }

    public function create(int $wedstrijdId, int $rennerId, int $ploegId) {
        $sql = "insert into deelnemers (wedstrijdId, rennerId, ploegId) values (:wedstrijdId, :rennerId, :ploegId)";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':wedstrijdId' => $wedstrijdId, ':rennerId' => $rennerId, ':ploegId' => $ploegId));
        $dbh = null;
    }

    public function update(int $id, int $wedstrijdId, int $rennerId, int $ploegId) {
        $sql = "update deelnemers set wedstrijdId = :wedstrijdId, rennerId = :rennerId, ploegId = :ploegId where id = :id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':id' => $id, ':wedstrijdId' => $wedstrijdId, ':rennerId' => $rennerId, ':ploegId' => $ploegId));
        $dbh = null;
    }

    public function delete(int $id) {
        $sql = "delete * from deelnemers where id = :id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':id' => $id));
        $dbh = null;
    }
}