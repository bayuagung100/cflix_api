<?php
include "../../config/config.php";
header('Access-Control-Allow-Headers: Access-Control-Allow-Origin, Content-Type');
header('Content-type: application/json; charset=UTF-8');
header("Access-Control-Allow-Origin: *");


$response = array();
if (isset($_GET['country'])) {
    $query = $mysqli->query("SELECT * FROM test_hack WHERE country = '$_GET[country]' ");
    $cek = $query->num_rows;

    if ($cek > 0) {
        if (isset($_GET['key'])) {
            # code...
        
            while ($data = $query->fetch_array()) {
                $res['id'] = $data['id'];
                $res['country'] = $data['country'];
                $res['kunci'] = $data['kunci'];
                
                array_push($response, $res);
            }
        }
    } else {
        $res['status_code'] = '304';
        $res['message'] = 'Error query, please check field';
        array_push($response, $res);
    }
} else {
    $res['status_code'] = '200';
    $res['message'] = 'key invalid.';
    array_push($response, $res);
}

echo json_encode($response);

?>