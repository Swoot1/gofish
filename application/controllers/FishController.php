<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Elin
 * Date: 2014-04-06
 * Time: 19:50
 * To change this template use File | Settings | File Templates.
 */

namespace GoFish\Application\Controllers;

use GoFish\Application\Services\FishService;

// TODO set dependencies with a setDependencies function instead of having them in
// the constructor so that reflection is not needed and call user func can be used to set the dependencies and
// the class can be "string instantiated".
class FishController
{
    /**
     * @var \GoFish\Application\Services\FishService
     */
    private $fishService;

    public function __construct(FishService $fishService)
    {
        $this->fishService = $fishService;
    }

    public function index()
    {
        $fishService = $this->fishService;
        return $fishService->index();
    }

    public function create(array $data)
    {
        $fishService = $this->fishService;
        return $fishService->create($data);
    }

    public function read($id)
    {
        $fishService = $this->fishService;
        return $fishService->read($id);
    }

    public function update($id, $requestData)
    {
        $fishService = $this->fishService;
        return $fishService->update($id, $requestData);
    }

    public function delete($id)
    {
        return $this->fishService->delete($id);
    }
}