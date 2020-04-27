<?php
include "../../config/config.php";
header('Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type');
header('Content-type: application/json; charset=UTF-8');
header("Access-Control-Allow-Origin: *");

$query = $mysqli->query("SELECT * FROM cflix_film ORDER BY id DESC LIMIT 12");

$response = array();
$response['data'] = array();

while ($data = $query->fetch_array()) {
    $res['id'] = $data['id'];
    $res['title'] = $data['title'];
    $res['title_seo'] = $data['title_seo'];
    
    
    $query_master = $mysqli->query("SELECT * FROM cflix_film_master WHERE id = '$data[master_film]' ");
    while ($data_master = $query_master->fetch_array()) {
        $res['picture'] = $data_master['picture'];

        $query_rating = $mysqli->query("SELECT * FROM cflix_rating WHERE id='$data_master[rating]' ");
        $data_rating= $query_rating->fetch_array();
        $res['rating'] = $data_rating['name'];
    }
    

    array_push($response['data'], $res);

}

echo json_encode($response);

?>