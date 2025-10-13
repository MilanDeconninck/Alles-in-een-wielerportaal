<?php

declare(strict_types=1);

namespace Data;

use \PDO;

class ContractDAO
{
    public function getAll(): array
    {
        $sql = "select * from contracten";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);
        $lijst = array();
        foreach ($resultSet as $rij) {
            array_push($lijst, $rij);
        }
        $dbh = null;
        return $lijst;
    }

    public function getContractenByRennerId(int $rennerId)
    {
        $sql = "select * from contracten where rennerId = :rennerId order by startdatum";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':rennerId' => $rennerId));
        $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $lijst = array();
        foreach ($resultSet as $rij) {
            array_push($lijst, $rij);
        }
        $dbh = null;
        return $lijst;
    }

    public function getContractByRennerAndYear(int $rennerId, string $startdatum)
    {
        $sql = "select * from contracten where rennerId = :rennerId and startdatum = :startdatum";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':rennerId' => $rennerId, ':startdatum' => $startdatum));
        $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $contracten = array();
        foreach ($resultSet as $rij) {
            array_push($contracten, $rij);
        }
        $dbh = null;
        return $contracten;
    }

    public function getContractByPloegAndYear(int $ploegId, string $startdatum)
    {
        $sql = "select * from contracten where ploegId = :ploegId and startdatum = :startdatum";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':ploegId' => $ploegId, ':startdatum' => $startdatum));
        $contract = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($contract == null) {
            $reedsContract = false;
        } else {
            $reedsContract = true;
        }
        $dbh = null;
        return $reedsContract;
    }

    public function create(int $rennerId, int $ploegId, string $startdatum, string $einddatum)
    {
        $sql = "insert into contracten (rennerId, ploegId, startdatum, einddatum) values (:rennerId, :ploegId, :startdatum, :einddatum)";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':rennerId' => $rennerId, ':ploegId' => $ploegId, ':startdatum' => $startdatum, ':einddatum' => $einddatum));
        $dbh = null;
    }

    public function update(int $rennerId, int $ploegId, string $startdatum)
    {
        $sql = "update contracten set ploegId = :ploegId where rennerId = :rennerId and startdatum = :startdatum";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':rennerId' => $rennerId, ':ploegId' => $ploegId, ':startdatum' => $startdatum));
        $dhb = null;
    }

    public function delete(int $rennerId, string $startdatum)
    {
        $sql = "delete from contracten where rennerId = :rennerId and startdatum = :startdatum";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':rennerId' => $rennerId, ':startdatum' => date("Y-m-d", strtotime($startdatum))));
        $dbh = null;
    }
}