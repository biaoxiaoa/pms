<?php
namespace Behavior;
use Services\JsonServices as xaJson;
use app\financial\model\Account as account_model;
use Services\QrcodeServer;
class AccountBehavior{
    static private $public_key = "-----BEGIN PUBLIC KEY-----\r\nMIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCwiuQmko5nKf0SCzKmSVLZcDXfwKMhVmfw9mqvIS1iDDyq0ep4pZIF2VhU5W8yVbD1zrA9sL1GTtNKNi/vpWklUeMFAtoXmsU1ILQVNeSRrZUvRIQ0LWuJyPpvfKsQ7IOSA8QyB3b7qbhJVKi5ov6e9hqRwp2nsopcJO4BCiKjhQIDAQAB\r\n-----END PUBLIC KEY-----";

    static public function submit_add($info)
    {
        if(empty($info)){
            return xaJson::PMSFailResponse(2004,'账户信息为空');
        }
        $account = account_model::accountWithName($info['name']);
        if(!empty($account)){
            return xaJson::PMSFailResponse(2004,'账户名已经存在');
        }
        $pu_key = openssl_pkey_get_public(self::$public_key);

        if(!empty($info['number'])){
            $encrypted_number = "" ;
            openssl_public_encrypt($info['number'],$encrypted_number,$pu_key);
            $encrypted_number = base64_encode($encrypted_number);
            $info['number']= $encrypted_number; 
            // $res = self::QRCode($encrypted_number);
            // if($res['success']=true){
            //     $data = $res['data'];
            //     $url = $data['url'];
            //     $number_img = str_replace('.','',$url);
            //     $number_img = str_replace('png','.png',$number_img);
            //     $info['number_img'] = $number_img;
            // }
        }
        if(!empty($info['remainlines'])){
            $encrypted_money = "";
            openssl_public_encrypt($info['remainlines'],$encrypted_money,$pu_key);
            $encrypted_money = base64_encode($encrypted_money);
            $info['remainlines']= $encrypted_money;
            // $res = self::QRCode($encrypted_money);
            // if($res['success']=true){
            //     $data = $res['data'];
            //     $url = $data['url'];
            //     $remainlines_img = str_replace('.','',$url);
            //     $remainlines_img = str_replace('png','.png',$remainlines_img);
            //     $info['remainlines_img'] = $remainlines_img;
            // }
        }
        if(!empty($info['secret'])){
            $encrypted_secret = "";
            openssl_public_encrypt($info['secret'],$encrypted_secret,$pu_key);
            $encrypted_secret = base64_encode($encrypted_secret);
            $info['secret']= $encrypted_secret;
            // $res = self::QRCode($encrypted_secret);
            // if($res['success']=true){
            //     $data = $res['data'];
            //     $url = $data['url'];
            //     $secret_img = str_replace('.','',$url);
            //     $secret_img = str_replace('png','.png',$secret_img);

            //     $info['secret_img'] = $secret_img;
            // }
        }
        $res =account_model::add($info);
        if($res==false|empty($res)){
            return xaJson::PMSFailResponse(2004,'账户新增失败');
        }else{
            return xaJson::PMSSuccessResponse(2000,'账户新增成功');
        }
    }
    static public function account_limit_list($page=1,$limit=10)
    {
        $model = account_model::account_model();
        $data = account_model::list();
        $back['code'] = 0;
        $back['msg']='请求成功';
        $back['count']=count($data);
        $back['data'] = $model->limit(($limit)*($page-1),$limit)->select();
        return json($back);  
    }
    static public function account_imgsrc($id,$type)
    {
        $model = account_model::accountWithID($id);
        $url = "";
        switch ($type) {
            case 'number':
            $url = $model->number_img;
            if(empty($url)){
                $res = AccountBehavior::qrCode($model->number);
                if($res['success']=true){
                   $data = $res['data'];
                   $url = $data['url'];
                   $number_img = str_replace('.','',$url);
                   $number_img = str_replace('png','.png',$number_img);
                   $model->number_img = $number_img;
                   $model->save();
                   $url = $number_img;
                }
            }
                break;
            case 'money':
            $url = $model->remainlines_img;
            if(empty($url)){
                $res = AccountBehavior::qrCode($model->remainlines);
                if($res['success']=true){
                   $data = $res['data'];
                   $url = $data['url'];
                   $remainlines_img = str_replace('.','',$url);
                   $remainlines_img = str_replace('png','.png',$remainlines_img);
                   $model->remainlines_img = $remainlines_img;
                   $model->save();
                   $url = $remainlines_img;
                }
            }
            break;
            case 'secret':
            $url = $model->secret_img;
            if(empty($url)){
                $res = AccountBehavior::qrCode($model->secret);
                if($res['success']=true){
                   $data = $res['data'];
                   $url = $data['url'];
                   $secret_img = str_replace('.','',$url);
                   $secret_img = str_replace('png','.png',$secret_img);
                   $model->secret_img = $secret_img;
                   $model->save();
                   $url = $secret_img;
                }
            }
            default:
                # code...
                break;
        }
        return $url;
    }
    static public function QRCode($content)
    {
        $config = [
            'title'         => true,
            'title_content' => '请扫描二维码，查看内容',
            'logo'          => false,
        ];

        // // 直接输出一张二维码图片
        // $qr_url = 'http://www.baidu.com?id=' . rand(1000, 9999);

        // $qr_code = new QrcodeServer($config);
        // $qr_img = $qr_code->createServer($qr_url);
        // echo $qr_img;

        // 二维码图片写入文件
        $file_name = './static/qrcode';  // 定义保存目录

        $config['file_name'] = $file_name;
        $config['generate']  = 'writefile';

        $qr_code = new QrcodeServer($config);
        $rs = $qr_code->createServer($content);
       return $rs;
    }
}