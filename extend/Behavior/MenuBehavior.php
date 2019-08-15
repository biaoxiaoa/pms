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

    static public function menu_limit_list($page=1,$limit=10)
    {
        $model = menu_model::menu_model();
        $data = menu_model::list();
        $back['code'] = 0;
        $back['msg']='请求成功';
        $back['count']=count($data);
        $back['data'] = $model->limit(($limit)*($page-1),$limit)->select();
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

    static public function menu_delete($ids)
    {
        if(empty($ids)){
            return xaJson::PMSFailResponse(2004,'参数错误！');
        }
        $res = menu_model::menu_delete($ids);
        if($res==true){
            return xaJson::PMSFailResponse(2000,'菜单已删除');;
        }else{
            return xaJson::PMSFailResponse(2004,'菜单删除失败');
        }
    }


}