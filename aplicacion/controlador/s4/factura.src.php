<?php

// LLAMADO DE LIBRERIAS
require_once "{$CONF['path']['librerias']}/pv/cliente.class.php";
require_once "{$CONF['path']['librerias']}/pv/venta.class.php";

// DECLARACION DE OBJETOS
$oVA = new venta();
$oCL = new cliente();

// RECUPERAR VALORES DEL FORMULARIO
$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;

if ($id == null){
    header("Location: index.php?s=s4&do=pv");
    exit();
}

// RECUPERAR LOS DATOS DE LA VENTA
$data = array();
$PAGE['venta']['ok'] = 0;
$PAGE['cliente']['data'] = array();
$PAGE['detalleVenta'] = array();
$PAGE['total'] = array();
//
if ($oVA->buscar($id)){
    //
    if (isset($oVA->_oo['data']["{$id}"])) {
        $data =  $oVA->_oo['data']["{$id}"];
        $PAGE['venta']['ok'] = 1;
        //
        $PAGE['venta']['id'] = $data['id'];
        $PAGE['venta']['fecha_venta'] = $data['fecha_venta'];
        $PAGE['cliente']['data'] = $oCL->buscar($data['id_cliente']);
        $PAGE['detalleVenta'] = $data['detalle_venta'];
        $PAGE['total'] = $data['total'];
        //
    } 
    //
}


?>
