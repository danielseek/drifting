<?php
namespace api;
require __DIR__."/class.apiBase.php";
$api = new ApiBase();

if(isset($_GET["api_key"]) and $api->checkApiKey($_GET["api_key"])){
$data= Array(
    "id"=>0,
   
    "name"=>"sosnova",
    "location"=>"Česká lípa",
    "track"=>"Autodrom Sosnová",
    
    "status" => "qualifying"
);

} else {
    $data = Array();
    $data["error"] = "Invalid api_key";
}
$api->setData($data);
echo $api->json();

?>
