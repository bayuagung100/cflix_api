<?php
include "../config/config.php";
header('Content-type: application/json; charset=UTF-8');
header("Access-Control-Allow-Origin: *");


$response = array();
if (isset($_POST['id'])) {
    $query = $mysqli->query("SELECT * FROM cflix_film WHERE id = '$_POST[id]' ");
    $cek = $query->num_rows;

    if ($cek > 0) {
        while ($data = $query->fetch_array()) {
            $res['id'] = $data['id'];
            $res['title'] = $data['title'];
            $res['picture'] = $data['picture'];
            $res['title_seo'] = $data['title_seo'];

            $pecah_genre = explode(";", $data['genre']);
            $gabung_genre = implode(",", $pecah_genre);
            $query_genre = $mysqli->query("SELECT * FROM cflix_genre WHERE id IN ($gabung_genre) ");
            $res['genre'] = array();
            while ($data_genre = $query_genre->fetch_array()){
                $res_genre['name'] = $data_genre['name'];
                array_push($res['genre'], $res_genre);
            }

            $query_negara = $mysqli->query("SELECT * FROM cflix_negara WHERE id='$data[negara]' ");
            $data_negara= $query_negara->fetch_array();
            $res['negara'] = $data_negara['name'];

            $query_tahun = $mysqli->query("SELECT * FROM cflix_tahun WHERE id='$data[tahun]' ");
            $data_tahun= $query_tahun->fetch_array();
            $res['tahun'] = $data_tahun['name'];

            $pecah_aktor = explode(";", $data['aktor']);
            $gabung_aktor = implode(",", $pecah_aktor);
            $query_aktor = $mysqli->query("SELECT * FROM cflix_aktor WHERE id IN ($gabung_aktor) ");
            $res['aktor'] = array();
            while ($data_aktor = $query_aktor->fetch_array()){
                $res_aktor['name'] = $data_aktor['name'];
                array_push($res['aktor'], $res_aktor);
            }

            $query_sutradara = $mysqli->query("SELECT * FROM cflix_sutradara WHERE id='$data[sutradara]' ");
            $data_sutradara= $query_sutradara->fetch_array();
            $res['sutradara'] = $data_sutradara['name'];

            $query_rating = $mysqli->query("SELECT * FROM cflix_rating WHERE id='$data[rating]' ");
            $data_rating= $query_rating->fetch_array();
            $res['rating'] = $data_rating['name'];

            $query_trailer = $mysqli->query("SELECT * FROM cflix_trailer WHERE id='$data[trailer]' ");
            $data_trailer= $query_trailer->fetch_array();
            $res['trailer'] = $data_trailer['url_trailer'];

            $pecah_video = explode(";", $data['video']);
            $gabung_video = implode(",", $pecah_video);
            $query_video = $mysqli->query("SELECT * FROM cflix_video WHERE id IN ($gabung_video) ");
            $res['video'] = array();
            while ($data_video = $query_video->fetch_array()){
                $res_video['label']= $data_video['label']." (".$data_video['kualitas_video'].")";
                $res_video['url_video']= $data_video['url_video'];
                $res_video['kualitas_video']= $data_video['kualitas_video'];
                array_push($res['video'], $res_video);
            }

            $res['view'] = $data['view'];
            
            array_push($response, $res);
        }
    } else {
        $res['status_code'] = '304';
        $res['message'] = 'Error query, please check field';
        array_push($response, $res);
    }
} else {
    $res['status_code'] = '404';
    $res['message'] = 'No query action.';
    array_push($response, $res);
}

echo json_encode($response);

?>