<?php
namespace Services;
class TimeServices
{
    /**
     * 返回当前时间
     * @type 0-时间戳 1-yyyy-MM-dd hh:mm:ss 默认是：0
     */
    static public  function getNowTime($type=0)
    {
        switch ($type) {
            case 0:
                return time();
                break;
            
            default:
                return time();
                break;
        }
    }
}
