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
    static public function account_model()
    {
        $model = new Account();
        return $model;
    }
    static public function list()
    {
        $model = new Account();
        return $model->select();
    }
    static public function accountWithID($id)
    {
        if(empty($id)){
            return false;
        }
        $model = Account::where('ID',$id)->find();
        return $model; 
    }
}