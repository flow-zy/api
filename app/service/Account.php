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
    protected  $key='secret_key';
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
        if (empty($user)) {
            return error('用户不存在');
        }
        // 判断密码是否正确
        if ($data['password']===$this->passport_decrypt($user['password'],$this->key)){
            // 生成token
            $token = signToken($user['id']);
            // 更新token
            $user['token'] = $token;
            return success('登录成功', $user, 200);
        }
        return error('账号或者密码错误');
    }

    public function addUser($data): \think\response\Json
    {
        // 判断用户名是否已存在
        $user = $this->model->getUser($data['username']);
        if (empty($user)) {
            // 加密密码
            $data['password'] = $this->passport_encrypt($data['password'], $this->key);
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
        $page=(int)($query['pageNum']-1) * $query['pageSize'];
        $limit = (int)($query['pageSize'] * $query['pageNum']);
        return $model->getUserList($page, $limit);
    }

    // 修改
    public function edit($data)
    {
        $user = $this->model->getUser($data['username']);
        if (empty($user)) {
            $this->model->updateUser($data);
            return success('修改成功');
        }
        return error('用户不存在');
    }
    // 修改密码
    public function editPwd($data){
        $user = $this->model->getUser($data['username']);
        if (empty($user)) {
             $this->model->updatePwd($data);
            return success('修改成功');
        }
        return error('用户不存在');
    }
    /*
*功能：对字符串进行加密处理
*参数一：需要加密的内容
*参数二：密钥
*/


   public function passport_encrypt($str,$key): string
    { //加密函数
        srand((double)microtime() * 1000000);
        $encrypt_key=md5(rand(0, 32000));
        $ctr=0;
        $tmp='';
        for($i=0;$i<strlen($str);$i++){
            $ctr=$ctr==strlen($encrypt_key)?0:$ctr;
            $tmp.=$encrypt_key[$ctr].($str[$i] ^ $encrypt_key[$ctr++]);
        }
        return base64_encode($this->passport_key($tmp,$key));
    }

    /*
    *功能：对字符串进行解密处理
    *参数一：需要解密的密文
    *参数二：密钥
    */
    public function passport_decrypt($str,$key): string
    { //解密函数
        $str= $this->passport_key(base64_decode($str), $key);
        $tmp='';
        for($i=0;$i<strlen($str);$i++){
            $md5=$str[$i];
            $tmp.=$str[++$i] ^ $md5;
        }
        return $tmp;
    }

    /*
    *辅助函数
    */
    public  function passport_key($str,$encrypt_key): string
    {
        $encrypt_key=md5($encrypt_key);
        $ctr=0;
        $tmp='';
        for($i=0;$i<strlen($str);$i++){
            $ctr=$ctr==strlen($encrypt_key)?0:$ctr;
            $tmp.=$str[$i] ^ $encrypt_key[$ctr++];
        }
        return $tmp;
    }
}