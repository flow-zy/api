<?php

namespace app\service;

use app\model\Account as UserModel;
use think\Service;
class Account extends Service
{
    /**
     * @var UserModel
     */
    protected $model;

    public  function __construct()
    {
        $model = new UserModel();
        $this->model = $model;
    }

    public function login($data): \think\response\Json
    {
        //查询用户
        $user = $this->model->getUser($data['username']);
        // 没查到用户
        if (isset($user)) {
            return error('用户不存在');
        }
        // 判断密码是否正确
        if (password_verify($data['password'], $user['password'])) {
            $res = array_map(function ($v) {
                //删除密码
                unset($v['password']);
                // 添加token
                $v['token'] = signToken($v['id']);
                return $v;
            }, $user);
            return success('登录成功', $res, 200);
        }
        return error('账号或者密码错误');
    }

    public function addUser($data): \think\response\Json
    {
        // 判断用户名是否已存在
        $user = $this->model->getUser($data['username']);
        if (isset($user)) {
            // 加密密码
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
            // 添加用户
            $this->model->addUser($data);
            return success('添加成功');
        }
        return error('用户已存在', null, 201);
    }

    //查询全部用户
    public function  list($query)
    {
        $model = new UserModel();
        return $model->getUserList($query['pageNum'], $query['pageSize']);
    }

    // 修改
    public function edit($data)
    {
        $user = $this->model->getUser($data['username']);
        if (isset($user)) {
            $this->model->updateUser($data);
            return success('修改成功');
        }
        return error('用户不存在');
    }
    // 修改密码
    public function editPwd($data){
        $user = $this->model->getUser($data['username']);
        if (isset($user)) {
             $model->updatePwd($data);
            return success('修改成功');
        }
        return error('用户不存在');
    }
}