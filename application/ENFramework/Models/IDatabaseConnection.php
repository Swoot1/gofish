<?php
/**
 * Created by PhpStorm.
 * User: Elin
 * Date: 2014-04-18
 * Time: 08:28
 */
namespace GoFish\Application\ENFramework\Models;

interface IDatabaseConnection
{
    public function runQuery($query, $params = array());
}