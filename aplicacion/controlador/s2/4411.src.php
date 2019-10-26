<?php
//
$funcion = array();
// {block}
$funcion['id'][] = '{section}';
$funcion['texto'][] = "Ejemplo section";
$funcion['enlace'][] = "http://www.smarty.net/docs/en/language.function.section.tpl";
//
$funcion['data'] = array();
for ($i=1 ; $i < 6; $i++){
$data = array();
$data['nombre'] = "Nombre {$i}";
$data['apellido'] = "Apellido {$i}";
$data['celular'] = "0987654{$i}";
$data['email'] = "micorreo{$i}@correo.com";
//
$funcion['data'][] = $data;
}
//
$PAGE['funcion'] = $funcion;
?>