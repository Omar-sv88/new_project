<?php

class CONTROLLER {
    protected $class = null;
    protected $model = null;

    public function __construct()
    {
        if ($this->model !== null)
        {
            require_once MODEL_PATH.$this->model.'.php';
            $this->model = $this->model.'Model';
            $this->model = new $this->model;
        }
    }

    public function __destruct()
    {
        unset(
            $this->class,
            $this->model
        );
    }
}
