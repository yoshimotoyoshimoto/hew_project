<?php

ini_set("display_errors", 1);
error_reporting(E_ALL);
//処理を書くファイル
//const呼び出し
// require_once './const.php';
// $class = new ConstClass;

//function呼び出し
require_once './func.php';
//session開始
session_start();

//確認ボタンが押されたときに以下の処理
if(!empty($_POST['entry_check'])){
    //入力値チェック(エラーメッセージ定義・エラーフラッグ設定)
    //氏名：未入力
    if($_POST['name'] == ''){
        $_SESSION['name_error'] = '入力されていません(エラーコード：ER-E01)';
        $_SESSION['error_flag'] = 'エラーあり';
    }
    //パスワード：未入力
    if($_POST['password'] == ''){
        $_SESSION['password_error'] = '入力されていません(エラーコード：ER-E03)';
        $_SESSION['error_flag'] = 'エラーあり';
    }
    //メールアドレス：未入力
    if($_POST['mail'] == ''){
        $_SESSION['mail_error'] = '入力されていません(エラーコード：ER-E04)';
        $_SESSION['error_flag'] = 'エラーあり';
    }
    //メールアドレス：入力済みではあるが形式異常(@なし)
    elseif(!strpos($_POST['mail'],'@')){
        $_SESSION['mail_error'] = 'メールアドレスが正しく入力されていません(エラーコード：ER-E05)';
        $_SESSION['error_flag'] = 'エラーあり';
    }
    //入力値異常があるか
    if(!empty($_SESSION['error_flag'])){
        //入力値異常あり：入力内容を残して入力画面に戻す
        //エラーフラッグ消去
        unset($_SESSION['error_flag']);
        //入力内容を残す
        $name = $_POST['name'];
        $mail = $_POST['mail'];
        $_SESSION['password_retry'] = '再度パスワードを入力してください(エラーコード：ER-E06)';
    }else{
        //入力値異常なし：入力内容保存し登録完了画面に遷移
        $_SESSION['name'] = $_POST['name'];
        $_SESSION['password'] = $_POST['password'];
        $_SESSION['mail'] = $_POST['mail'];
        //ステータス設定
        $_SESSION['status'] = '登録実施';
        header('location:./entry_complete.php');
        exit;
    }
}

//entry_check.phpから戻ってきた場合(入力内容訂正)
if(isset($_SESSION['status'])){
    unset($_SESSION['status']);
    $name = $_SESSION['name'];
    $mail = $_SESSION['mail'];
    $_SESSION['password_retry'] = '再度パスワードを入力してください(ER-E06)';
}

require_once './tpl/entry.php';
