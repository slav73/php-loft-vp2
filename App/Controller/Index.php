<?php
namespace App\Controller;
use Base\Context;
use Base\Controller as BaseController;
use App\Model\User;

class Index extends BaseController
{
    public function indexAction()
    {
        $users = User::getList([2,3,4,5,6,7]);
        $this->view->users = $users;

        // echo Context::i()->getDb()->getLogHTML();
    }

    public function mainAction()
    {
        echo 'main';
    }

    function userProfileAction()
    {

    }
}