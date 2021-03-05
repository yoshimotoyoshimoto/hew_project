<?php
require_once 'simple_html_dom.php';
require_once 'function.php';

//詳細表示
$url = 'https://transit.yahoo.co.jp/traininfo/detail/'. $_GET["url"] .'';

$details_name = extraction_2($url, 'h1', 'title');
$details_status = extraction_4($url, 'dd', 'normal', 'trouble', 'trouble suspend');
$details_check = extraction_class($url, 'dd', 'div', 'mdServiceStatus');
$delay = delay_certificate($details_name);

// print_r($details_name);
// print_r($details_status);
//print_r($details_check);
// print_r($delay);

require_once './tpl/yahoo_details.php'
?>
