<?php

namespace app\model;
use think\Facade\Db;
use think\Model;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;

class Account extends Model
{
    protected $table = 'account';
    protected  $pk= 'id';
    protected  $autoWriteTimestamp = true;
    protected  $createTime = 'create_time';
    protected  $updateTime = 'update_time';
    protected  $schema=[
        'id' => 'int',
        'username' => 'string',
        'password' => 'string',
        'status' => 'number',
        'create_time' => 'datetime',
        'update_time' => 'datetime',
        'email' => 'string',
        'phone' => 'string'
    ];
    // 获取用户信息
    public function getUser($username)
    {
        // TODO: Implement getUser() method
        try {
           return Db::table($this->table)->alias('account')
                ->join('role r ',' account.role_id = r.id','LEFT')
                ->field('account.*,r.name')->where('account.username',$username)
               ->find();
        } catch (DataNotFoundException|ModelNotFoundException|DbException $e) {
            return error($e->getMessage(),null,$e->getCode());
        }
    }
    // 增加用户
    public function addUser($data)
    {
        // TODO: Implement addUser() method
        try {
            return Db::table($this->table)->insert($data);
        } catch (DataNotFoundException|ModelNotFoundException|DbException $e) {
            return error($e->getMessage(),null,$e->getCode());
        }
    }
    // 修改用户
    public function updateUser($data,$id)
    {
        // TODO: Implement updateUser() method
        try {
            return Db::table($this->table)->where('id', $id)->update($data);
        }
        catch (DataNotFoundException|ModelNotFoundException|DbException $e) {
            return error($e->getMessage(),null,$e->getCode());
        }
    }
    // 获取用户列表
    public function getUserList($page,$limit)
    {
        // TODO: Implement getUserList() method
        try {
            return Db::table($this->table)
                ->alias('account')
                ->join('role r ',' account.role_id = r.id','left')
                ->field('account.*,count(*) as total,r.name')
                ->paginate($page,$limit);
        }
        catch (DataNotFoundException|ModelNotFoundException|DbException $e) {
            return error($e->getMessage(),null,$e->getCode());
        }
    }
    // 修改用户密码
    public function updatePwd($data,$id){
        try {
            return Db::table($this->table)->where('id', $id)->update($data);
        }
        catch (DataNotFoundException|ModelNotFoundException|DbException $e) {
            return error($e->getMessage(),null,$e->getCode());
        }
    }
}