<?php
include "../config/config.php";
if (isset($_POST['action'])) {
    
    if ($_POST['action']=="add") {
        if (isset($_POST['name'])) {
            $name = $_POST['name'];
            $name_seo = convert_seo($name);

            $query = $mysqli->query("INSERT INTO cflix_kualitas 
                (
                    name,
                    name_seo
                )
                VALUES
                (
                    '$name',
                    '$name_seo'
                )
            ");
            if ($query) {
                $response = array();
                $res['status_code'] = '200';
                $res['message'] = 'Success add kualitas.';
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
            $res['status_code'] = '304';
            $res['message'] = 'Error query, please check field';
            array_push($response, $res);
            echo json_encode($response);
        }
    } elseif ($_POST['action']=="edit") {
        if (isset($_POST['id'])) {
            $cek_query = $query = $mysqli->query("SELECT * FROM cflix_kualitas WHERE id='$_POST[id]' ");
            $cek = $cek_query->num_rows;
            if ($cek>0) {
                if (isset($_POST['name'])) {
                    $name = $_POST['name'];
                    $name_seo = convert_seo($name);

                    $query = $mysqli->query("UPDATE cflix_kualitas SET
                        name = '$name',
                        name_seo = '$name_seo'

                        WHERE id = '$_POST[id]'
                    ");

                    if ($query) {
                        $response = array();
                        $res['status_code'] = '200';
                        $res['message'] = 'Success edit kualitas.';
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
                    $res['status_code'] = '304';
                    $res['message'] = 'Error query, please check field';
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
            $query = $mysqli->query("DELETE FROM cflix_kualitas WHERE id = '$_POST[id]' ");
            if ($query) {
                $response = array();
                $res['status_code'] = '200';
                $res['message'] = 'Success delete kualitas. ' . var_dump($query);
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
        $query = $mysqli->query("SELECT * FROM cflix_kualitas ");

        $response = array();
        $response['data'] = array();
        while ($data = $query->fetch_array()) {
            
            $res['status_code'] = '200';
            $res['id'] = $data['id'];
            $res['name'] = $data['name'];
            $res['name_seo'] = $data['name_seo'];

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