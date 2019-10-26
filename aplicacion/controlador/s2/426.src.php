<?php
//
$seccion = array ();
$seccion['titulo'][] = "Solicitud de Variables";
$seccion['descripcion'][] = "La solicitud de variables como \$_GET, \$_POST, \$_COOKIE,
\$_SERVER, \$_ENV y \$_SESSION";
//
$seccion['titulo'][] = "{\$smarty}";
$seccion['descripcion'][] = "El timestamp actual puede ser accesado con {\$smarty.now}.
El n&uacute;mero refleja el n&uacute;mero de segundos pasados desde la llamada Epoca (1
de Enero de 1970) y puede ser pasado directamente para el modificador date_format para
mostrar la fecha";
//
$PAGE['seccion'] = $seccion;
?>