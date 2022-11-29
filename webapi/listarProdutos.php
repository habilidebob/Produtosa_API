<?php

    require_once('Model/Produto.class.php');

    $r = Produto::Listar();

    header('Content-Type: application/json; charset=utf-8');
    // Mostrar o resultado como json:
    echo json_encode($r);

?>