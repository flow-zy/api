<?php
namespace app\controller;
use  app\BaseController;
use think\App;
use think\Facade\Request;
use app\validate\Account as AccountValidate;
use app\service\Account as UserService;
class  Account extends BaseController {
    /**
     * @var UserService
     * @var AccountValidate
     */
    protected  $service;
    protected $validate;

    public  function  __construct(App $app)
    {
        parent::__construct($app);
        $this->service = new UserService();
        $this->validate = new AccountValidate();
    }

    public function login(){
        $data = explode('&',Request::query());
        $data = array_reduce($data,function ($result,$item){
            $item = explode('=',$item);
            $result[$item[0]] = $item[1];
            return $result;
        },[]);
        try {
            $this->validate->scene('login')->check($data);
           return  $this->service->login($data);
        } catch (\Exception $e) {
            return error($e->getMessage());
        }
    }
    // 用户列表
    public function list(){
        $query =explode('&',Request::query());
        $query = array_reduce($query,function ($result,$item){
            $item = explode('=',$item);
            $result[$item[0]] = $item[1];
            return $result;
        },[]);
        try {
            $this->validate->scene('list')->check($query);
            return  $this->service->list($query);
        } catch (\Exception $e) {
            return error($e->getMessage());
        }
    }
    // 修改用户
    public function edit(){
        $data = Request::post();
        $id=Request::param('id');
        $data['update_time'] = date_create()->format('Y-m-d H:i:s');
        try {
            $this->validate->scene('edit')->check($data);
            return  $this->service->edit($data,$id);
        } catch (\Exception $e) {
            return error($e->getMessage());
        }
    }
    // 添加用户
    public function add(){
        $data=Request::post();
        $data['create_time'] = date_create()->format('Y-m-d H:i:s');
        $data['update_time'] = date_create()->format('Y-m-d H:i:s');
        try {
            $this->validate->scene('add')->check($data);
            return  $this->service->addUser($data);
        }catch (\Exception $e){
            return error($e->getMessage());
        }
    }
    // 修改密码
    public function editPwd(){
        $id=Request::param('id');
        $data=Request::post();
        $data['update_time'] = date_create()->format('Y-m-d H:i:s');
        try {
            $this->validate->scene('editPwd')->check($data);
            return  $this->service->editPwd($data,$id);
        } catch (\Exception $e) {
            return error($e->getMessage());
        }
    }
}
