<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Elin
 * Date: 2014-03-04
 * Time: 19:32
 * To change this template use File | Settings | File Templates.
 */

namespace GoFish\Application\Services;


use GoFish\Application\Collections\CaughtFishCollection;
use GoFish\Application\Mappers\CaughtFishMapper;
use GoFish\Application\Models\CaughtFish;

class CaughtFishService
{
    private $caughtFishMapper;

    public function __construct(CaughtFishMapper $caughtFishMapper)
    {
        $this->setCaughtFishMapper($caughtFishMapper);
    }

    /**
     * @param CaughtFishMapper $caughtFishMapper
     * @return $this
     */
    private function setCaughtFishMapper(CaughtFishMapper $caughtFishMapper)
    {
        $this->caughtFishMapper = $caughtFishMapper;
        return $this;
    }

    /**
     * @return CaughtFishMapper
     */
    private function getCaughtFishMapper()
    {
        return $this->caughtFishMapper;
    }

    public function index()
    {
        $caughtFishMapper = $this->getCaughtFishMapper();
        $caughtFishData = $caughtFishMapper->index();

        return new CaughtFishCollection($caughtFishData);
    }

    public function create(array $data)
    {
        $caughtFishModel = new CaughtFish($data);
        $caughtFishDBParams = $caughtFishModel->getDBParameters();
        $caughtFishMapper = $this->getCaughtFishMapper();
        $caughtFishMapper->create($caughtFishDBParams);
        return $caughtFishModel;

    }
}