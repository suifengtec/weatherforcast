<?php
namespace WeatherForcast\Lib;
/**
 * @Author: suifengtec
 * @Date:   2018-01-11 02:41:28
 * @Last Modified by:   suifengtec
 * @Last Modified time: 2018-01-11 07:34:05
 **/

/*

心知天气


https://api.seniverse.com/v3/weather/now.json?location=beijing&ts=1443079775&ttl=30&uid=[your_uid]&sig=[your_signature]&callback=showWeather

https://www.seniverse.com/doc#sign
 */
define('XZ_APP_ID','U197CD8C42');
define('XZ_APP_KEY','echtf06z51uyeha9');

class SeniverseSDK{

    private static $urlBase = 'https://api.seniverse.com/v3/weather/now.json';
    private static $socketTimeout = 10;
    private static $connectTimeout = 10;
    public function __construct(){

    }

    public static function getResponse($location='zhengzhou'){

        $url = self::getUrl($location);

/*
{"results":[{"location":{"id":"WW0V9QP93VS8","name":"郑州","country":"CN","path":"郑州,郑州,河南,中国","timezone":"Asia/Shanghai","timezone_offset":"+08:00"},"now":{"text":"晴","code":"1","temperature":"2"},"last_update":"2018-01-11T02:40:00+08:00"}]}
 */

        $r = self::requestGet(  $url,false);

        if(!empty($r->results)){

            return $r->results[0]->now;
        }

        return false;
    }

    public static function getUrl($location='zhengzhou'){


        $url = self:: $urlBase.'?'.self::getArgs($location,true);

        return $url;
    }

    /*
    Seniverse_SDK::getArgs()
     */
    public static function getArgs($location='zhengzhou',$returnStr=false){

        $args = [
            'key'=>XZ_APP_KEY,
            'location'=>$location,
            'language'=>'zh-Hans',
            'unit'=>'c',
/*            'ts'=>time(),
            'ttl'=>30,
            'uid'=>XZ_APP_ID,*/
        ];
        $args['sig'] = self::getSign($args);

        if($returnStr){

            return http_build_query($args);
        }
        return $args;


    }


    public static function getSign($query_data=array()){



/*

$key = "vNIXE0xscrmjlyV-12Nj_BvUPaw=";
$data = "/maps/api/geocode/json?address=New+York&sensor=false&client=clientID";

$my_sign = hash_hmac("sha1", $data, base64_decode(strtr($key, '-_', '+/')), true);
$my_sign = strtr(base64_encode($my_sign), '+/', '-_');

 */
        $str = http_build_query($query_data);
        $sign = hash_hmac( 'sha1', $str , XZ_APP_KEY, true );
        $sign = urlencode(base64_encode($sign));
        return $sign;

    }

    public static function requestGet($url,$returnArr =false){
        try {
            $r = json_decode( file_get_contents( $url),$returnArr);

        } catch (Exception $e) {
            $r = false;
        }
        return $r;

    }
}
