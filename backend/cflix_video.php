<?php
include "../config/config.php";
if (isset($_POST['action'])) {
    
    if ($_POST['action']=="add") {
        $label = $_POST['label'];
        $url_video = $_POST['url_video'];
        $kualitas = $_POST['kualitas'];
        
        $query = $mysqli->query("INSERT INTO cflix_video 
            (
                label,
                url_video,
                kualitas
            )
            VALUES
            (
                '$label',
                '$url_video',
                '$kualitas'
            )
        ");
        if ($query) {
            $response = array();
            $res['status_code'] = '200';
            $res['message'] = 'Success add video.';
            array_push($response, $res);
            echo json_encode($response);
        } else {
            $response = array();
            $res['status_code'] = '300';
            $res['message'] = 'Failed, '.$mysqli->error;
            array_push($response, $res);
            echo json_encode($response);
        }
    } elseif ($_POST['action']=="edit") {
        if (isset($_POST['id'])) {
            $cek_query = $query = $mysqli->query("SELECT * FROM cflix_video WHERE id='$_POST[id]' ");
            $cek = $cek_query->num_rows;
            if ($cek>0) {
                $label = $_POST['label'];
                $url_video = $_POST['url_video'];
                $kualitas = $_POST['kualitas'];

                $query = $mysqli->query("UPDATE cflix_video SET
                    label = '$label',
                    url_video = '$url_video',
                    kualitas = '$kualitas'

                    WHERE id = '$_POST[id]'
                ");

                if ($query) {
                    $response = array();
                    $res['status_code'] = '200';
                    $res['message'] = 'Success edit video.';
                    array_push($response, $res);
                    echo json_encode($response);
                } else {
                    $response = array();
                    $res['status_code'] = '300';
                    $res['message'] = 'Failed, '.$mysqli->error;
                    array_push($response, $res);
                    echo json_encode($response);
                }
                
            } else {
                $response = array();
                $res['status_code'] = '302';
                $res['message'] = 'Error query, nothing to edit';
                array_push($response, $res);
                echo json_encode($response);
            }
        } else {
            $response = array();
            $res['status_code'] = '302';
            $res['message'] = 'Error query, nothing to edit';
            array_push($response, $res);
            echo json_encode($response);
        }
    } elseif ($_POST['action']=="delete") {
        if (isset($_POST['id'])) {
            $query = $mysqli->query("DELETE FROM cflix_video WHERE id = '$_POST[id]' ");
            if ($query) {
                $response = array();
                $res['status_code'] = '200';
                $res['message'] = 'Success delete video. ' . var_dump($query);
                array_push($response, $res);
                echo json_encode($response);
            } else {
                $response = array();
                $res['status_code'] = '300';
                $res['message'] = 'Failed, '.$mysqli->error;
                array_push($response, $res);
                echo json_encode($response);
            }
        } else {
            $response = array();
            $res['status_code'] = '302';
            $res['message'] = 'Error query, nothing to delete';
            array_push($response, $res);
            echo json_encode($response);
        }
    } elseif ($_POST['action']=="show") {
        $query = $mysqli->query("SELECT * FROM cflix_video ");

        $response = array();
        $response['data'] = array();
        while ($data = $query->fetch_array()) {
            
            $res['status_code'] = '200';
            $res['id'] = $data['id'];
            $res['label'] = $data['label'];
            $res['url_video'] = $data['url_video'];
            $res['kualitas'] = $data['kualitas'];

            array_push($response['data'], $res);
        }
        echo json_encode($response);
    } else {
        $response = array();
        $res['status_code'] = '404';
        $res['message'] = 'No query action.';
        array_push($response, $res);
        echo json_encode($response);
    }
    
} else {
    $response = array();
    $res['status_code'] = '404';
    $res['message'] = 'No query action.';
    array_push($response, $res);
    echo json_encode($response);
}
?>