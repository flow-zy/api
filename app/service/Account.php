<?php

namespace app\service;

use app\model\Account as UserModel;
use think\Service;

class Account extends Service
{
    /**
     * @var UserModel
     */
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function login($data)
    {
        //查询用户
        $user = $this->userModel->getUser($data['username']);
        var_dump($user);
        echo  $user;
    }
}