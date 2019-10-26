<?php

// LLAMADO DE LIBRERIAS
require_once "{$CONF['path']['librerias']}/pv2/cliente.class.php";
require_once "{$CONF['path']['librerias']}/pv2/venta.class.php";

// DECLARACION DE OBJETOS
$oVA = new venta();
$oCL = new cliente();

// RECUPERAR VALORES DEL FORMULARIO
$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;

if ($id == null){
    header("Location: index.php?s=s5&do=pv");
    exit();
}

// RECUPERAR LOS DATOS DE LA VENTA
$data = array();
$PAGE['venta']['ok'] = 0;
$PAGE['cliente']['data'] = array();
$PAGE['detalleVenta'] = array();
$PAGE['total'] = array();

$data = $oVA->cargarVentas($id);
if($data != false)
{
	$PAGE['venta']['ok'] = 1;
}
else
{
	$PAGE['venta']['ok'] = 0;
}

//Datos de la venta
$PAGE['venta']['id'] = $data['id'];
$PAGE['venta']['fecha_venta'] = $data['fecha_venta'];
$PAGE['venta']['descuento'] = $data['descuento'];
$PAGE['venta']['iva'] = $data['iva'];
$PAGE['venta']['monto'] = $data['monto'];

//Datos de los detalles de venta
$PAGE['detalleVenta'] = $data['detalle_venta'];

$PAGE['cliente']['data'] = $oCL->buscar($data['id_cliente']);
?>
