<?php
  require_once("./phpQuery-onefile.php");
  $html = file_get_contents("https://trafficinfo.westjr.co.jp/chugoku.html");
  $echo = phpQuery::newDocument($html)->find(".contents-inner");
  echo mb_convert_encoding($echo,'utf-8','sjis-win');
?>