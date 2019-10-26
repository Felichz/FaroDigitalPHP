<?php
// Carga de clases 
require_once $CONF['path']['librerias'].'/producto.class.php'; 
require_once $CONF['path']['librerias'].'/cliente.class.php';

// Incializacion de variables 
$accion = isset($_REQUEST['accion']) ? $_REQUEST['accion'] : null;
$_REQUEST['idCliente'] = isset($_REQUEST['idCliente']) ? $_REQUEST['idCliente'] : null;
//

$oPR = new producto();
$oCL = new cliente();

//
$cliente = array();
$cliente['direccion'] = '';
$cliente['celular'] = '';
$cliente['email'] = '';
$cliente['antiguedad'] = '';
$cliente['descuento'] = '';

// Determinamos que hacer validando el botón de acción
switch ($accion){
	case 'Cancelar':
		header("Location: index.php?s=s2&do=450");
		exit();
		break;

	case 'Procesar':
		//var_dump($_REQUEST);		
		break;
		
	default:

}

// Construir el pullDown de clientes
$oCL->pullDown($_REQUEST['idCliente']);
$pullDownCL = $oCL->_oo['html'];
// Existe el cliente por Id
if (isset($oCL->_oo['res']['id'])){
	$cliente = $oCL->_oo['res'];
}

// Construir el pullDown de productos
$oPR->pullDown();

// Funciones 
function pdCantidad ($p = NULL, $s = 20){
	$stock = $s;

	if($p > $s)
	{
		$p = $s;
	}

	$out = "";
	for ($i=1; $i<= $stock; $i++){
		$default = ($p == $i) ? 'selected' : '';
		$out .= "<option value='{$i}' {$default}>{$i}</option>";
	}
	return "<select onchange='this.form.submit()' name='cantidad[]' required>{$out}</select>";
}

//Productos
$subtotal = 0;
$total = 0;
$descuento = 0;
$descontado = 0;
$iva = 0;

if (isset($_REQUEST['producto'])){
    $ct = count ($_REQUEST['producto']);                
    for ($i=0; $i<$ct; $i++){
        $_REQUEST['cantidad'][$i] = isset($_REQUEST['cantidad'][$i]) ? $_REQUEST['cantidad'][$i] : 1;
        $producto = array();
        $producto['nombre'] = '';
        $producto['descripcion'] = '';
        $producto['importe'] = '';
        $producto['stock'] = '';
        $producto['monto'] = ''; //
        $producto['cantidad'] = '<input type="hidden" name="cantidad[]" value="1"/>'; //
        //
        $oPR->pullDown($_REQUEST['producto'][$i]);
        $producto['pullDown'] = $oPR->_oo['html'];

        if($_REQUEST['producto'][$i] != 0)
        {
            // Existe el cliente por Id
            if (isset($oPR->_oo['res']['id'])){
                $producto = array_merge($producto, $oPR->_oo['res']);
                //producto = $oPR->_oo['res'];
            }
            //
            $monto = $producto['importe'] * $_REQUEST['cantidad'][$i];
            $producto['monto'] = number_format($monto, 2);
            
            // Calculo subtotal
            $subtotal = $subtotal + $monto;

            $producto['importe'] = number_format($producto['importe'], 2);
            //
            $producto['cantidad'] = pdCantidad($_REQUEST['cantidad'][$i], $producto['stock']);
        }
        
        //$producto['fila'] = $i;
        $productos[] = $producto;

    }

    // Calcular descuento del cliente
    if(!$_REQUEST['idCliente'] == null)
    {
        if($cliente["antiguedad"] >= 11)
        {
            $descuento = 0.05;
        }

        if($cliente["antiguedad"] >=21)
        {
            $descuento = 0.07;
        }

        $descuento = $descuento + $cliente["descuento"] / 100;

        if($descuento < 0.05)
        {
        	$descuento = 0.05;
        }
    }
    $descontado = $subtotal * $descuento;

    //Descontar al subtotal
    $subtotal = $subtotal - $descontado;
    //Calcular iva
    $iva = $subtotal * 0.22;
    $total = $subtotal + $iva;
    
}


// Pasar datos para smarty
$PAGE["cliente"] = $cliente;
$PAGE["pullDownCL"] = $pullDownCL;
$PAGE['productos'] = isset($productos) ? $productos : '';

$PAGE['descuento'] = isset($descuento) ? number_format($descontado, 2) . " (" . $descuento * 100 . "%)" : '';
$PAGE['iva'] = isset($iva) ? number_format($iva, 2) : '';
$PAGE['total'] = isset($total) ? number_format($total, 2) : '';
?>