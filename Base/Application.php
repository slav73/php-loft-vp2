<?php
namespace Base;

use Base\Exception\Error404;

class Application
{
    /** @var Context */
    private $_context;

    protected function _init()
    {
        $this->_context = Context::i();

        $request = new Request();
        $dispatcher = new Dispatcher();
        $db = new DB();
        $this->_context->setRequest($request);
        $this->_context->setDispatcher($dispatcher);
        $this->_context->setDb($db);
    }
    
    public function run()
    {
        try {
            $this->_init();
            $this->_context->getDispatcher()->dispatch();
            $dispatcher = $this->_context->getDispatcher();
            var_dump( $_SERVER['REQUEST_URI']);

            $controllerFileName = 'App\Controller\\' . $dispatcher->getControllerName();
            if (!class_exists($controllerFileName)) {
                throw new Error404('class ' . $controllerFileName . ' not exists');
            }

            /** @var Controller $controllerObj */
            $controllerObj = new $controllerFileName();

            $actionFuncName = $dispatcher->getActionName();

            if (!method_exists($controllerObj, $actionFuncName)) {
                throw new Error404('method  ' . $actionFuncName . ' not found in ' . $controllerFileName);
            }

            $tpl = '../App/Templates/' . $dispatcher->getControllerName()
                . '/' . $dispatcher->getActionToken() . '.phtml';
            $view = new View();
            $controllerObj->view = $view;
            $controllerObj->preAction();
            $controllerObj->$actionFuncName();

            if ($controllerObj->needRender()) {
                $html = $view->render($tpl);
                echo $html;
            }

        } catch (Error404 $e) {
            header ('HTTP/1.0 404 Not Found');
            trigger_error($e->getMessage());
        }
    }
}