<?php

session_start();
include 'funciones/configuracion/config.php';

$eventos_destacados = obtener_eventos_destacados(3);

include 'pagina/index.view.php';
?>
