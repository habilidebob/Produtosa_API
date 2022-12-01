<?php

header('Content-Type: application/json; charset=utf-8');

// Array de status:
$status = ['status' => 0, 'msg' => ''];

session_start();

if(!isset($_SESSION['infos'])){
    $status['msg'] = "Você não está logado(a)";
    echo json_encode($status);
}else{
    $status['status'] = 1;
    $status['msg'] = "Você está logado(a)";
    array_push($status, $_SESSION['infos']);
    echo json_encode($status);
}


?>