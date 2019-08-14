<?php
namespace Behavior;
use app\set\model\Menu as menu_model;
use Services\JsonServices as xaJson;
class MenuBehavior{
    static public function menu_list()
    {
        $data = menu_model::list();
        $back['code'] = 0;
        $back['msg']='请求成功';
        $back['count']=count($data);
        $back['data'] = $data;
        return json($back);
    }
    static public function desk_icon()
    {
        $data = menu_model::desk_list();
        $newData = array();
        foreach ($data as $menu) {
            array_push($newData,$menu->getData());
        }
        $back['code']=0;
        $back['message']='成功';
        $back['data']= $newData;
        return json($back);
    }
}