<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Elin
 * Date: 2014-03-04
 * Time: 19:31
 * To change this template use File | Settings | File Templates.
 */

namespace GoFish\Mapper;

use GoFish\Application\ENFramework\Mappers\DBConnectionMapper;

class CaughtFishMapper extends DBConnectionMapper
{
    private $getIndexSQL = 'SELECT
        caught_fish.id,
        fish_id,
        user_id,
        weight,
        measurement,
        fish.name
        FROM caught_fish
        INNER JOIN fish ON caught_fish.id = fish.id';

    private $create = '
       INSERT INTO
        caught_fish
          (
          fish_id,
          user_id,
          weight,
          measurement
          )
      VALUES
        (
          :fishId,
          :userId,
          :weight,
          :measurement
          )
    ';

    private function getIndexSQL()
    {
        return $this->getIndexSQL;
    }

    public function index($params)
    {
        $caughtFishes = $this->runQuery($this->getIndexSQL(), $params);
        return $caughtFishes;
    }

    public function create($params)
    {
        $result = $this->runQuery($this->create, $params);
        return $result;
    }
}