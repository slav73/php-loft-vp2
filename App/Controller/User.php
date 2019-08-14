<?php
namespace App\Controller;
use Base\Controller as BaseController;
use App\Model\User as userModel;

class User extends BaseController
{
    public function indexAction()
    {
        $this->_render = false;
        $this->_jsonData = ['name' => 'Dima', 'id' => 123, 'data' => ['age' => 123]];
        $this->json();
    }

    public function loginAction()
    {
        $this->_render = false;
        echo __METHOD__;
    }

    public function registerAction()
    {
        $this->_render = false;
        $data['name'] = $_GET['name'] ?? '';
        $data['email'] = $_GET['email'] ?? '';
        $data['password'] = $_GET['password'] ?? '';

        $model = new userModel();
        $model->loadData($data, true);

        if (!$model->check($error)) {
            echo $error;
            return;
        }

        if ($model->save()) {
            echo 'ok';
            return;
        }

        echo 'not ok';

    }
}