<?php
// ARREGLO DE PARAMETROS PARA CONFIGURACION
$CONF = array ();
// RUTA Y DIRECTORIOS
//$CONF['path']['loc'] = "C:/xampp/htdocs/curso_php";
$CONF['url']['base'] = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . '/';
$CONF['path']['loc'] = dirname(__DIR__);
//
$CONF['path']['controlador'] = "{$CONF['path']['loc']}/controlador";
$CONF['path']['librerias'] = "{$CONF['path']['loc']}/librerias";
$CONF['path']['db'] = "{$CONF['path']['loc']}/db";
$CONF['path']['modelo'] = "{$CONF['path']['loc']}/modelo";
$CONF['path']['etc'] = "{$CONF['path']['loc']}/configuracion";
$CONF['path']['log'] = "{$CONF['path']['loc']}/log";
$CONF['path']['dat'] = "{$CONF['path']['loc']}/dat";
$CONF['path']['tem'] = "{$CONF['path']['loc']}/vistas/plantillas";
// URL Y RECURSOS WEB
$CONF['url']['base'] = "http://127.0.0.1:81/curso_php";
$CONF['url']['img'] = "{$CONF['url']['base']}/img";
$CONF['url']['css'] = "{$CONF['url']['base']}/css";
$CONF['url']['jss'] = "{$CONF['url']['base']}/jss";

// BASES DE DATOS

// Punto de venta
	// BD Remota de prueba
	$CONF['db']['puntoventa']['user'] = "b460a73cc837b4";
	$CONF['db']['puntoventa']['pw'] = "74eea4b6";
	$CONF['db']['puntoventa']['host'] = "us-cdbr-east-02.cleardb.com";
	$CONF['db']['puntoventa']['nombre'] = "heroku_bccd4c9c7898550";
	

	// localhost
	/*
	$CONF['db']['puntoventa']['user'] = "root";
	$CONF['db']['puntoventa']['pw'] = "12345";
	$CONF['db']['puntoventa']['host'] = "localhost:3306";
	$CONF['db']['puntoventa']['nombre'] = "pv2";
	*/
?>