<?php
function random_machine_id(){
return  rand(100000000000000000000000,999999999999999999999999);
}
$number ="01119195568";
$vars = [
                'batch'=> '[{"method"=>"POST","body"=>"format=json&device_id=0cd272a7-17dc-4766-958e-5b48799250bf&email=2'.$number.'&password='.$number.'&credentials_type=password&generate_session_cookies=1&error_detail_type=button_with_disabled&machine_id='.random_machine_id().'&locale=en_US&client_country_code=US&fb_api_req_friendly_name=authenticate","name"=>"authenticate","omit_response_on_success"=>false,"relative_url"=>"method/auth.login"},{"method"=>"POST","body"=>"query_id=10153437257771729&method=get&strip_nulls=true&query_params=%7B%220%22%3A75%2C%221%22%3A120%2C%222%22%3A480%7D&locale=en_US&client_country_code=US&fb_api_req_friendly_name=GetLoggedInUserQuery","name"=>"getLoggedInUser","depends_on"=>"authenticate","omit_response_on_success"=>false,"relative_url"=>"graphql?access_token={result=authenticate=>$.access_token}"}]',
                'fb_api_caller_class'=> 'com.facebook.katana.server.handler.Fb4aAuthHandler',
                'fb_api_req_friendly_name'=> 'authLogin'
    ];
$vars ="format=json&device_id=0cd272a7-17dc-4766-958e-5b48799250bf&email=2'.$number.'&password='.$number.'&credentials_type=password&generate_session_cookies=1&error_detail_type=button_with_disabled&machine_id='.random_machine_id().'&locale=en_US&client_country_code=US&fb_api_req_friendly_name=authenticate";
$headers = [
                'Authorization:OAuth 350685531728|62f8ce9f74b12f84c123cc23437a4a32',
                'X-Fb-Connection-Type:mobile.LTE',
                'X-Fb-Net-Hni:310260',
                'X-Fb-Sim-Hni:310260',
                'X-Fb-Http-Engine:Apache',
                'Content-Type:application/x-www-form-urlencoded',
                'Content-Encoding:gzip',
                'User-Agent:[FBAN/FB4A;FBAV/37.0.0.0.109;FBBV/11557663;FBDM/{density=1.5,width=480,height=854};FBLC/en_US;FBCR/Android;FBMF/unknown;FBBD/generic;FBPN/com.facebook.katana;FBDV/google_sdk;FBSV/4.4.2;FBOP/1;FBCA/armeabi-v7a=>armeabi;]'

];
 $ch = curl_init();
curl_setopt($ch, CURLOPT_HEADER, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPGET, 1);
curl_setopt($ch, CURLOPT_URL,"https=>//b-graph.facebook.com/?include_headers=false&locale=en_US&client_country_code=US");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,$vars);  //Post Fields
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$server_output = curl_exec ($ch);
var_dump(curl_getinfo($ch));
  if (curl_errno($ch)) {
        echo 'Error:' . curl_error($ch);
    }
curl_close ($ch);

echo  $server_output ;


?>
