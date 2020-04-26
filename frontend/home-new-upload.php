<?php
include "../config/config.php";
header('Content-type: application/json; charset=UTF-8');
header("Access-Control-Allow-Origin: *");

$query = $mysqli->query("SELECT * FROM cflix_film ORDER BY id DESC LIMIT 12");

$response = array();
$response['data'] = array();

while ($data = $query->fetch_array()) {
    $res['id'] = $data['id'];
    $res['title'] = $data['title'];
    $res['picture'] = $data['picture'];
    $res['title_seo'] = $data['title_seo'];
    $res['rating'] = $data['rating'];
    
    array_push($response['data'], $res);

}

echo json_encode($response);

?>