<?php

// ESTABLECEMOS LA PLANTILLA POR DEFECTO
$PAGE ['bodyContent'] ['html'] = file_exists ( "{$CONF['path']['tem']}/s4/{$PAGE['do']}.html" ) ? "s4/{$PAGE['do']}.html" : "s4/pv.html";

// DETERMINAMOS LA ACCION A EJECUTAR
switch ($PAGE ['do']) {
	default :
		if (file_exists ( "{$CONF['path']['controlador']}/s4/{$PAGE['do']}.src.php" )) {
			require "{$CONF['path']['controlador']}/s4/{$PAGE['do']}.src.php";
		}
		else
		{
			require "{$CONF['path']['controlador']}/s4/pv.src.php";
		}
		break;
}

?>
