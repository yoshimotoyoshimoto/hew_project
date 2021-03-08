<?php
//各ファイル呼び出し
require_once 'simple_html_dom.php';
require_once 'function.php';
//session開始
session_start();
//const呼び出し
require_once './const.php';
$class = new ConstClass;
//DB接続

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

if(!empty($_POST['line_insert'])){
    if(!isset($_SESSION['name'])){
        header('location:./login.php');
        exit;
    }
    $line = $_POST['line'];
    //DB接続
    $link = @mysqli_connect($class::HOST,$class::USER_ID,$class::PASSWORD,$class::DB_NAME);
    //エラー処理(DB接続不可)
    if(!$link){
        $_SESSION['db_error'] = 'システムエラーが発生しました(エラーコード：ER-DB01)';
        header('location:./entry.php');
        exit;
    }
    //文字コード設定
    mysqli_set_charset($link,'utf8');

    //SQL定義
    $sql = "SELECT * FROM member WHERE name='".$_SESSION['name']."'";
    //SQL実行
    $result = @mysqli_query($link,$sql);
    //1件情報取得→配列に格納
    $row = mysqli_fetch_assoc($result);
    if($row['line_1'] == ''){
        //SQL定義
        $sql2 = "UPDATE member SET line_1 = '".$line."' WHERE name = '".$row['name']."'";
        //SQL実行
        $result2 = @mysqli_query($link,$sql2);
    }elseif($row['line_2'] == ''){
        //SQL定義
        $sql2 = "UPDATE member SET line_2 = '".$line."' WHERE name = '".$row['name']."'";
        //SQL実行
        $result2 = @mysqli_query($link,$sql2);
    }elseif($row['line_3'] == ''){
        //SQL定義
        $sql2 = "UPDATE member SET line_3 = '".$line."' WHERE name = '".$row['name']."'";
        //SQL実行
        $result2 = @mysqli_query($link,$sql2);
    }else{
        $_SESSION['cant_insert'] = '登録できる路線は3路線までです';
        header('location:./myline_insert.php');
        exit;
    }
}


require_once './tpl/myline_insert.php';