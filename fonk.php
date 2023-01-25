<?php
function dosya_indir($url,$dosya_adi,$klasor)
{
 
$url_info = pathinfo($url);
$uzanti = strtolower($url_info['extension']); 
$dosya = ($dosya_adi) ? $dosya_adi.'.'.$uzanti : $url_info['basename'];
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

  function get_url_curl($url){
    $curl = curl_init($url);
    curl_setopt ($curl, CURLOPT_TIMEOUT, "50");
    curl_setopt ($curl, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt ($curl, CURLOPT_HEADER, 1);
    curl_setopt ($curl, CURLOPT_ENCODING, "UTF-8");
    curl_setopt ($curl, CURLOPT_SSL_VERIFYPEER, FALSE);

    $curlResult = curl_exec($curl);
    curl_close($curl);
    return str_replace(array("\n","\t","\r"),null,$curlResult);
  }

	function kisalt($kelime, $str = 10)
	{
		if (strlen($kelime) > $str)
		{
			if (function_exists("mb_substr")) $kelime = mb_substr($kelime, 0, $str, "UTF-8").'..';
			else $kelime = substr($kelime, 0, $str).'..';
		}
		return $kelime;
	}
function konum_bul($veri = 'status'){ //Veriler country countryCode	region	regionName	city zip lat lon timezone isp org as query	
	$ip = 'http://ip-api.com/json/'.$_SERVER["REMOTE_ADDR"].'';
	$ch = curl_init($ip);                                                                     
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
		'Content-Type: application/json'                                                                                
	));
	$sonuc = curl_exec($ch);

    $sonuc = json_decode($sonuc);
    return $sonuc->$veri;
}
date_default_timezone_set('Europe/Istanbul');
function turkcetarih_formati($format, $datetime = 'now'){
    $z = date("$format", strtotime($datetime));
    $gun_dizi = array(
        'Monday'    => 'Pazartesi',
        'Tuesday'   => 'Salı',
        'Wednesday' => 'Çarşamba',
        'Thursday'  => 'Perşembe',
        'Friday'    => 'Cuma',
        'Saturday'  => 'Cumartesi',
        'Sunday'    => 'Pazar',
        'January'   => 'Ocak',
        'February'  => 'Şubat',
        'March'     => 'Mart',
        'April'     => 'Nisan',
        'May'       => 'Mayıs',
        'June'      => 'Haziran',
        'July'      => 'Temmuz',
        'August'    => 'Ağustos',
        'September' => 'Eylül',
        'October'   => 'Ekim',
        'November'  => 'Kasım',
        'December'  => 'Aralık',
        'Mon'       => 'Pts',
        'Tue'       => 'Sal',
        'Wed'       => 'Çar',
        'Thu'       => 'Per',
        'Fri'       => 'Cum',
        'Sat'       => 'Cts',
        'Sun'       => 'Paz',
        'Jan'       => 'Oca',
        'Feb'       => 'Şub',
        'Mar'       => 'Mar',
        'Apr'       => 'Nis',
        'Jun'       => 'Haz',
        'Jul'       => 'Tem',
        'Aug'       => 'Ağu',
        'Sep'       => 'Eyl',
        'Oct'       => 'Eki',
        'Nov'       => 'Kas',
        'Dec'       => 'Ara',
    );
    foreach($gun_dizi as $en => $tr){
        $z = str_replace($en, $tr, $z);
    }
    if(strpos($z, 'Mayıs') !== false && strpos($format, 'F') === false) $z = str_replace('Mayıs', 'May', $z);
    return $z;
}

//echo turkcetarih_formati('j F Y','2017-08-15');  //Çıktı: 15 Ağustos 2017
 
//echo turkcetarih_formati('j F Y , l','2017-08-15');  //Çıktı: 15 Ağustos 2017 , Salı

function gun_cevir($durum,$dil = 'en') {     
    $eski   = array("0","1","2","3","4","5","6");    
    if($dil=='en'){ 
    $yeni   = array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");  
    }
    if($dil=='tr'){ 
        $yeni   = array("Pazartesi","Salı","Çarşamba","Perşembe","Cuma","Cumartesi","Pazar");  
    }
    if($dil=='de'){ 
        $yeni   = array("Montag","Dienstag","Mittwoch","Donnerstag","Freitag","Samstag","Sonntag");  
    }
    if($dil=='it'){ 
        $yeni   = array("Lunedì", "Martedì", "Mercoledì", "Giovedì", "Venerdì", "Sabato", "Domenica");
    }
    if($dil=='es'){ 
        $yeni   =  array("Lunes","Martes","Miercoles","Jueves","Viernes","Sabado","Domingo");
    }
    if($dil=='fr'){ 
        $yeni   =  array("Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi","Dimanche");
    }
    $durum = str_replace($eski, $yeni, $durum);     
    return $durum;
}

function yonlendir($yer,$sure = 0){
    if ($yer=="") { $yer=suankisayfa();}
    echo "<meta http-equiv='Refresh' content='".$sure.";url=".$yer."' />";
}
function suankisayfa(){
    $tarayici_adres = $_SERVER["PHP_SELF"];
    $adres_bol = explode("/",$tarayici_adres);
    return $adres_bol[count($adres_bol)-1];
}

function http_to_https(){
	if ( (isset($_SERVER['HTTP_X_FORWARDED_PORT'] ) && ( '443' == $_SERVER['HTTP_X_FORWARDED_PORT'] ))
    || (isset($_SERVER['HTTP_CF_VISITOR']) && $_SERVER['HTTP_CF_VISITOR'] == '{"scheme":"https"}')) {
    $_SERVER['HTTPS'] = 'on';
}
if (!(isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || 
   $_SERVER['HTTPS'] == 1) ||  
   isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&   
   $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https'))
{
   $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
   header('HTTP/1.1 301 Moved Permanently');
   header('Location: ' . $redirect);
   exit();
}
}

function db_baglanti(){
	try {
    $db = new PDO("mysql:host=localhost;dbname=tas;charset=utf8", "root", "");
}  
    catch ( PDOException $e ){
    print $e->getMessage();
}
}
