<?php

namespace app\controller;
use app\BaseController;
use app\service\Role as RoleService;
use think\App;
use app\validate\Role as  RoleValidate;
use think\Facade\Request;

class Role extends BaseController
{
    protected  $service;
    protected    $validate;
    public function __construce(App $app){
        parent::__construct($app);
        $this->service = new RoleService();
        $this->validate = new RoleValidate();
    }
    // 角色列表
    public  function  list(){
        $query =explode('&',Request::query());
        $query = array_reduce($query,function ($result,$item){
            $item = explode('=',$item);
            $result[$item[0]] = $item[1];
            return $result;
        },[]);
        return $this->service->getRoleList($query);
    }
    // 添加角色
    public  function  add(){
        $data = Request::post();
        try{
            $this->validate->scene('add')->check($data);
            return $this->service->addRole($data);
        }
    catch (\Exception $e){
            return error($e->getMessage(),null,$e->getCode());
        }
    }
    // 修改角色
    public  function  edit(){
        $id = Request::param('id');
        $data = Request::post();
        try{
            $this->validate->scene('edit')->check($data);
            return $this->service->editRole($id,$data);
        }
        catch (\Exception $e){
            return error($e->getMessage(),null,$e->getCode());
        }
    }
    // 修改角色权限
    public  function  editPermission(){
        $id= Request::param('id');
        $data = Request::post();
        try{
            $this->validate->scene('editPre')->check($data);
            return $this->service->editPermission($id,$data);
        }
        catch (\Exception $e){
            return error($e->getMessage(),null,$e->getCode());
        }
    }
    // 删除角色
    public  function  del(){
        $id= Request::param('id');
        return $this->service->delRole($id);
    }
}