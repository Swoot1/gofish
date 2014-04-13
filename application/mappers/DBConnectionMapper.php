<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Elin
 * Date: 2014-03-04
 * Time: 19:46
 * To change this template use File | Settings | File Templates.
 */

namespace GoFish\Application\Mappers;


class DBConnectionMapper
{
    private $DBConnection;

    public function __construct()
    {
        $DBConnection = new \PDO('sqlite:C:/users/Elin/repos/gofish/test.sq3');
        $DBConnection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->setDBConnection($DBConnection);
    }

    private function getDBConnection()
    {
        return $this->DBConnection;
    }

    private function setDBConnection($DBConnection)
    {
        $this->DBConnection = $DBConnection;
    }

    protected function runQuery($query, $params = array())
    {
        $queryResult = array();
        $DBConnection = $this->getDBConnection();

        $stmt = $DBConnection->prepare($query);
        $stmt->execute($params);

        while ($result = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $queryResult[] = $result;
        }

        return $queryResult;
    }
}