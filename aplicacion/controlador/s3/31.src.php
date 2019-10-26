<?php
// CARGA DE CLASES
require_once "{$CONF['path']['librerias']}/dominio/db_usuario.class.php";
//
$oUO = new db_usuario();
//
$data = array();
$data['msg'][] = $oUO->pruebaThis();
$data['msg'][] = db_usuario::pruebaThis();
//
$PAGE['data'] = $data;
?>