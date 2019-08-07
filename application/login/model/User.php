<?php
namespace app\login\model;
use app\common\model\Base;
class User extends Base{
    static public function add_user($info)
    {
        if(empty($info)){
            self::setErrorMsg('用户信息为空，无法添加！');
            return false;
        }
        $model = User::create($info,true);
        if(empty($model)){
            self::setErrorMsg('用户添加失败');
            return false;
        }
        return true;
    }
    
    /**
     * 根据账号查询用户信息
     */
    static public function lookup_user($account)
    {
        if(empty($account)){
            self::setErrorMsg('用户账号为空，无法查询！');
            return false;
        }
        $user = User::getByAccount($account);
        
        if(empty($user)){
            self::setErrorMsg('该用户不存在');
            return false;
        }
        return $user;
    }
}