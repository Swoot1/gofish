<?php
/**
 * Created by PhpStorm.
 * User: Elin
 * Date: 2014-04-17
 * Time: 20:42
 */

namespace GoFish\Application\Mappers;

use GoFish\Application\ENFramework\Models\IDatabaseConnection;

class UserMapper {

    /**
     * @var \GoFish\Application\ENFramework\Models\IDatabaseConnection
     */
    private $databaseConnection;
    private $indexSQL = '
    SELECT
       id,
       username,
       email
    FROM
      user';

    private $create = '
       INSERT INTO
        user
          (
          username,
          email,
          password
          )
      VALUES
        (
          :username,
          :email,
          :password
        )
    ';

    private $readSQL = '
    SELECT
       id,
       username,
       email
    FROM
      user
    WHERE
      id = :id';

    private $update = '
       UPDATE
           user
        SET
          username = :username,
          email = :email
        WHERE
          id = :id
    ';

    private $delete = '
        DELETE
          FROM
            user
        WHERE
          id = :id

    ';

    public function __construct(IDatabaseConnection $databaseConnection){
        $this->databaseConnection = $databaseConnection;
    }

    private function getIndexSQL()
    {
        return $this->indexSQL;
    }

    private function getReadSQL()
    {
        return $this->readSQL;
    }

    private function getCreateSQL()
    {
        return $this->create;
    }

    private function getUpdateSQL()
    {
        return $this->update;
    }

    private function getDeleteSQL()
    {
        return $this->delete;
    }

    public function index()
    {
        $fishes = $this->databaseConnection->runQuery($this->getIndexSQL(), array());
        return $fishes;
    }

    public function create(array $DBParameters)
    {
        unset($DBParameters['id']);
        $query = $this->getCreateSQL();
        return $this->databaseConnection->runQuery($query, $DBParameters);
    }

    public function update(array $DBParameters)
    {
        $query = $this->getUpdateSQL();
        return $this->databaseConnection->runQuery($query, $DBParameters);
    }

    public function read($id)
    {
        $result = $this->databaseConnection->runQuery($this->getReadSQL(), array('id' => $id));

        return array_shift($result);
    }

    public function delete($id)
    {
        $query = $this->getDeleteSQL();
        return $this->databaseConnection->runQuery($query, array('id' => $id));
    }
} 