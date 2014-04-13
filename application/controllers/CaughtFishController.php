<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Elin
 * Date: 2014-03-04
 * Time: 19:27
 * To change this template use File | Settings | File Templates.
 */

namespace GoFish\Application\Controllers;

use GoFish\Mapper\CaughtFishMapper;
use GoFish\Service\CaughtFishService;

class CaughtFishController
{
    private $caughtFishService;

    public function __construct()
    {
        $caughtFishMapper = new CaughtFishMapper();
        $caughtFishService = new CaughtFishService($caughtFishMapper);
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
        $caughtFishService->create($data);
    }
}