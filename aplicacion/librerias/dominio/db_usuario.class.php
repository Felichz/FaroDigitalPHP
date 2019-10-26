<?php
//inicio clase db_usuario
class db_usuario {
// DECLARATIVA DE ATRIBUTOS
public $_oo = array();
const VC = 'valor constante';
private $_db = null, $_conf = null;
protected $_lock = 'parametros protegidos';
// DECLARATIVA DE FUNCIONES
public function __construct($p = null) {
//
$this->_oo['ok'] = true;
$this->_oo['msg'] = '';
$this->_oo['data'] = array();
//
try {
if (is_array($p)){
$this->_conf = $p;
} else {
throw new Exception('Falta parametro de configuracion');
}
//
$this->_oo['msg'] = "Objeto creado";
//
} catch (Exception $e) {
$this->_oo['msg'] = "ERROR: " . $e->getMessage();
$this->_oo['ok'] = false;
} finally {
return $this->_oo['ok'];
}
}
public function __destruct() {
$msg = '';
try {
//$msg = 'Objeto liberado ';
} catch (Exception $e) {
$msg = "ERROR: " . $e->getMessage();
} finally {
echo "{$msg}";
return $msg;
}
}
public function pruebaThis() {
$msg = '';
if (isset($this)) {
$msg = '$this est&aacute; definida ('. get_class($this) . ')';
} else {
$msg = "\$this no est&aacute; definida";
}
//
return $msg;
}
public function verPrivado($p = null) {
$msg = '';
//
switch ($p){
case 'db':
case 'conf':
$msg = $this->{"_{$p}"};
break;
default:
}
//
return $msg;
}
public function verProtegido($p = null) {
$msg = '';
//
switch ($p){
case 'lock':
$msg = $this->{"_{$p}"};
break;
default:
}
//
return $msg;
}
}
//fin clase db_usuario
?>