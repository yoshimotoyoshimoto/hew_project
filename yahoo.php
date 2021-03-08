<?php
ini_set("display_errors", 1);
error_reporting(E_ALL);
require_once 'simple_html_dom.php';
require_once 'function.php';

//yahooでやってみた

// echo "北海道地方";
$url = 'https://transit.yahoo.co.jp/traininfo/area/2/';
$hokaidou = extraction_all($url);
// print_r($hokaidou);

// echo "東北地方";
$url = 'https://transit.yahoo.co.jp/traininfo/area/3/';
$touhoku = extraction_all($url);
// print_r($touhoku);

// echo "関東地方";
$url = 'https://transit.yahoo.co.jp/traininfo/area/4/';
$kantou = extraction_all($url);
// print_r($kantou);

// echo "中部地方";
$url = 'https://transit.yahoo.co.jp/traininfo/area/5/';
$tyubu = extraction_all($url);
// print_r($tyubu);

// echo "近畿地方";
$url = 'https://transit.yahoo.co.jp/traininfo/area/6/';
$kinki = extraction_all($url);
// print_r($kinki);

// echo "中国地方";
$url = 'https://transit.yahoo.co.jp/traininfo/area/8/';
$tyugoku = extraction_all($url);
// print_r($tyugoku);

// echo "四国地方";
$url = 'https://transit.yahoo.co.jp/traininfo/area/9/';
$sikoku = extraction_all($url);
// print_r($sikoku);

// echo "九州";
$url = 'https://transit.yahoo.co.jp/traininfo/area/7/';
$kyusyu = extraction_all($url);
// print_r($kyusyu);

require_once './tpl/yahoo.php'
?>
