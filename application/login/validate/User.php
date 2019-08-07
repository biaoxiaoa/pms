<?php
namespace app\login\validate;
use think\Validate;
class User extends Validate{
    protected $scene = [
        // 'login'  =>  ['__token__','account','password','checkcode'],
        'login'  =>  ['account','password'],
    ];
    protected $rule = [
        '__token__' => 'require|token',
        'account'   => 'require|length:3,12|alphaDash',
        'password'  => 'require|length:5,12',
        'checkcode' => 'require|number|length:5|captcha', 
        'nick_name' => 'length:0,10',
        
    ];
    protected $message  =   [
        '__token__.require'=>'token错误，刷新页面后重新提交',
        '__token__.token'=>'请勿重复提交',
        'account.require'=>'请输入用户名',
        'account.length'=>'用户名必须3到12位',
        'account.alphaDash'=>'用户名不能输入特殊字符',
        'password.require'=>'请输入密码',
        'password.length'=>'密码必须5到12位',
        'checkcode.number'=>'验证码只能为数字',
        'checkcode.require'=>'请输入验证码',
        'checkcode.length'=>'验证码必须5位',
        'checkcode.captcha'=>'验证码错误',
        'nick_name.length'=>'昵称不能超过10个字符',
    ];
}