<?php
namespace app\set\controller;
use Behavior\MenuBehavior;
use app\common\controller\AuthBase;
class Menu extends AuthBase
{
    public function index()
    {
        return $this->fetch('Menu');    
    }
    public function list()
    {
        return MenuBehavior::menu_list();
    }
    public function test()
    {
        return MenuBehavior::desk_icon();
    }
}
