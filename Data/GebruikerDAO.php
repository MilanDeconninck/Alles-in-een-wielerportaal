<?php

declare(strict_types=1);

namespace Data;

use \PDO;

class GebruikerDAO
{
    public function getAll(): array
    {
        $sql = "select * from gebruikers";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $resultSet = $dbh->query($sql);
        $lijst = array();
        foreach ($resultSet as $rij) {
            array_push($lijst, $rij);
        }
        $dbh = null;
        return $lijst;
    }

    public function getGebruikerByEmail(string $email)
    {
        $sql = "select * from gebruikers where emailadres = :email";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(":email", $email);
        $stmt->execute();
        $rij = $stmt->fetch(PDO::FETCH_ASSOC);
        $dbh = null;
        return $rij;
    }

    public function create(string $email, string $wachtwoord, string $rechten)
    {
        $sql = "insert into gebruikers (emailadres, wachtwoord, rechten) values (:email, :wachtwoord, :rechten)";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':email' => $email, ':wachtwoord' => $wachtwoord, ':rechten' => $rechten));
        $dbh = null;
    }

    public function update(int $id, string $email, string $wachtwoord, string $rechten)
    {
        $sql = "update gebruikers set emailadres = :email, wachtwoord = :wachtwoord, rechten = :rechten where id = :id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':id' => $id, ':email' => $email, ':wachtwoord' => $wachtwoord, ':rechten' => $rechten));
        $dbh = null;
    }

    public function delete(int $id)
    {
        $sql = "delete * from gebruikers where id = :id";
        $dbh = new PDO(DBConfig::$DB_CONNSTRING, DBConfig::$DB_USERNAME, DBConfig::$DB_PASSWORD);
        $stmt = $dbh->prepare($sql);
        $stmt->execute(array(':id' => $id));
        $dbh = null;
    }
}