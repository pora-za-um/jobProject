<?php

namespace App;

//require __DIR__ . '/../config.php';

class DB
{

    protected $dbh;

    public function __construct()
    {
        try {
            $this->dbh = new \PDO('mysql:host=localhost;dbname=job', 'default', '');
        } catch (\PDOException $e) {
            throw new \Exception('Ошибка соединения с БД');
        }
    }

    public function execute(string $sql, array $data = [])
    {
        $sth = $this->dbh->prepare($sql);
        $result = $sth->execute($data);
        if (false === $result) {
            var_dump($sth);
            throw new \Exception('Ошибка запроса к БД');
        }
        return true;
    }



    public function query(string $sql, array $data = [], $class = null)
    {
        $sth = $this->dbh->prepare($sql);
        $result = $sth->execute($data);
        if (false === $result) {
            var_dump($sth);
            throw new \Exception('Ошибка запроса к БД');
        }
        if (null === $class) {
            return $sth->fetchAll();
        } else {
            return $sth->fetchAll(\PDO::FETCH_CLASS, $class);
        }
    }


}