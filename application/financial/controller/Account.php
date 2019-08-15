<?php
namespace app\financial\controller;
use app\common\controller\AuthBase;
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
}
