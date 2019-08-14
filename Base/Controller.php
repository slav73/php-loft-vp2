<?php
namespace Base;

class Controller
{
    /** @var View */
    public $view;

    /** @var bool */
    protected $_render = true;

    /** @var array */
    protected $_jsonData = [];

    public function preAction()
    {

    }

    /**
     * @return bool
     */
    public function needRender(): bool
    {
        return $this->_render;
    }

    public function json()
    {
        header('Content-type: application/json');
        echo json_encode($this->_jsonData);
    }

}