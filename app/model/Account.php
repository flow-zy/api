<?php

namespace app\model;
use think\Db;
use think\Model;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;

class Account extends Model
{
    // 获取用户信息
    public function getUser($username)
    {
        // TODO: Implement getUser() method
        try {
           return (new Db)->table('account')->where('username', $username)->find();
        } catch (DataNotFoundException|ModelNotFoundException|DbException $e) {
            return error($e->getMessage());
        }
    }
    // 增加用户
    public function addUser($data)
    {
        // TODO: Implement addUser() method
        try {
            return (new Db)->table('account')->insert($data);
        } catch (DataNotFoundException|ModelNotFoundException|DbException $e) {
            return error($e->getMessage(),null);
        }
    }
    // 修改用户
    public function updateUser($data)
    {
        // TODO: Implement updateUser() method
        try {
            return (new Db)->table('account')->where('id', $data['id'])->update($data);
        }
        catch (DataNotFoundException|ModelNotFoundException|DbException $e) {
            return error($e->getMessage(),null);
        }
    }
    // 删除用户
    public function deleteUser($id)
    {
        // TODO: Implement deleteUser() method
        try {
            return (new Db)->table('account')->where('id', $id)->delete();
        } catch (DataNotFoundException|ModelNotFoundException|DbException $e) {
            return error($e->getMessage(),null);
        }
    }
    // 获取用户列表
    public function getUserList($page,$limit)
    {
        // TODO: Implement getUserList() method
        try {
            return (new Db)->table('account')->page($page,$limit)->select();
        }
        catch (DataNotFoundException|ModelNotFoundException|DbException $e) {
            return error($e->getMessage(),null);
        }
    }
}