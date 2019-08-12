<?php
namespace app\main\controller;
// use think\Controller;
use app\common\controller\AuthBase;
class Index extends AuthBase
{
    public function index()
    {
        return $this->fetch();    
    }
}
