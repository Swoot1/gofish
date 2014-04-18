<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Elin
 * Date: 2014-03-04
 * Time: 19:46
 * To change this template use File | Settings | File Templates.
 */

namespace GoFish\Application\ENFramework\Models;


class DatabaseConnection implements IDatabaseConnection
{
    /**
     * @var \PDO
     */
    private $databaseConnection;

    public function __construct()
    {
        $databaseConnection = new \PDO('sqlite:C:/users/Elin/repos/gofish/test.sq3');
        $databaseConnection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->setDatabaseConnection($databaseConnection);
    }

    private function getDatabaseConnection()
    {
        return $this->databaseConnection;
    }

    private function setDatabaseConnection($databaseConnection)
    {
        $this->databaseConnection = $databaseConnection;
    }

    public function runQuery($query, $params = array())
    {
        $queryResult = array();
        $DBConnection = $this->getDatabaseConnection();

        $stmt = $DBConnection->prepare($query);
        $stmt->execute($params);

        while ($result = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $queryResult[] = $result;
        }

        return $queryResult;
    }
}