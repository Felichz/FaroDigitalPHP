<?php
// PARAMETROS DE LA PLANTILLA
$PAGE = array();
$PAGE['template'] = "por_defecto/index.html";
$PAGE['header']['html'] = "por_defecto/header.html";
$PAGE['body']['html'] = "por_defecto/body.html";
$PAGE['bodyContent']['html'] = "por_defecto/body_content.html";
$PAGE['footer']['html'] = "por_defecto/footer.html";
//
$PAGE['header']['desc'] = "CURSO PHP AVANZADO :: APLICACION DE EJEMPLO";
$PAGE['header']['autor'] = "FARO DIGITAL (info@farodigital.net.uy)";
$PAGE['header']['titulo'] = "PRACTICA PHP AVANZADO";
// CONTROLADOR PRINCIPAL
$PAGE['s'] = isset($_GET['s']) ? strtolower($_GET['s']) : null;
$PAGE['do'] = isset($_GET['do']) ? strtolower($_GET['do']) : null;
//

if( isset($PAGE['s']) && file_exists("{$CONF['path']['controlador']}/{$PAGE['s']}/index.src.php"))
{
	require "{$CONF['path']['controlador']}/{$PAGE['s']}/index.src.php";
}
else
{
	$PAGE['bodyContent']['html'] = "inicio.html";
}

// Elemento del menu que está seleccionado (Esto se usa en el index.html de la plantilla por defecto)
switch ($PAGE['s']){
case "s2":
	$PAGE['navSelected'] = 2;
break;
case "s3":
	$PAGE['navSelected'] = 3;
break;
case "s4":
	$PAGE['navSelected'] = 4;
break;
case "s5":
	$PAGE['navSelected'] = 5;
break;
default:
	$PAGE['navSelected'] = 1;
break;	
}
// REGISTRO DE LOS PARAMETROS DE LA PLANTILLA
require_once "{$CONF['path']['librerias']}/util/smarty/Smarty.class.php";
//
$smarty = new Smarty();
$smarty->template_dir = "{$CONF['path']['tem']}";
$smarty->compile_dir = "{$CONF['path']['loc']}/vistas/plantillas_c";
$smarty->cache_dir = "{$CONF['path']['loc']}/vistas/cache";
$smarty->config_dir = "{$CONF['path']['loc']}/vistas/config";
$smarty->plugins_dir = array(
"{$CONF['path']['librerias']}/util/smarty/plugins",
"{$CONF['path']['librerias']}/util/smarty/sysplugins"
);
$smarty->compile_check = true;
$smarty->debugging = false;
//$smarty->debugging = true;
$smarty->force_compile = true;
$smarty->caching = false;
$smarty->compile_check = true;
$smarty->php_handling = true;
$smarty->cache_lifetime = -1;
//
$smarty->assign('CONF', $CONF);
$smarty->assign('PAGE', $PAGE);
//
$smarty->display($PAGE['template']);

if ($PAGE['s']=='s2' && $PAGE['do']=='450') {
	require $CONF['path']['loc'].'/controlador/index.js.php';
}
?>