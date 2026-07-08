<?php
$base='content/contents/';
$txt=['intro','skills','kwaliteiten','werkervaring','contact'];
$data=[];
foreach($txt as $t){$f=$base.$t.'.txt'; if(file_exists($f)){$data[$t]=nl2br(htmlspecialchars(trim(file_get_contents($f))));}}
if(empty($data)){echo '<center><h1>Coming soon...</h1></center>'; exit;}
$links=[];
if(file_exists($base.'links.txt')){
 foreach(file($base.'links.txt',FILE_IGNORE_NEW_LINES) as $l){
  if(preg_match('/<(.*?)>(.*?)<\/.*?>/',$l,$m))$links[$m[1]]=$m[2];
 }
}
$pdfs=glob($base.'*.pdf');
$certs=[];$cv='';
foreach($pdfs as $p){if(basename($p)=='cv.pdf')$cv=$p;else $certs[]=$p;}
$age=date('Y')-2000;$copy='2024-'.date('Y');
?><!doctype html><html><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><link rel="stylesheet" href="assets/style.css"></head><body><div class="c"><h1>Portfolio</h1><?php foreach($data as $k=>$v){echo "<section><h2>".ucfirst($k)."</h2><p>$v</p></section>";} if($certs){echo "<h2>Certificates</h2><div class='g'>";foreach($certs as $c){echo "<iframe src='$c'></iframe>";}echo"</div>";} if($cv)echo "<h2>CV</h2><iframe src='$cv'></iframe>"; if($links){echo "<h2>Links</h2>";foreach($links as $n=>$u)echo "<p><b>$n</b>: <a href='$u'>$u</a></p>";} ?><footer>Age <?=$age?> • &copy; <?=$copy?></footer></div></body></html>