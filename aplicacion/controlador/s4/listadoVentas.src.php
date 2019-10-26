<?php

if(isset($_REQUEST["limpiar"])) { header("Location: index.php?s=s4&do=listaVentas"); }

require_once "{$CONF['path']['librerias']}/pv/cliente.class.php";
require_once "{$CONF['path']['librerias']}/pv/venta.class.php";

$oVA = new venta();
$oCL = new cliente();

if($oVA->buscar())
{
	$ventas = $oVA->_oo["data"];
	// ORDENAR ARRAY DE VENTAS POR FECHA

	function comparar($a, $b)
	{
	    if ($a == $b) {
	        return 0;
	    }
	    return strtotime($a["fecha_venta"]) > strtotime($b["fecha_venta"]) ? -1 : 1;
	}

	usort($ventas, "comparar");
	
}

$fechaDesde = isset($_REQUEST["desde"]) ? strtotime($_REQUEST["desde"]) : 0;
$fechaHasta = isset($_REQUEST["hasta"]) ? strtotime($_REQUEST["hasta"]) : 0;

// Crear array con datos necesrios para mostrar
$i = 0;
$mayorVenta['monto'] = 0;
$mayorVenta['indice'] = 0;
foreach ($ventas as $k => $v) {
	if (strtotime($v["fecha_venta"]) > $fechaDesde && strtotime($v["fecha_venta"]) < $fechaHasta)
	{
		$listaVentas[$i]['id'] = $v["id"];
		$listaVentas[$i]['cliente'] = $oCL->buscar($v['id_cliente']);
		$listaVentas[$i]['monto'] = $v["total"]['monto'];
		$listaVentas[$i]['fecha'] = $v["fecha_venta"];
		$listaVentas[$i]['mayor'] = false;

		if($listaVentas[$i]['monto'] > $mayorVenta['monto'])
		{
			$mayorVenta['indice'] = $i;
			$mayorVenta['monto'] = $listaVentas[$i]['monto'];
		}

		$i ++;
	}
}

$PAGE['error'] = '';
if(isset($listaVentas))
{
	$listaVentas[$mayorVenta['indice']]['mayor'] = true;
	$PAGE['listaVentas'] = $listaVentas;
}
elseif ($fechaDesde > $fechaHasta) {
	$PAGE['error'] = "La primera fecha debe ser menor a la segunda";
}
elseif ($fechaDesde != 0 && $fechaHasta != 0) 
{
	$PAGE['error'] = "No se encontraron ventas";
}

?>

