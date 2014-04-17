<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Elin
 * Date: 2014-04-06
 * Time: 20:28
 * To change this template use File | Settings | File Templates.
 */

namespace GoFish\Application\ENFramework\Collections;

class GeneralCollection
{

    protected $data = array();
    protected $model = 'GoFish\Application\ENFramework\Models\GeneralModel';

    public function __construct(array $data)
    {
        $model = $this->getModel();

        foreach ($data as $modelData) {
            if ($modelData instanceof $model) {
                $this->data[] = $modelData;
            }else{
                $this->data[] = new $model($modelData);
            }
        }

        return $this;
    }

    public function getModel()
    {
        return $this->model;
    }

    public function toArray()
    {
        $result = array();

        foreach ($this->data as $model) {
            $result[] = $model->toArray();
        }

        return $result;
    }
}