<?php
namespace Behavior;
use app\login\model\User as UserModel;
use app\login\validate\User as UserValidate;
use Services\JsonServices as xaJson;
use Services\TimeServices as time;
class LoginBehavior{
    static public function login_check($info)
    {
        /**
         * 输入账号信息格式校验
         */
        $validate = new UserValidate();
        $checkRes = $validate->scene('login')->check($info);
        if(!$checkRes){
           return xaJson::PMSFailResponse(1004,$validate->getError());
        }

        /**
         * 判断用户是否存在
         */
        $lookupRes = UserModel::lookup_user($info['account']);
        if($lookupRes==false){
            return xaJson::PMSFailResponse(1004,UserModel::getErrorMsg());
        }

        /**
         * 密码校验
         */
        $password = md5($info['password'].$lookupRes->salt);
        if($password!=$lookupRes->password){
            return xaJson::PMSFailResponse(1004,'密码错误');
        }

        if($lookupRes->status==2){
            return xaJson::PMSFailResponse(1004,'账号锁定');
        }

        $lookupRes->login_time = time::getNowTime(0);
        $lookupRes->login_ip = $info['login_ip'];
        $lookupRes->save();

        return xaJson::PMSSuccessResponse('1000','登录成功');
    }
}