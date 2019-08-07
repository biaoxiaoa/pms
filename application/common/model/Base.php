<?php
namespace app\common\model;
use think\model;
class Base extends model{
    private static $errormsg;
    /**
     * 默认错误提示信息
     */
    const DEFAULT_ERROR_MSG = '操作失败，请稍后再试！';
    /**
     * 设置错误信息
     */
    static public function setErrorMsg($msg=self::DEFAULT_ERROR_MSG){
        self::$errormsg = $msg;
    }
    /**
     * 获取错误信息
     */
    public static function getErrorMsg(){                         
      return !empty(self::$errormsg) ? self::$errormsg : self::DEFAULT_ERROR_MSG;
   }
}