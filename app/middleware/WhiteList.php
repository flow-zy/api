<?php

namespace app\middleware;

use think\Middleware;

class WhiteList extends  Middleware
{
    // 路由白名单中间件
    public function handle($request, \Closure $next)
    {
        $whiteList = ['/account/login','/account/add','/role/list'];
        $url = $request->url();
        $bool= count(array_filter($whiteList,function($val) use ($url) {
            $url=str_replace('api/','',$url);
            return strpos($url,$val) !== false;
        }))>0;
        if (!$bool) {
             return json(['code'=>403,'msg'=>'没有权限访问该页面']);
        }
        return $next($request);
    }
}