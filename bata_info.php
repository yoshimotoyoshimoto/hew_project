<?php
//各ファイル呼び出し
require_once 'simple_html_dom.php';
require_once 'function.php';
//session開始
session_start();

//路線名取得
//北海道地方
$url = 'https://transit.yahoo.co.jp/traininfo/area/2/';
$hokaidou_link = extraction_link($url, 'td', 'div', 'elmTblLstLine');
//東北地方
$url = 'https://transit.yahoo.co.jp/traininfo/area/3/';
$touhoku_link = extraction_link($url, 'td', 'div', 'elmTblLstLine');
//関東地方
$url = 'https://transit.yahoo.co.jp/traininfo/area/4/';
$kantou_link = extraction_link($url, 'td', 'div', 'elmTblLstLine');
//中部地方
$url = 'https://transit.yahoo.co.jp/traininfo/area/5/';
$tyubu_link = extraction_link($url, 'td', 'div', 'elmTblLstLine');
//近畿地方
$url = 'https://transit.yahoo.co.jp/traininfo/area/6/';
$kinki_link = extraction_link($url, 'td', 'div', 'elmTblLstLine');
//中国地方
$url = 'https://transit.yahoo.co.jp/traininfo/area/8/';
$tyugoku_link = extraction_link($url, 'td', 'div', 'elmTblLstLine');
//四国地方
$url = 'https://transit.yahoo.co.jp/traininfo/area/9/';
$sikoku_link = extraction_link($url, 'td', 'div', 'elmTblLstLine');
//九州・沖縄地方
$url = 'https://transit.yahoo.co.jp/traininfo/area/7/';
$kyusyu_link = extraction_link($url, 'td', 'div', 'elmTblLstLine');


require_once './tpl/bata_info.php';