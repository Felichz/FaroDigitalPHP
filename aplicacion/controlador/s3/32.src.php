<?php
// CARGA DE CLASES
require_once "{$CONF['path']['librerias']}/dominio/db_usuario.class.php";
//
$oUO = new db_usuario();
//
$oUO->_oo = 'Data de prueba....';
//
$data = array();
$data['msg'][] = $oUO::VC;
$data['msg'][] = $oUO->_oo;
$data['msg'][] = $oUO->verPrivado('db');
$data['msg'][] = $oUO->verPrivado('conf');
$data['msg'][] = $oUO->verProtegido('lock');
//
$PAGE['data'] = $data;
?>