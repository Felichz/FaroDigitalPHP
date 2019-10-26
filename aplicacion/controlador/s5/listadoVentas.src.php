<?php

if (isset($_REQUEST["limpiar"]))
{
	header("Location: index.php?s=s5&do=listaVentas");
}

require_once "{$CONF['path']['librerias']}/pv2/cliente.class.php";
require_once "{$CONF['path']['librerias']}/pv2/venta.class.php";

$oVA = new venta();
$oCL = new cliente();
$ventas = $oVA->cargarVentas();

// ORDENAR ARRAY DE VENTAS POR FECHA
// strtotime — Convierte una descripción de fecha/hora textual en Inglés a una fecha Unix
function comparar($a, $b)
{
	$a = strtotime($a["fecha_venta"]);
	$b = strtotime($b["fecha_venta"]);

	if ($a == $b)
	{
		return 0;
	}

	return $a > $b ? -1 : 1;
}

$fechaDesde = isset($_REQUEST["desde"]) ? strtotime($_REQUEST["desde"]) : 0;
$fechaHasta = isset($_REQUEST["hasta"]) ? strtotime($_REQUEST["hasta"]) : 0;

// Crear array con datos necesrios para mostrar

$i = 0;
$mayorVenta['monto'] = 0;
$mayorVenta['indice'] = 0;

// usort — Ordena un array según sus valores usando una función de comparación definida por el usuario
usort($ventas, "comparar");

foreach($ventas as $k => $v)
{
	$fechaVenta = strtotime($v['fecha_venta']);
	if ($fechaVenta > $fechaDesde && $fechaVenta < $fechaHasta)
	{
		$listaVentas[$i]['id'] = $v["id_documento"];
		$listaVentas[$i]['cliente'] = $oCL->buscar($v['id_cliente']);
		$listaVentas[$i]['monto'] = $v['monto'];
		$listaVentas[$i]['fecha'] = $v["fecha_venta"];
		$listaVentas[$i]['mayor'] = false;
		if ($listaVentas[$i]['monto'] > $mayorVenta['monto'])
		{
			$mayorVenta['indice'] = $i;
			$mayorVenta['monto'] = $listaVentas[$i]['monto'];
		}

		$i++;
	}
}

$PAGE['error'] = '';

if (isset($listaVentas))
{
	$listaVentas[$mayorVenta['indice']]['mayor'] = true;
	$PAGE['listaVentas'] = $listaVentas;
}
elseif ($fechaDesde > $fechaHasta)
{
	$PAGE['error'] = "La primera fecha debe ser menor a la segunda";
}
elseif ($fechaDesde != 0 && $fechaHasta != 0)
{
	$PAGE['error'] = "No se encontraron ventas";
}

?>