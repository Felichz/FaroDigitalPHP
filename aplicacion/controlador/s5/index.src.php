<?php

// ESTABLECEMOS LA PLANTILLA POR DEFECTO
$PAGE ['bodyContent'] ['html'] = file_exists ( "{$CONF['path']['tem']}/s5/{$PAGE['do']}.html" ) ? "s5/{$PAGE['do']}.html" : "s5/pv.html";

// DETERMINAMOS LA ACCION A EJECUTAR
if (isset($PAGE ['do']) && file_exists ( "{$CONF['path']['controlador']}/s5/{$PAGE['do']}.src.php" )) {
	require "{$CONF['path']['controlador']}/s5/{$PAGE['do']}.src.php";
}
else
{
	require "{$CONF['path']['controlador']}/s5/pv.src.php";
}

?>
