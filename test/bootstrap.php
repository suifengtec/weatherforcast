<?php
namespace WeatherForcast;
/**
 * @Author: suifengtec
 * @Date:   2018-01-11 07:10:46
 * @Last Modified by:   suifengtec
 * @Last Modified time: 2018-01-11 07:34:56
 **/
require dirname(__DIR__) . DIRECTORY_SEPARATOR.'src/Autoloader.php';
\WeatherForcast_Autoloader::register();
\WeatherForcast_Autoloader::register(dirname(__DIR__) . DIRECTORY_SEPARATOR. 'test');
/*
new WeatherForcast\Lib\AASDK;
new WeatherForcast\Lib\XinZhiSDK;
*/

class bootStrap{

    public function __construct(){

    }

    public static function generateMp3ByStr( $str,$opts,$apiConfig,$saveToFile,$tokenStorageMethod='file'){
        /*
        $str,$opts=array(),$apiConfig=array(),$saveToFile=''
         */
       return  \WeatherForcast\Lib\BaiduSaySDK::generateMp3ByStr($str,$opts,$apiConfig,$saveToFile);

    }

    public static function getStr($myName='主人',$locationZh='郑州',$locationEn='zhengzhou'){


        $str = self::getTime($myName,$locationZh);
        $w = self::getTianqi($locationEn);

    if(is_array($w )){
        foreach ($w  as $k => $v) {
            switch($k){
                case 'text':
                 $symbol = '天气'.$v.', ';
                break;
                case 'temperature':
                 $symbol = '气温'.$v.'摄氏度';
                break;
                case 'code':
                 $symbol = '';
                break;


            }
            $str .= $symbol;
        }
    }

        return $str;

    }

    public static function getTianqi($locationEn='zhengzhou'){

         $tq = (array)\WeatherForcast\Lib\SeniverseSDK::getResponse($locationEn,true);
         return $tq;
    }

    public static function getPinyin($cityNameZh){
        $pyApi = new \WeatherForcast\Lib\PinYin;
        $py = $pyApi->getPinYin($cityNameZh);
   /*     $py = \WeatherForcast\Lib\getPinYin($cityNameZh);
*/
        $py = strtolower( $py);

        return $py;
    }

    public static function getTime($name='老公',$locationZh='郑州'){


        return date($name.'好,现在是Y年m月d日,H点i分,').$locationZh;

    }
//bootStrap::isWin()
    public static function isWin(){

        return strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';

    }
}
