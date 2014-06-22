<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Elin
 * Date: 2014-03-04
 * Time: 19:27
 * To change this template use File | Settings | File Templates.
 */

namespace GoFish\Application\Controllers;

use GoFish\Application\ENFramework\Models\DatabaseConnection;
use GoFish\Application\Mappers\CaughtFishMapper;
use GoFish\Application\Services\CaughtFishService;

class CaughtFishController
{
    /**
     * @var \GoFish\Application\Services\CaughtFishService
     */
    private $caughtFishService;

    public function __construct(CaughtFishService $caughtFishService)
    {
        $this->setCaughtFishService($caughtFishService);
    }

    private function setCaughtFishService($caughtFishService)
    {
        $this->caughtFishService = $caughtFishService;
    }

    private function getCaughtFishService()
    {
        return $this->caughtFishService;
    }

    public function index()
    {
        $caughtFishService = $this->getCaughtFishService();
        return $caughtFishService->index();
    }

    public function create(array $data)
    {
        $caughtFishService = $this->getCaughtFishService();
        return $caughtFishService->create($data);
    }
}