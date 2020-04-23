<?php
include "../config/config.php";
header('Content-type: application/json; charset=UTF-8');

$query = $mysqli->query("SELECT * FROM cflix_film ORDER BY id DESC");

$response = array();
$response['data'] = array();
while ($data = $query->fetch_array()) {
    $res['id'] = $data['id'];
    $res['title'] = $data['title'];
    $res['picture'] = $data['picture'];
    $res['title_seo'] = $data['title_seo'];
    $res['sinopsis'] = $data['sinopsis'];
    $res['genre'] = $data['genre'];
    $res['negara'] = $data['negara'];
    $res['tahun'] = $data['tahun'];
    $res['aktor'] = $data['aktor'];
    $res['sutradara'] = $data['sutradara'];
    $res['rating'] = $data['rating'];
    $res['trailer'] = $data['trailer'];

    // $query_video = $mysqli->query("SELECT * FROM cflix_video WHERE id='$data[video]' ");
    $res['video'] = $data['video'];

    $res['view'] = $data['view'];

    array_push($response['data'], $res);

}

echo json_encode($response);

?>