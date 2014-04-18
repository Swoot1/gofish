<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Elin
 * Date: 2014-04-06
 * Time: 19:50
 * To change this template use File | Settings | File Templates.
 */

namespace GoFish\Application\Controllers;

use GoFish\Application\ENFramework\Models\DatabaseConnection;
use GoFish\Application\Mappers\FishMapper;
use GoFish\Application\Services\FishService;

class FishController
{
    /**
     * @var GoFish\Application\Services\FishService
     */
    private $fishService;

    public function __construct()
    {
        $databaseConnection = new DatabaseConnection();
        $fishMapper = new FishMapper($databaseConnection);
        $fishService = new FishService($fishMapper);
        $this->setFishService($fishService);
    }

    private function setFishService($fishService)
    {
        $this->fishService = $fishService;
    }

    /**
     * @return GoFish\Application\Services\FishService
     */
    private function getFishService()
    {
        return $this->fishService;
    }

    public function index()
    {
        $fishService = $this->getFishService();
        return $fishService->index();
    }

    public function create(array $data)
    {
        $fishService = $this->getFishService();
        return $fishService->create($data);
    }

    public function read($id)
    {
        $fishService = $this->getFishService();
        return $fishService->read($id);
    }

    public function update($id, $requestData)
    {
        $fishService = $this->getFishService();
        return $fishService->update($id, $requestData);
    }

    public function delete($id)
    {
        $fishService = $this->getFishService();
        return $fishService->delete($id);
    }
}