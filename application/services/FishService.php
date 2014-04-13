<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Elin
 * Date: 2014-04-06
 * Time: 19:51
 * To change this template use File | Settings | File Templates.
 */

namespace GoFish\Application\Services;

use GoFish\Application\Collections\FishCollection;
use GoFish\Application\Mappers\FishMapper;
use GoFish\Application\Models\Fish;

class FishService
{
    private $fishMapper;

    public function __construct(FishMapper $fishMapper)
    {
        $this->setFishMapper($fishMapper);
    }

    /**
     * @param FishMapper $fishMapper
     * @return $this
     */
    private function setFishMapper(FishMapper $fishMapper)
    {
        $this->fishMapper = $fishMapper;
        return $this;
    }

    /**
     * @return mixed
     */
    private function getFishMapper()
    {
        return $this->fishMapper;
    }

    public function index()
    {
        $fishMapper = $this->getFishMapper();
        $fishData = $fishMapper->index();

        return new FishCollection($fishData);
    }

    public function create(array $data)
    {
        $fishModel = new Fish($data);
        $fishMapper = $this->getFishMapper();
        $DBParameters = $fishModel->getDBParameters();
        $result = $fishMapper->create($DBParameters);
        return $fishModel;
    }

    public function read($id){
        $fishMapper = $this->getFishMapper();
        $fishData = $fishMapper->read($id);

        return $fishData ? new Fish($fishData) : null;
    }

    public function update($id, $requestData){
        $fishMapper = $this->getFishMapper();

        $savedFish = $this->read($id);

        if($savedFish == null){
            throw new \Exception('implement me');
        }

        $fish = new Fish($requestData);

        $fishMapper->update($fish->getDBParameters());
        return $requestData ? new Fish($requestData) : null;
    }

    public function delete($id){
        $fishMapper = $this->getFishMapper();
        $fishMapper->delete($id);
    }
}