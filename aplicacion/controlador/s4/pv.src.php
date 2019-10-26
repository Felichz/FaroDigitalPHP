<?php
session_start();
$_SESSION["venta_nueva"] = isset($_SESSION["venta_nueva"]) ? $_SESSION["venta_nueva"] : 0;
if ($_SESSION["venta_nueva"] > 0){
    $_SESSION["venta_nueva"] = 0;
    header("Location: index.php?s=s4&do=pv");
    exit();
}

// http://www.php.net/manual/en/timezones.america.php 
date_default_timezone_set('America/Montevideo');

// LLAMADO DE LIBRERIAS
require_once "{$CONF['path']['librerias']}/pv/cliente.class.php";
require_once "{$CONF['path']['librerias']}/pv/producto.class.php";
require_once "{$CONF['path']['librerias']}/pv/venta.class.php";

// DECLARACION DE OBJETOS
$oCL = new cliente();
$oPR = new producto();
$oVA = new venta();

// RECUPERAR VALORES DEL FORMULARIO
$idCliente = isset($_REQUEST['idCliente']) ? $_REQUEST['idCliente'] : null;
$accion = isset($_REQUEST['accion']) ? strtolower($_REQUEST['accion']) : null;

// GENERAR EL DETALLE DE VENTA
$total = array();
$total['descuento'] = 0;
$total['iva'] = 0;
$total['monto'] = 0;
//
$detalleVenta = array ();
if (isset($_REQUEST['producto'])){
    foreach ($_REQUEST['producto'] as $k => $v) {
        // INICIALIZAR LINEA DE DETALLE DE VENTA
        $detalleVenta[$k]['id'] = '';
        $detalleVenta[$k]['cantidad'] = 0;
        $detalleVenta[$k]['descripcion'] = null;
        $detalleVenta[$k]['monto'] = 0;
        $detalleVenta[$k]['stock'] = 0;
        $detalleVenta[$k]['importe'] = 0;
        // BUSCAR DETALLE DEL PRODUCTO
        if ($v > 0){
            //
            $detalleVenta[$k] = $oPR->buscar($v);
            $detalleVenta[$k]['cantidad'] = isset($_REQUEST['cantidad'][$k]) ?  $_REQUEST['cantidad'][$k] :  1;
            $detalleVenta[$k]['monto'] = $detalleVenta[$k]['cantidad'] * $detalleVenta[$k]['importe'];
            //
            $total['monto'] += $detalleVenta[$k]['monto'];
        }
    }
}

// GENERAR EL PULLDOWN DE CLIENTE
$oCL->pullDown($idCliente);

// PASAR VALORES A LA PLANTILLA
$PAGE['cliente']['pulldown'] = $oCL->_oo['html'];
$PAGE['cliente']['data'] = $oCL->buscar($idCliente);

// CALCULO DEL DESCUENTO POR ANTIGUEDAD
if (isset($PAGE['cliente']['data']['antiguedad'])){
    if ($PAGE['cliente']['data']['antiguedad'] > 20){
        $total['descuento'] = 0.07;
    } elseif ($PAGE['cliente']['data']['antiguedad']> 10){
        $total['descuento'] = 0.05;
    }
}

// CALCULO DE TOTAL VENTA
$total['descuento'] = $total['monto'] * $total['descuento'];
$total['monto']  = $total['monto'] - $total['descuento'];
$total['iva'] = $total['monto'] * 0.22;
$total['monto'] = $total['monto'] * 1.22;

//
$PAGE['producto'] = $oPR;
$PAGE['detalleVenta'] = $detalleVenta;
$PAGE['total'] = $total;

// DETERMINAR ACCION
$msg = '';
switch ($accion){
    case 'procesar':
        $venta = array();
        //
        $venta['id'] = mktime() . "_{$idCliente}";
        $venta['fecha_venta'] = date('Y-m-d H:i:s');
        $venta['id_cliente'] = $idCliente;
        $venta['detalle_venta'] = $detalleVenta;
        $venta['total'] = $total;
        
        // PROCESAR VENTA
        $procesado = array();
        try {
            // DESCONTAR INVENTARIO
            foreach ($detalleVenta as $item){
                if ($item['cantidad'] > $item['stock']){
                    throw new Exception("Inventario de producto {$item['nombre']}:: insuficiente");
                } else {
                    //
                    $producto = $oPR->buscar($item['id']);
                    if ($oPR->_oo['ok']){
                        $producto['stock'] = $producto['stock'] - $item['cantidad'];
                        if ($oPR->modificar($producto) == false){
                            throw new Exception("Producto {$item['nombre']} :: {$oPR->_oo['msg']}");
                        } else {
                            $procesado[] = $item;
                        }
                    } else {
                        throw new Exception("Producto {$item['nombre']} :: {$oPR->_oo['msg']}");
                    }
                    //
                }
            }
            // GUARDANDO LA VENTA
            if ($oVA->agregar($venta)){
                //var_dump($venta);
                $_SESSION["venta_nueva"] = 1;
                header("Location: ?s=s4&do=factura&id={$venta['id']}");
                exit();                
            } else {
                throw new Exception("{$oVA->_oo['msg']}");
            }
            //            
        } catch (Exception $e) {
            // REVERTIR VENTA
            //
            var_dump("{$e->getMessage()}");
            //
        }
       
        break;
        
    default:
    
}


?>
