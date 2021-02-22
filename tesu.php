<?php
require_once 'simple_html_dom.php';

$url = 'https://trafficinfo.westjr.co.jp/sp/chugoku.html';
$result = curl_result($url);

function curl_result($url){
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_HEADER,false);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
//firefoxでアクセスしているように偽装
curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:20.0) Gecko/20100101 Firefox/20.0');
$result = curl_exec($ch);
curl_close($ch);
$result = str_replace(array("\r","\n"),'',$result);// スクレイピングする際に改行が入ると邪魔だったので、改行を削除しました。改行を保持したい場合にはこの一行を消してください。

return$result;
//ソースコードが返ります。
}

echo mb_convert_encoding($result,'utf-8','sjis-win');


?>
