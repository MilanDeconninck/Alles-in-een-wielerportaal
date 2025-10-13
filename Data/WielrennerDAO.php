<?php

declare(strict_types=1);

namespace Data;

use \PDO;

class WielrennerDAO
{
    public function getAll(): array
    {
        $sql = "select * from wielrenners";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->prepare($sql);
        $lijst = array();
        foreach ($resultSet as $rij) {
            array_push($lijst, $rij);
        }
        $dbh = null;
        return $lijst;
    }

    public function getWielrennerById(int $id)
    {
        $sql = "select * from wielrenners where id = :id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $wielrennerInfo = $stmt->fetch(PDO::FETCH_ASSOC);
        $dbh = null;
        return $wielrennerInfo;
    }

    public function getWielrennerIdByFullName(string $naam) {
        $sql = "select * from wielrenners where CONCAT(voornaam, ' ', familienaam) like :naam";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':naam', $naam);
        $stmt->execute();
        $renner = $stmt->fetch(PDO::FETCH_ASSOC);
        $dbh = null;
        return $renner;
    }

    public function getWielrennersPerJaar(int $ploegId, string $startdatum) {
        $sql = "select * from wielrenners where ploegId = :ploegId and startdatum = :startdatum";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':ploegId', $ploegId);
        $stmt->bindValue('startdatum', $startdatum);
        $stmt->execute();
        $renners = array();
        $resultSet = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($resultSet as $rij) {
            array_push($renners, $rij);
        }
        $dbh = null;
        return $renners;
    }

    public function create(string $voornaam, string $familienaam, string $geboortedatum, int $typeId, int $plaatsId)
    {
        $sql = "insert into wielrenners (voornaam, familienaam, geboortedatum, typeId, plaatsId) values (:voornaam, :familienaam, :geboortedatum, :typeId, :plaatsId";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->query($sql);
        $stmt->execute(array(':voornaam' => $voornaam, ':familienaam' => $familienaam, ':geboortedatum' => $geboortedatum, ':typeId' => $typeId, ':plaatsId' => $plaatsId));
        $dbh = null;
    }

    public function update(int $id, string $voornaam, string $familienaam, string $geboortedatum, int $typeId, int $plaatsId)
    {
        $sql = "update wielrenners set voornaam = :voornaam, familienaam = :familienaam, geboortedatum = :geboortedatum, typeId = :typeId, plaatsId = :plaatsId where id = :id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':id' => $id, ':voornaam' => $voornaam, ':familienaam' => $familienaam, ':geboortedatum' => $geboortedatum, ':typeId' => $typeId, ':plaatsId' => $plaatsId));
        $dbh = null;
    }

    public function delete(int $id)
    {
        $sql = "delete from wielrenners where id = :id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':id' => $id));
        $dbh = null;
    }
}