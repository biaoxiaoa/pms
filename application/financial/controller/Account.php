<?php
namespace app\financial\controller;
use app\common\controller\AuthBase;
use Behavior\AccountBehavior;

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

    
}
