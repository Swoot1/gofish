<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Elin
 * Date: 2014-04-06
 * Time: 19:51
 * To change this template use File | Settings | File Templates.
 */

namespace GoFish\Application\Mappers;


use GoFish\Application\ENFramework\Mappers\DBConnectionMapper;

class FishMapper extends DBConnectionMapper
{
    private $indexSQL = '
    SELECT
       id,
       name
    FROM
      fish';

    private $create = '
       INSERT INTO
        fish
          (
          name
          )
      VALUES
        (
          :name
        )
    ';

    private $readSQL = '
    SELECT
       id,
       name
    FROM
      fish
    WHERE
      id = :id';

    private $update = '
       UPDATE
           fish
        SET
          name = :name
        WHERE
          id = :id
    ';

    private $delete = '
        DELETE
          FROM
            fish
        WHERE
          id = :id

    ';

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
        $fishes = $this->runQuery($this->getIndexSQL(), array());
        return $fishes;
    }

    public function create(array $DBParameters)
    {
        unset($DBParameters['id']);
        $query = $this->getCreateSQL();
        return $this->runQuery($query, $DBParameters);
    }

    public function update(array $DBParameters)
    {
        $query = $this->getUpdateSQL();
        return $this->runQuery($query, $DBParameters);
    }

    public function read($id)
    {
        $result = $this->runQuery($this->getReadSQL(), array('id' => $id));

        return array_shift($result);
    }

    public function delete($id)
    {
        $query = $this->getDeleteSQL();
        return $this->runQuery($query, array('id' => $id));
    }
}