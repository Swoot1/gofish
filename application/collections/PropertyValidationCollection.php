<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Elin
 * Date: 2014-04-06
 * Time: 16:44
 * To change this template use File | Settings | File Templates.
 */

namespace GoFish\Application\Collections;


class PropertyValidationCollection {

    protected $data;
    public function __construct(array $data)
    {
        $this->data = $data;
    }
}