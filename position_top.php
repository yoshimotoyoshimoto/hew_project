<?php

ini_set("display_errors", 1);
error_reporting(E_ALL);
//定数呼び出し
require_once './const.php';
//DB接続
$link = @mysqli_connect(HOST,USER_ID,PASSWORD,DB_NAME);
//文字設定
mysqli_set_charset($link,'utf8');
//session開始
session_start();

$line = [];
$line[] = 'hokurikubiwako';
$line[] = 'kyoto';
$line[] = 'kobesanyo';
$line[] = 'ako';
$line[] = 'kosei';
$line[] = 'kusatsu';
$line[] = 'nara';
$line[] = 'sagano';
$line[] = 'sanin1';
$line[] = 'sanin2';
$line[] = 'osakahigashi';
$line[] = 'takarazuka';
$line[] = 'fukuchiyama';
$line[] = 'tozai';
$line[] = 'gakkentoshi';
$line[] = 'bantan';
$line[] = 'maizuru';
$line[] = 'osakaloop';
$line[] = 'yumesaki';
$line[] = 'yamatoji';
$line[] = 'hanwahagoromo';
$line[] = 'kansaiairport';
$line[] = 'wakayama2';
$line[] = 'wakayama1';
$line[] = 'manyomahoroba';
$line[] = 'kansai';
$line[] = 'kinokuni';

//路線ごとに最大遅延時分を表示
for($i=0;$i<count($line);$i++){
    //JR西日本列車走行位置からJSON情報取得
    $json = 'https://www.train-guide.westjr.co.jp/api/v3/'.$line[$i].'.json';
    //json_decode：JSONを連想配列にする
    //file_get_contents:指定したファイルの内容を読み込み、その内容を文字列として返す
    $object = json_decode(file_get_contents($json),true);
    //列車データを格納
    $trains = $object['trains'];
    $trainstatus = [];
    $max_delay = 0;
    if(date("H") >= 2 and date("H") <= 4){
        $_SESSION[$line[$i]] = '午前2時～午前4時は情報提供対象外時間です';
    }
    elseif(empty($trains)){
        $_SESSION[$line[$i]] = '本日の運転は終了しています';
    }
    else{
        //列車の数だけ繰り返す
        foreach($trains as $val){
            //遅れ
            if($val['delayMinutes'] == '0'){
                $val['delayMinutes'] = '平常運転中';
            }else{
                if($max_delay < $val['delayMinutes']){
                    $max_delay = $val['delayMinutes'];
                }
                $val['delayMinutes'] = '遅れ約'.$val['delayMinutes'].'分';
            }
            if($max_delay == 0){
                $_SESSION[$line[$i]] = '1分以上の遅れなし';
            }else{
                $_SESSION[$line[$i]] = $max_delay.'分';
            }
        }
    }
}

//表示部に連絡
require_once './tpl/position_top.php';
