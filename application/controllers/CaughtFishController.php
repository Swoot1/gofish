<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Elin
 * Date: 2014-03-04
 * Time: 19:27
 * To change this template use File | Settings | File Templates.
 */

namespace GoFish\Application\Controllers;

use GoFish\Application\Services\CaughtFishService;

class CaughtFishController
{
    /**
     * @var \GoFish\Application\Services\CaughtFishService
     */
    private $caughtFishService;

    public function __construct(CaughtFishService $caughtFishService)
    {
        $this->caughtFishService = $caughtFishService;
    }

    public function index()
    {
        $caughtFishService = $this->caughtFishService;
        return $caughtFishService->index();
    }

    public function create(array $data)
    {
        $caughtFishService = $this->caughtFishService;
        return $caughtFishService->create($data);
    }
}