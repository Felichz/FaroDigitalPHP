<?php
// DECLARACION DE LA CLASE PERSONA
class persona {
var $_nombre;
var $_apellido;
var $_lugarNacimiento;
var $_celular;
var $_telefono;
var $_email;
//
public function __construct($p = null) {
try {
	foreach ($p as $k => $v){
		$this->{"_{$k}"} = $v;
	}
} catch (Exception $e) {
	echo 'Excepcion capturada: ', $e->getMessage(), "\n";
}
}
public function nombreCompleto() {
try {
return "{$this->_nombre} {$this->_apellido}";
} catch (Exception $e) {
echo 'Excepcion capturada: ', $e->getMessage(), "\n";
}
}
}
//
$persona = array ();
$persona['nombre'] = 'Mi nombre';
$persona['apellido'] = 'Mi apellido';
$persona['lugarNacimiento'] = 'Rocha, Uruguay';
$persona['celular'] = '09876543';
$persona['telefono'] = '44729876';
$persona['email'][] = 'email1@tucorreo.com';
$persona['email'][] = 'email2@tucorreo.com';
//
$oPA = new persona ($persona);
//
$PAGE['persona'] = $oPA;
?>
