<?php

// ESTABLECEMOS LA PLANTILLA POR DEFECTO
$PAGE['bodyContent']['html'] =
file_exists("{$CONF['path']['tem']}/s2/{$PAGE['do']}.html") ? "s2/{$PAGE['do']}.html" :
"s2/index.html";

// DETERMINAMOS LA ACCION A EJECUTAR
if ( file_exists("{$CONF['path']['controlador']}/s2/{$PAGE['do']}.src.php")){
	require "{$CONF['path']['controlador']}/s2/{$PAGE['do']}.src.php";
}

?>