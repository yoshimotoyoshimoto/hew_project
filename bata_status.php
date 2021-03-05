<?php
//session開始
session_start();
//Twitter呼び出し
require_once './local_tw.php';

//入力検索から来た時
if(!empty($_POST['search'])){
    $line_name = $_POST['line'];
    $line = [];
    $list[] = $line_name;
    $line = twd($list);
    $line2 = [];
    $line2 = twd2($list);
    $line3 = [];
    $line3 = twd3($list);
    $line4 = [];
    $line4 = twd4($list);
}else{
    $line_name = $_GET['line'];
    $line = [];
    $list[] = $line_name;
    $line = twd($list);
    $line2 = [];
    $line2 = twd2($list);
    $line3 = [];
    $line3 = twd3($list);
    $line4 = [];
    $line4 = twd4($list);
}

//表示部へ移動
require_once './tpl/bata_status.php';