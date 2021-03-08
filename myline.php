<?php
//session開始
session_start();
//const呼び出し
// require_once './const.php';
// $class = new ConstClass;
//DB接続
$link = @mysqli_connect(getenv('DB_HOSTNAME'),getenv('DB_USERNAME'),getenv('DB_PASSWORD'),getenv('DATA_NAME'));

//エラー処理(DB接続不可)
if(!$link){
    $_SESSION['db_error'] = 'システムエラーが発生しました(エラーコード：ER-DB01)';
    header('location:./entry.php');
    exit;
}
//文字コード設定
mysqli_set_charset($link,'utf8');

if(!isset($_SESSION['name'])){
    header('location:./login.php');
    exit;
}

//SQL定義
$sql = "SELECT * FROM member WHERE name='".$_SESSION['name']."'";
//SQL実行
$result = @mysqli_query($link,$sql);
//1件情報取得→配列に格納
$row = mysqli_fetch_assoc($result);

require_once './tpl/myline.php';