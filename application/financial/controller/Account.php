<?php
namespace app\financial\controller;
use app\common\controller\AuthBase;
use Behavior\AccountBehavior;
use app\financial\model\Account as account_model;
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
    public function list()
    {
        $page = input('get.page');
        $limit =input('get.limit'); 
        return AccountBehavior::account_limit_list($page,$limit);
    }
    public function qrCode()
    {
       $id = input('get.id');
       $type = input('get.type');
       $model = account_model::accountWithID($id);
       
       if($model==false){
           return "无法获取账户信息";
       }
       $url = AccountBehavior::account_imgsrc($id,$type);
    //    switch ($type) {
    //        case 'number':
    //             $url = $model->number_img;
    //             if(empty($url)){
    //                 $res = AccountBehavior::qrCode($model->number);
    //                 if($res['success']=true){
    //                    $data = $res['data'];
    //                    $url = $data['url'];
    //                    $remainlines_img = str_replace('.','',$url);
    //                    $model->number_img = $remainlines_img;
    //                    $model->save();
    //                    $url = $remainlines_img;
    //                 }
    //             }
    //            break;
           
    //        default:
    //            # code...
    //            break;
    //    }
        $this->assign('img',$url);
        return $this->fetch('qrCode');
    }


    public function test()
    {
        
    }
}
