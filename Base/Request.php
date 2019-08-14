<?php
namespace Base;

class Request
{
    private $_controllerName = '';
    private $_actionName = '';

    public function __construct()
    {
        $parts = explode('/', $_SERVER['REQUEST_URI']);
        $this->_controllerName = $parts[3] ?? '';
        $this->_actionName = $parts[4] ?? '';
    }

    /**
     * @return string
     */
    public function getControllerName(): string
    {
        return $this->_controllerName;
    }

    /**
     * @return string
     */
    public function getActionName(): string
    {
        return $this->_actionName;
    }
}