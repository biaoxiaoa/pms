<?php
namespace app\financial\controller;
use app\common\controller\AuthBase;
use Behavior\AccountBehavior;
use Services\QrcodeServer;
class Account extends AuthBase
{
    
    public function index()
    {
        
        return $this->fetch('account');    
    }
    public function add_account()
    {
        return $this->fetch('add');
    }

    public function submit_add_account()
    {
        $account = input('post.');
        return AccountBehavior::submit_add($account);
    }

    public function test()
    {
        $config = [
            'title'         => true,
            'title_content' => 'test',
            'logo'          => false,
        ];

        // // 直接输出一张二维码图片
        // $qr_url = 'http://www.baidu.com?id=' . rand(1000, 9999);

        // $qr_code = new QrcodeServer($config);
        // $qr_img = $qr_code->createServer($qr_url);
        // echo $qr_img;

        // 二维码图片写入文件
        $qr_url = '这是个测试二维码';
        $file_name = './static/qrcode';  // 定义保存目录

        $config['file_name'] = $file_name;
        $config['generate']  = 'writefile';

        $qr_code = new QrcodeServer($config);
        $rs = $qr_code->createServer($qr_url);
        print_r($rs);
    }
}
