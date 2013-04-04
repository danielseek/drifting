<?php

namespace api;
require __DIR__."/class.apiBase.php";
$api = new ApiBase();

if($api->checkApiKey($_GET["api_key"])){
$data= Array(
    "id"=>0,
    "error"=>null,
    "drivers" =>Array(
	0=> Array(
	    "id"=>0,
	    "name"=> "Matyáš Vaněk",
	    "team"=> "",
	    "image_url" => "http://drifting.hys.cz/api/temp/28112_123162564386807_4041041_n.jpg"
	),
	1=> Array(
	    "id"=>1,
	    "name"=> "Ladislav Bezouška",
	    "team"=> "Driftracing.cz",
	    "image_url"=> "http://drifting.hys.cz/api/temp/68624_525050564173055_433839837_n.jpg"
	)
    ),
    "rides"=>Array(
	0 => Array(5, 5),
	1 => Array(5,5),
	2 => Array(4,6),
	3 => Array(6,4),
	4 => Array(5,5),
	5 => Array(6,4)
    )
);

} else {
    $date = Array();
    $data["error"] = "Invalid api_key";
}
$api->sendHeaders();
echo json_encode($data);

