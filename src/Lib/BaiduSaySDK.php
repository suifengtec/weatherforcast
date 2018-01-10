<?php
namespace WeatherForcast\Lib;

/**
 * @Author: suifengtec
 * @Date:   2018-01-11 07:07:09
 * @Last Modified by:   suifengtec
 * @Last Modified time: 2018-01-11 07:35:59
 **/
/*
new \WeatherForcast\Lib\BB_SDK;
 */
class BaiduSaySDK {

    public function __construct(){

    }

    /*
    baiduSay_SDK::generateMp3ByStr($str,$saveToFile='')
     */
    public static function generateMp3ByStr($str,$opts,$apiConfig,$saveToFile):bool{
            /*
            APP_ID, APP_KEY, SECRET_KEY
             */
            if(!$apiConfig){
                return false;
            }

        $c = new \WeatherForcast\Lib\AipSpeech($apiConfig['APP_ID'],$apiConfig['APP_KEY'],$apiConfig['SECRET_KEY']);


/*
 synthesis($text, $lang='zh', $ctp=1, $options=array())
$text: 合成的文本，使用UTF-8编码，请注意文本长度必须小于1024字节;
$ctp: 客户端类型选择，web端填写1;
$options =[
'lang'=>'语言选择,填写zh',
'spd'=>'语速，取值0-9，默认为5中语速',
'pit'=>'音调，取值0-9，默认为5中语调',
'vol'=>'音量，取值0-15，默认为5中音量',
'per'=>'发音人选择, 0为女声，1为男声，3为情感合成-度逍遥，4为情感合成-度丫丫，默认为普通女',


'cuid'=>'用户唯一标识，用来区分用户，填写机器 MAC 地址或 IMEI 码，长度为60以内',


]

 */
            $data = $c->synthesis($str,'zh', 1,$opts);

            if(!is_array($data)){
                file_put_contents( $saveToFile, $data);
                return true;
            }else{

                var_dump($data);
                return false;
            }

    }

}

