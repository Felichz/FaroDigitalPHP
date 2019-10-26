<?php

// ESTABLECEMOS LA PLANTILLA POR DEFECTO
$PAGE['bodyContent']['html'] =
file_exists("{$CONF['path']['tem']}/s3/{$PAGE['do']}.html") ? "s3/{$PAGE['do']}.html" :
"s3/index.html";

// DETERMINAMOS LA ACCION A EJECUTAR
if ( file_exists("{$CONF['path']['controlador']}/s3/{$PAGE['do']}.src.php")){
	require "{$CONF['path']['controlador']}/s3/{$PAGE['do']}.src.php";
}
