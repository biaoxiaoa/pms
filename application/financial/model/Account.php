<?php
namespace app\financial\model;
use app\common\model\Base;

class Account extends Base{
    static public function add($info)
    {
        if(empty($info)){
            return false;
        }
        $model = Account::create($info);
        return $model;
    }
    static public function accountWithName($name=null)
    {
        if(empty($name)){
            return false;
        }
        $model = Account::where('name',$name)->find();
        return $model;
    }
}