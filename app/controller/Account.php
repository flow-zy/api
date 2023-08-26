<?php
namespace app\controller;
use  app\BaseController;
use think\App;
use think\Request;
use app\validate\Account as AccountValidate;
use app\service\Account as UserService;
class  Account extends BaseController {
    /**
     * @var UserService
     * @var AccountValidate
     */
    private $service;
    private $validate;
    public  function  __construct(App $app)
    {
        parent::__construct($app);
        $this->service = new UserService();
        $this->request=new Request();
    }

    public function login(){
        $this->validate = new AccountValidate();
        $data = $this->request->param();
        $data= ['username'=>'admin','password'=>'123123'];
        try {
            $this->validate->scene('login')->check((array)$data);
            $this->service->login($data);
        } catch (\Exception $e) {
            return error($e->getMessage());
        }
    }
    // 用户列表
    public function list(){
        echo "userList";
    }
    // 添加用户
    public function add(){
        echo "add";
    }
    // 修改用户
    public function edit(){
        echo "edit";
    }
    // 修改密码
    public function editPwd(){
        echo "editPwd";
    }
}
