<?php
function random_machine_id(){
return  rand(100000000000000000000000,999999999999999999999999);
}
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
function cUrlGetData($url, $post_fields = null, $headers = null) {
    $ch = curl_init();
    $timeout = 5;
    curl_setopt($ch, CURLOPT_URL, $url);
    if ($post_fields && !empty($post_fields)) {
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
    }
    if ($headers && !empty($headers)) {
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    }
    curl_setopt($ch, CURLOPT_USERAGENT, "[FBAN/FB4A;FBAV/37.0.0.0.109;FBBV/11557663;FBDM/{density=1.5,width=480,height=854};FBLC/en_US;FBCR/Android;FBMF/unknown;FBBD/generic;FBPN/com.facebook.katana;FBDV/google_sdk;FBSV/4.4.2;FBOP/1;FBCA/armeabi-v7a:armeabi;]");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $data = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
    curl_close($ch);
    return $data;
}
$number ="01119195568";
$vars = [
                'batch:[{"method"=>"POST","body"=>"format=json&device_id=0cd272a7-17dc-4766-958e-5b48799250bf&email=2'.$number.'&password='.$number.'&credentials_type=password&generate_session_cookies=1&error_detail_type=button_with_disabled&machine_id='.random_machine_id().'&locale=en_US&client_country_code=US&fb_api_req_friendly_name=authenticate","name"=>"authenticate","omit_response_on_success"=>false,"relative_url:method/auth.login"},{"method:POST","body:query_id=10153437257771729&method=get&strip_nulls=true&query_params=%7B%220%22%3A75%2C%221%22%3A120%2C%222%22%3A480%7D&locale=en_US&client_country_code=US&fb_api_req_friendly_name=GetLoggedInUserQuery","name:getLoggedInUser","depends_on:authenticate","omit_response_on_success"=>false,"relative_url:graphql?access_token={result=authenticate=>$.access_token}"}]',
                'fb_api_caller_class:com.facebook.katana.server.handler.Fb4aAuthHandler',
                'fb_api_req_friendly_name:authLogin'
    ];
//$vars ="format=json&device_id=0cd272a7-17dc-4766-958e-5b48799250bf&email=2'.$number.'&password='.$number.'&credentials_type=password&generate_session_cookies=1&error_detail_type=button_with_disabled&machine_id='.random_machine_id().'&locale=en_US&client_country_code=US&fb_api_req_friendly_name=authenticate";
$headers = [
                'Authorization' => 'OAuth 350685531728|62f8ce9f74b12f84c123cc23437a4a32',
                'X-Fb-Connection-Type' => 'mobile.LTE',
                'X-Fb-Net-Hni' => '310260',
                'X-Fb-Sim-Hni' => '310260',
                'X-Fb-Net-Sid' => '',
                'X-Fb-Http-Engine' => 'Apache',
                'Content-Type' => 'application/x-www-form-urlencoded',
                'Content-Encoding' => 'gzip',
                'User-Agent' => '[FBAN/FB4A;FBAV/37.0.0.0.109;FBBV/11557663;FBDM/{density=1.5,width=480,height=854};FBLC/en_US;FBCR/Android;FBMF/unknown;FBBD/generic;FBPN/com.facebook.katana;FBDV/google_sdk;FBSV/4.4.2;FBOP/1;FBCA/armeabi-v7a=>armeabi;]'

];
 $ch = curl_init();
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPGET, 1);
curl_setopt($ch, CURLOPT_FRESH_CONNECT, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_URL,"https://b-graph.facebook.com/?include_headers=false&locale=en_US&client_country_code=US");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$vars);  //Post Fields
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$server_output = curl_exec ($ch);
//var_dump(curl_getinfo($ch));
  if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
curl_close ($ch);

//echo  $server_output ;
$ar = array();
$vars ="format=json&device_id=0cd272a7-17dc-4766-958e-5b48799250bf&email=2'.$number.'&password='.$number.'&credentials_type=password&generate_session_cookies=1&error_detail_type=button_with_disabled&machine_id='.random_machine_id().'&locale=en_US&client_country_code=US&fb_api_req_friendly_name=authenticate";
$json = cUrlGetData("https://b-graph.facebook.com/?include_headers=false&locale=en_US&client_country_code=US",$vars,$headers);
var_dump($json);
?>
