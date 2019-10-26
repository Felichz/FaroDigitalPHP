<?php

if (isset($_REQUEST["limpiar"]))
{
	header("Location: index.php?s=s5&do=listaVentas");
}

require_once "{$CONF['path']['librerias']}/pv2/cliente.class.php";
require_once "{$CONF['path']['librerias']}/pv2/venta.class.php";

$oVA = new venta();
$ventas = $oVA->cargarVentas();

// Guardar productos vendidos en un solo arreglo
$productos = array();
$i = 0;

foreach($ventas as $k => $v)
{
	foreach($v['detalle_venta'] as $q => $b)
	{

		// Buscamos si el producto ya está guardado en el array por otra venta
		$claveProducto = array_search($b["id"], array_column($productos, 'id'));
		if ($claveProducto === FALSE)
		{
			$productos[$i]['id'] = $b['id'];
			$productos[$i]['descripcion'] = $b['descripcion'];
			$productos[$i]['cantidad'] = $b['cantidad'];
			$i++;
		}
		else
		{
			$productos[$claveProducto]['cantidad']+= $b['cantidad'];
		}
	}
}

// Ordenar productos por cantidad vendida
function comparar($a, $b)
{
	if ($a == $b)
	{
		return 0;
	}

	return $a['cantidad'] > $b['cantidad'] ? -1 : 1;
}

// usort — Ordena un array según sus valores usando una función de comparación definida por el usuario
usort($productos, "comparar");

// Establecer resaltados
foreach($productos as $k => $v)
{
	if ($k < 10)
	{
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