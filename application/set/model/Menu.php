<?php
namespace app\set\model;
use app\common\model\Base;
class Menu extends Base{

    public static function init()
    {
        self::event('after_write', function ($menu) {
           if((!empty($menu->module))&(!empty($menu->controller))&(!empty($menu->action))){
                $menu->pageURL = '/'+$menu->module+'/'+$menu->controller+'/'+$menu->action;
                $menu->save();
                return true;
           }
        });
    }

    /**
     * 获取菜单列表
     */
    static public function list()
    {
        $model = new Menu();
        return $model->select();
    }

    static public function menu_model()
    {
        $model = new Menu();
        return $model;
    }


    static public function desk_list()
    {
        $model = Menu::where('desk_show','1');
        return $model->select();
    }

    static public function menu_delete($ids)
    {
        return Menu::destroy($ids);
    }

    public function getStatusAttr($value)
    {
        $status = ['0'=>'启用','-1'=>'禁用'];
        return $status[$value];
    }
    public function getDeskShowAttr($value)
    {
        $status = ['0'=>'隐藏','1'=>'显示'];
        return $status[$value];
    }
    public function getMaxOpenAttr($value)
    {
        $status = ['-1'=>'禁止最大化','1'=>'手动最大化','2'=>'自动最大化'];
        return $status[$value];
    }
    public function getOpenTypeAttr($value)
    {
        $status = ['1'=>'HTML方式','2'=>'Frame方式'];
        return $status[$value];
    }

}