<?php
//
$funcion = array();
// {block}
$funcion['id'][] = '{nocache}';
$funcion['texto'][] = "Ejemplo prueba nocache";
$funcion['enlace'][] = "http://www.smarty.net/docs/en/language.function.nocache.tpl";
//
$funcion['data'] = array();
for ($i=1 ; $i < 6; $i++){
$data = array();
$data['nombre'] = "Nombre {$i}";
$data['apellido'] = "Apellido {$i}";
$data['telefono'] = "0987654{$i}";
$data['email'] = "micorreo{$i}@correo.com";
//
$funcion['data'][] = $data;
}
//
$PAGE['funcion'] = $funcion;
?>