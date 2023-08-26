<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;

Route::group('api',function(){
        //  用户
    Route::group('account',function(){
        //  登录
        Route::get('login', 'account/login');
        // 用户列表
        Route::get('list', 'account/list');
        // 添加用户
        Route::post('add', 'account/add');
        // 修改用户
        Route::post('edit', 'account/edit');
        // 修改密码
        Route::post('edit/pwd', 'account/editPwd');
    });
})->allowCrossDomain();