<?php
namespace WeatherForcast;

use WeatherForcast\bootStrap;
/**
 * @Author: suifengtec
 * @Date:   2018-01-11 07:29:35
 * @Last Modified by:   suifengtec
 * @Last Modified time: 2018-01-11 07:34:32
 **/
require_once __DIR__.DIRECTORY_SEPARATOR.'bootstrap.php';

$locationZh = !empty($_GET['city'])?urldecode($_GET['city']):'郑州';
$myName= !empty($_GET['myname'])?urldecode($_GET['myname']):'主人';

$locationEn = \WeatherForcast\bootStrap::getPinyin($locationZh);

$str = \WeatherForcast\bootStrap::getStr($myName,$locationZh,$locationEn);

?><!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="UTF-8">
  <title>语音天气预报</title>
</head>
<body>

<?php


var_dump( $str);
if(!\WeatherForcast\bootStrap::isWin()){
  $saveToFile = '/tmp/weather.mp3';
}else{
  $saveToFile = __DIR__.DIRECTORY_SEPARATOR.time().'.mp3';
}
$opts = [
'vol'=> 8,
'spd'=> 4,
];

$apiConfig = [
/* APP_ID, APP_KEY, SECRET_KEY*/
'APP_ID'=>'10671502',
'APP_KEY'=>'pGigFgX53OdHLDThsueVP2Qi',
'SECRET_KEY'=>'Gr0bqRSzY2G50GThGTxcxSCmXzeKKkWA',
];
$r = \WeatherForcast\bootStrap::generateMp3ByStr($str,$opts,$apiConfig,$saveToFile);

if($r){
  if(!\WeatherForcast\bootStrap::isWin()){
    exec('sudo /usr/bin/play /tmp/weather.mp3');
  }else{
  exec('cmdmp3.exe '.$saveToFile);
  unlink($saveToFile);
 /* exec('cmdmp3.exe '.$saveToFile);*/

  }

}else{

var_dump( '百度AI语音接口出错了' );
}
/*



start SampleAudio_0.7mb.mp3
 */
var_dump( $saveToFile );
?>
</body>
</html>