<?php

declare(strict_types=1);

namespace Data;

use \PDO;

class WedstrijdDAO
{
    public function getAll()
    {
        $sql = "select * from wedstrijden";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);
        $lijst = array();
        foreach ($resultSet as $rij) {
            array_push($lijst, $rij);
        }
        $dbh = null;
        return $lijst;
    }

    public function getWedstrijdById(int $id)
    {
        $sql = "select * from wedstrijden where id = :id order by startdatum";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':id' => $id));
        $wedstrijd = $stmt->fetch(PDO::FETCH_ASSOC);
        $dbh = null;
        return $wedstrijd;
    }

    public function create(string $naam, int $plaatsId, float $afstand, int $typeId, string $startdatum, string $einddatum)
    {
        $sql = "insert into wedstrijden (naam, plaatsId, afstand, typeId, startdatum, einddatum) values (:naam, :plaatsId, :afstand, :typeId, :startdatum, :einddatum)";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':naam' => $naam, ':plaatsId' => $plaatsId, ':afstand' => $afstand, ':typeId' => $typeId, ':startdatum' => $startdatum, ':einddatum' => $einddatum));
        $dbh = null;
    }

    public function update(int $id, string $naam, int $plaatsId, float $afstand, int $typeId, string $startdatum, string $einddatum)
    {
        $sql = "update wedstrijden set naam = :naam, plaatsId = :plaatsId, afstand = :afstand, typeId = :typeId, startdatum = :startdatum, einddatum = :einddatum where id = :id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':id' => $id, ':naam' => $naam, ':plaatsId' => $plaatsId, ':afstand' => $afstand, ':typeId' => $typeId, ':startdatum' => $startdatum, ':einddatum' => $einddatum));
        $dbh = null;
    }

    public function delete(int $id)
    {
        $sql = "delete from wedstrijden where id = :id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':id' => $id));
        $dbh = null;
    }
}