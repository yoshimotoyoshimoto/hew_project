<?php
function pass_hash($pass,$salt,$stretch){
  //$passの前に毎回$salt内の文字を付加→$stretch回ストレッチング
  for($i=1;$i<=$stretch;$i++){
    $pass = md5($salt.$pass);
  }
  //ハッシュ化した後の値を返す
  return $pass;
}