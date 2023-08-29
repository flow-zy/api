<?php

namespace app\service;
use think\Service;
use app\model\Role as  RoleModel;
class Role extends   Service
{
    protected  $model;
    public function __construct(){
        $this->model=new RoleModel();
    }

    //获取角色列表
    public function getRoleList($query){
        $page=(int)($query['pageNum']-1) * $query['pageSize'];
        $limit = (int)($query['pageSize'] * $query['pageNum']);
        return $this->model->getRoleList($page, $limit);
    }
    // 添加角色
    public function addRole($data){
        // 查找重复的角色
        $repeat = $this->model->getRoleByName($data['name']);
        if(empty($repeat)){
            return $this->model->addRole($data);
        }
        return error('角色已存在');
    }
   // 修改角色权限
    public function editPermission($id,$data){
        return $this->model->editPermission($id,$data);
    }
    // 删除角色
    public function delRole($id)
    {
        return $this->model->delRole($id);
    }
}