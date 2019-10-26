<?php

if(isset($_REQUEST["limpiar"])) { header("Location: index.php?s=s4&do=listaVentas"); }

require_once "{$CONF['path']['librerias']}/pv/cliente.class.php";
require_once "{$CONF['path']['librerias']}/pv/venta.class.php";

$oVA = new venta();

if($oVA->buscar())
{
	$ventas = $oVA->_oo["data"];
}

// Guardar productos vendidos en un solo arreglo
$productos = array();
$i = 0;
foreach ($ventas as $k => $v) {
	//var_dump($v);
	//echo "<br/><br/>";
	foreach ($v['detalle_venta'] as $q => $b) {
		//Buscamos si el producto ya está guardado en el array por otra venta
		$claveProducto = array_search($b["id"], array_column($productos, 'id'));

		if ($claveProducto === FALSE)
		{
			$productos[$i]['id'] = $b['id'];
			$productos[$i]['descripcion'] = $b['descripcion'];
			$productos[$i]['cantidad'] = $b['cantidad'];
			$i ++;
		}
		else
		{
			$productos[$claveProducto]['cantidad'] += $b['cantidad'];
		}
	}
}

//Ordenar productos por cantidad vendida
function comparar($a, $b)
	{
	    if ($a == $b) {
	        return 0;
	    }
	    return $a['cantidad'] > $b['cantidad'] ? -1 : 1;
	}

	usort($productos, "comparar");

//Establecer resaltados
foreach ($productos as $k => $v) {
	if ($k < 10) {
		$productos[$k]['resaltado'] = 2;
	}
	else
	{
		$productos[$k]['resaltado'] = 0;
	}
}
$productos[0]['resaltado'] = 1;

$PAGE['productos'] = $productos;
?>