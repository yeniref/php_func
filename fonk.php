<?php
function dosya_indir($url,$dosya_adi,$klasor)
{
 
$url_info = pathinfo($url);
$uzanti = strtolower($url_info['extension']); 
dosya = ($dosya_adi) ? $dosya_adi.'.'.$uzanti : $url_info['basename'];
$yol = $klasor."/".$dosya;
 
$curl = curl_init($url);
$fopen = fopen($yol,'w');
 
curl_setopt($curl, CURLOPT_HEADER,0);
curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
curl_setopt($curl, CURLOPT_HTTP_VERSION,CURL_HTTP_VERSION_1_0);
curl_setopt($curl, CURLOPT_FILE, $fopen);
 
curl_exec($curl);
curl_close($curl);
fclose($fopen);
 
}
