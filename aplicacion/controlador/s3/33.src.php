<?php
// CARGA DE CLASES
require_once "{$CONF['path']['librerias']}/dominio/db_usuario.class.php";
//
$data = array();
//
$oUOa = new db_usuario();
$data['msg'][] = $oUOa->_oo['msg'];
$oUOb = new db_usuario($CONF);
$data['msg'][] = $oUOb->_oo['msg'];
//
$PAGE['data'] = $data;
?>