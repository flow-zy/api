<?php

namespace app\model;
use think\db\exception\DataNotFoundException;
use think\db\exception\DbException;
use think\db\exception\ModelNotFoundException;
use think\Model;
use think\Facade\Db;
class Role extends Model
{
    protected  $table='role';
    protected $pk='id';
    protected $autoWriteTimestamp = true;
    protected $createTime = 'create_time';
    protected $updateTime = 'update_time';
    protected $dateFormat = 'Y-m-d H:i:s';
    protected  $schema=[
        'id'=>'int',
        'name'=>'string',
        'description'=>'string',
        'create_time'=>'datetime',
        'update_time'=>'datetime',
        'permissions'=>'array',
        'status'=>'int'
    ];
    public  function  getRoleList($page,$limit){
        try {
            return Db::table($this->table)->where('status',1)->page($page, $limit)->select();
        } catch (DataNotFoundException|ModelNotFoundException|DbException $e) {
            return error($e->getMessage(), null, $e->getCode());
        }
    }
    // 获取角色信息通过name
    public function getRoleByName($name){
        try {
            return Db::table($this->table)->where('name',$name)->find();
        }        catch (DataNotFoundException|ModelNotFoundException|DbException $e) {
            return error($e->getMessage(), null, $e->getCode());
        }
    }
    // 添加角色
    public function addRole($data){
        try {
            return Db::table($this->table)->insert($data);
        }
        catch (DataNotFoundException|ModelNotFoundException|DbException $e) {
            return error($e->getMessage(), null, $e->getCode());
        }
    }
    // 修改角色权限
    public function editPermission($data,$id){
        try {
            return Db::table($this->table)->where('id',$id)->update($data);
        }
        catch (DataNotFoundException|ModelNotFoundException|DbException $e) {
            return error($e->getMessage(), null, $e->getCode());
        }
    }
    // 删除角色
    public function delRole($id){
        try {
            return Db::table($this->table)->where('id',$id)->update(['status'=>0]);
        }
        catch (DataNotFoundException|ModelNotFoundException|DbException $e) {
            return error($e->getMessage(), null, $e->getCode());
        }
    }
}