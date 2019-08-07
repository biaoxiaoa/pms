<?php
namespace Services;
class JsonServices{
    private static $SUCCESSFUL_DEFAULT_MSG = 'ok';

    private static $FAIL_DEFAULT_MSG = 'no';

    /**
     * 成功请求
     * 
     */
    static public function PMSSuccessResponse($code=2000,$msg='请求成功')
    {
       return self::returnData($code,$msg);
    }

    static public function PMSFailResponse($code=2004,$msg='请求失败')
    {
        
        
        return self::returnData($code,$msg);
    }

    /**
     * 响应请求
     * @code 响应码
     * @msg  提示信息
     */
    static public function response($code,$msg='')
    {
        return self::returnData($code,$msg);
    }

    /**
     * 数据组装
     * @code  响应码
     * @msg   响应提示信息
     * @data  数据
     */
    static public function returnData($code,$msg='',$data=[])
    {
        if (empty($data)) {
            
            return json(compact('code','msg'));
        } else {
            return json(compact('code','msg','data'));
        } 
        
    }
}