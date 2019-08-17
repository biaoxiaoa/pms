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

Route::get('think', function () {
    return 'hello,ThinkPHP5!';
});

Route::get('hello/:name', 'index/hello');

Route::get('admin', 'login/index/admin_login');
Route::get('captcha', 'login/index/captcha');
Route::get('account_add', 'financial/Account/add_account');//消费账户添加界面
Route::get('account', 'financial/Account/Index');//消费账户列表界面
Route::get('account_list', 'financial/Account/list');//账户列表
Route::get('qrCode', 'financial/Account/qrCode');//二维码界面
Route::get('menu_list', 'set/menu/list');//菜单列表
Route::rule('/login_check','login/index/login','POST');
Route::rule('/submit_add_account','financial/Account/submit_add_account','POST');//添加账户提交




return [

];
