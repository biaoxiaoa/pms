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
        $page = input('get.page');
        $limit =input('get.limit'); 
        return MenuBehavior::menu_limit_list($page,$limit);
    }
     public function delete()
     {
         $ids = input('post.ids');
         return MenuBehavior::menu_delete($ids);
     }


    public function test()
    {
        return MenuBehavior::desk_icon();
    }
}
