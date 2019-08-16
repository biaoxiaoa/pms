<?php
namespace Behavior;
use Services\JsonServices as xaJson;
use app\financial\model\Account as account_model;
use phpqrcode\QRcode;
class AccountBehavior{
    static private $public_key = "-----BEGIN PUBLIC KEY-----\r\nMIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQChLFJ50zwM8r3bIXE2n+7y+pHqotbnFLgu5MqDDjsE6JDIVy5jgFzaXZIgZgrwPk0glU3Lf1uiLlGl1FQ4kjmXuJmorKLJQW7Vb9mALiQJAv2lj7yPOIxqIln5LCsSs88/Wou5TkywX4/iq6Z86/SAAXtUusaIaeus3qXIv8xUvwIDAQAB\r\n-----END PUBLIC KEY-----";

    static public function submit_add($info)
    {
        if(empty($info)){
            return xaJson::PMSFailResponse(2004,'账户信息为空');
        }
        $account = account_model::accountWithName($info['name']);
        if(!empty($account)){
            return xaJson::PMSFailResponse(2004,'账户名已经存在');
        }
        if(!empty($info['number'])){
            $pu_key = openssl_pkey_get_public(self::$public_key);
            $encrypted_number = "" ;
            $encrypted_money = "";
            $encrypted_secret = "";
            openssl_public_encrypt($info['number'],$encrypted_number,$pu_key);
            openssl_public_encrypt($info['remainlines'],$encrypted_money,$pu_key);
            openssl_public_encrypt($info['secret'],$encrypted_secret,$pu_key);
            // $encrypted_number = base64_encode($encrypted_number);
            // $encrypted_money = base64_encode($encrypted_money);
            // $encrypted_secret = base64_encode($encrypted_secret);
            $info['number']= $encrypted_number;  
            $info['remainlines']= $encrypted_money;
            $info['secret']= $encrypted_secret;

        }
        $res =account_model::add($info);
        if($res==false|empty($res)){
            return xaJson::PMSFailResponse(2004,'账户新增失败');
        }else{
            return xaJson::PMSSuccessResponse(2000,'账户新增成功');
        }
    }
   static public function test($text)
    {
        return QRcode::png('http://www.helloweba.com');
    }
}