<?php

namespace app\middleware;

use think\Middleware;

class Auth extends  Middleware
{
    // 校验token的中间件
    public function handle($request, \Closure $next){
        // 验证token
        $token = $request->header('authorization');
        if($token){
            checkToken($token);
        }
        return $next($request);
    }
}