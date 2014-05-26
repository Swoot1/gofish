<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Elin
 * Date: 2014-03-04
 * Time: 19:31
 * To change this template use File | Settings | File Templates.
 */

namespace GoFish\Application\Mappers;

use GoFish\Application\ENFramework\Models\IDatabaseConnection;

class CaughtFishMapper
{
    /**
     * @var \GoFish\Application\ENFramework\Models\IDatabaseConnection
     */
    private $databaseConnection;

    private $getIndexSQL = 'SELECT
        caught_fish.id AS id,
        fish_id AS fishId,
        user_id AS userId,
        weight,
        measurement
        FROM caught_fish';

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

    public function __construct(IDatabaseConnection $databaseConnection)
    {
        $this->databaseConnection = $databaseConnection;
    }

    private function getIndexSQL()
    {
        return $this->getIndexSQL;
    }

    public function index()
    {
        $caughtFishData = $this->databaseConnection->runQuery($this->getIndexSQL());
        return $caughtFishData;
    }

    public function create($params)
    {
        unset($params['id']);
        unset($params['fishName']); // TODO
        $result = $this->databaseConnection->runQuery($this->create, $params);
        return $result;
    }
}