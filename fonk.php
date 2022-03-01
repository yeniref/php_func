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

//dosya_indir('url_adres','dosya_adi','klasor_yolu')

function youtube_id($in, $to_num = false, $pad_up = false, $pass_key = null)
{
  $out   =   '';
  $index = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $base  = strlen($index);

  if ($pass_key !== null) {
    // Although this function's purpose is to just make the
    // ID short - and not so much secure,
    // with this patch by Simon Franz (https://blog.snaky.org/)
    // you can optionally supply a password to make it harder
    // to calculate the corresponding numeric ID

    for ($n = 0; $n < strlen($index); $n++) {
      $i[] = substr($index, $n, 1);
    }

    $pass_hash = hash('sha256',$pass_key);
    $pass_hash = (strlen($pass_hash) < strlen($index) ? hash('sha512', $pass_key) : $pass_hash);

    for ($n = 0; $n < strlen($index); $n++) {
      $p[] =  substr($pass_hash, $n, 1);
    }

    array_multisort($p, SORT_DESC, $i);
    $index = implode($i);
  }

  if ($to_num) {
    // Digital number  <<--  alphabet letter code
    $len = strlen($in) - 1;

    for ($t = $len; $t >= 0; $t--) {
      $bcp = bcpow($base, $len - $t);
      @$out = (int)$out + (int)strpos($index, substr($in, $t, 1)) * (int)$bcp;
    }

    if (is_numeric($pad_up)) {
      $pad_up--;

      if ($pad_up > 0) {
        $out -= pow($base, $pad_up);
      }
    }
  } else {
    // Digital number  -->>  alphabet letter code
    if (is_numeric($pad_up)) {
      $pad_up--;

      if ($pad_up > 0) {
        $in += pow($base, $pad_up);
      }
    }

    for ($t = ($in != 0 ? floor(log($in, $base)) : 0); $t >= 0; $t--) {
      $bcp = bcpow($base, $t);
      $a   = floor($in / $bcp) % $base;
      $out = $out . substr($index, $a, 1);
      $in  = $in - ($a * $bcp);
    }
  }

  return $out;
}

//echo youtube_id('123456');
//echo youtube_id('6ho',true);
