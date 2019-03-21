<?php

namespace App;

use App\Config;

/**
 * Class Db
 * @package App
 */
class Db
{
    protected $dbh;

    public function __construct()
    {
        $config = Config::getInstance();

        $this->dbh = new \PDO(
            'mysql:host=' . $config->getData()['db']['host'] . ';dbname=' . $config->getData()['db']['dbname'],
            $config->getData()['db']['user'],
            $config->getData()['db']['password']
        );

        //Данная строчка внесена, чтобы справиться с ошибкой PDO при подстановке параметров в запросы с LIMIT
        $this->dbh->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
    }

    /**
     * Выполняет запрос к БД, возвращает полученные данные в виде массивы объектов
     * @param $sql sql-запрос к БД
     * @param array $params массив подстановок
     * @param string|null $class имя класса, массив объектов которого должен быть возвращен
     * @return array
     */
    public function query(string $sql, $params = [], $class = null)
    {
        $sth = $this->dbh->prepare($sql);
        $sth->execute($params);

        if (null === $class){
            $sth->setFetchMode(\PDO::FETCH_ASSOC);
        }
        else {
            $sth->setFetchMode(\PDO::FETCH_CLASS, $class);
        }
        return $sth->fetchAll();
    }

    /**
     * Выполняет запрос к БД, не связанный с получением данных
     * @param $sql sql-запрос к БД
     * @param array $params массив подстановок
     * @return bool
     */
    public function execute(string $sql, $params = [])
    {
        $sth = $this->dbh->prepare($sql);
        return $sth->execute($params);
    }

    /**
     * Возвращает последний вставленный id
     * @return string
     */
    public function lastInsertId()
    {
        return $this->dbh->lastInsertId();
    }
}
