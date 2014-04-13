<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Elin
 * Date: 2014-04-08
 * Time: 21:12
 * To change this template use File | Settings | File Templates.
 */

namespace GoFish\Application\Helpers;


class Configuration {

    public function setUpConfiguration(){
        $this->setIncludePath();
    }

    private function setIncludePath(){
        set_include_path('C:/Users/Elin/repos/');
    }
}