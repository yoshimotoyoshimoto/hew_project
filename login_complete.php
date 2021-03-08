<?php
//処理を書くファイル
//const呼び出し
// require_once './const.php';
// $class = new ConstClass;

//function呼び出し
require_once './func.php';
//session開始
session_start();

//直接このページを開いた場合：entry.phpへ遷移
if(!isset($_SESSION['status'])){
    header('location:./entry.php');
    exit;
}
//ログイン完了でない場合：entry.phpへ遷移
if($_SESSION['status'] !== 'ログイン完了'){
    header('location:./entry.php');
    exit;
}

require_once './tpl/login_complete.php';