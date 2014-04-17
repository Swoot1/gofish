<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Elin
 * Date: 2014-03-04
 * Time: 19:57
 * To change this template use File | Settings | File Templates.
 */

namespace GoFish\Application\Collections;

class CaughtFishCollection extends GeneralCollection
{
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }
}