<?php

    require_once('Model/Categoria.class.php');

    $r = Categoria::Listar();

    header('Content-Type: application/json; charset=utf-8');
    // Mostrar o resultado como json:
    echo json_encode($r);

?>