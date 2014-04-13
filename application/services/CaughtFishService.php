<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Elin
 * Date: 2014-03-04
 * Time: 19:32
 * To change this template use File | Settings | File Templates.
 */

namespace GoFish\Service;


use GoFish\Collection\CaughtFishCollection;
use GoFish\Mapper\CaughtFishMapper;
use GoFish\Model\CaughtFish;

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
        $caughtFishesData = $caughtFishMapper->index(array());

        $caughtFishes = array_map($this->createCaughtFishModel, $caughtFishesData);

        return new CaughtFishCollection($caughtFishes);
    }

    private function createCaughtFishModel($caughtFishesData) // TODO make the collection do this.
    {
        $caughtFishes = array();

        foreach ($caughtFishesData as $caughtFishData) {
            $caughtFishes[] = new CaughtFish($caughtFishData);
        }

        return $caughtFishes;
    }

    public function create(array $data)
    {
        $caughtFishModel = new CaughtFish($data);
        $caughtFishDBParams = $caughtFishModel->getDBParams();
        $this->getCaughtFishMapper($caughtFishDBParams);
        return $caughtFishModel;

    }
}