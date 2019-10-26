<?php

class producto {
    var $_oo;
    
    public function __construct($p = null) {
        //
        global $CONF;
        //        
        try {
            $this->_oo = array();
            $this->_oo['data'] = array();
            $this->_oo['ok'] = true;
            $this->_oo['msg'] = '';
            $this->_oo['file'] = "{$CONF['path']['dat']}/pv/productos.csv";
        } catch (Exception $e) {
            $this->_oo['msg'] = "ERROR: " . $e->getMessage();
            $this->_oo['ok'] = false;
        }
        return $this->_oo['ok'];
    }// FIN __construct
    
    public function cargar(){
        $this->_oo['msg'] = "";
        $this->_oo['ok'] = true;
        //
        try {
            $this->_oo['data'] = array();
            //
            if (($fh = @fopen($this->_oo['file'], "r")) !== FALSE) {
                //
                while (($fila = fgetcsv($fh, 4096, ";")) !== FALSE) {
                    $linea = array();
                    //
                    foreach ($fila as $key => $value) {
                        switch ($key){
                            case 0:
                                $linea['id'] = $value;
                                break;
                                
                            case 1:
                                $linea['nombre'] = $value;
                                break;
                                
                            case 2:
                                $linea['descripcion'] = $value;
                                break;
                                
                            case 3:
                                $linea['importe'] = $value;
                                break;
                                
                            case 4:
                                $linea['stock'] = $value;
                                break;
                                
                            default:
                        }
                    }
                    $this->_oo['data'][] = $linea;
                }
                //
                fclose($fh);
                //
            }
            //
        } catch (Exception $e) {
            $this->_oo['msg'] = "ERROR: " . $e->getMessage();
            $this->_oo['ok'] = false;
        }
        //
        return $this->_oo['ok'];
    }// FIN cargar
    
    // FUNCION modificar
    function modificar($p=null){
        //
        $this->_oo['msg'] = "";
        $this->_oo['ok'] = true;
        $this->_oo['data'] = array();
        //
        try {
            if (isset($p['id']) == false){
                throw new Exception("id de invalido");
            }
            //
            $archivo = @fopen("{$this->_oo['file']}", "c+");
            $data = array();
            $contenido = '';
            //
            if ($archivo) {
                while (($linea = fgets($archivo, 4096)) !== false) {
                    //
                    $data = explode(';', $linea);
                    
                    // PRODUCTO COINCIDE
                    if ($p['id'] == $data[0]){                        
                        // ACTUALIZANDO STOCK
                        if (isset($p['stock'])){
                            if ($p['stock'] < 0){
                                throw new Exception("Stock insuficiente");
                            } else {
                                $data[4] = $p['stock'];
                             }
                        }
                        //
                        $contenido .= implode(";", $data) . "\n";
                    } else {
                        $contenido = "{$contenido}{$linea}";
                    }                   
                    //
                }
                if (!feof($archivo)) {
                    throw new Exception("No se pudo leer el archivo");
                }
                fclose($archivo);
                //
                if (file_put_contents($this->_oo['file'], $contenido) == false){
                    throw new Exception("No se pudo guardar modificacion");
                }
                //
                $this->_oo['ok'] = true;
                $this->_oo['msg'] = 'Registro modificado';
                
            } else {
                throw new Exception("No se pudo abrir el archivo");
            }
            //
        } catch (Exception $e) {
            $this->_oo['msg'] = "ERROR: " . $e->getMessage();
            $this->_oo['ok'] = false;
        }
        //
        return $this->_oo['ok'];
    }
    // FIN FUNCION modificar
    
    
    // FUNCION buscar
    function buscar($p=null){
        $salida = array();
        $salida['id'] = '';
        $salida['nombre'] = '';
        $salida['descripcion'] = '';
        $salida['importe'] = '';
        $salida['stock'] = '';
        //
        try {
            // CARGAR DATOS DE LOS CLIENTES
            if ($this->cargar()){
                // BUSCAR POR DATOS DEL CLIENTE
                foreach ($this->_oo['data'] as $k => $v){
                    // VALIDAMOS SI EL ID DEL CLIENTE ES VALIDO
                    if ($v['id'] == $p) {
                        $salida = $v;
                        break;
                    }
                    //
                }
            }
        } catch (Exception $e) {
            $this->_oo['msg'] = "ERROR: " . $e->getMessage();
            $this->_oo['ok'] = false;
        }
        //
        return $salida;
    }
    // FIN FUNCION buscar
    
    public function pullDown($p = null){
        $this->_oo['html'] = '';
        $this->_oo['res'] = array();
        $this->_oo['ok'] = true;
        $out = "<option value=''></option>";
        //
        try {
            if ($this->cargar()){
                foreach ($this->_oo['data'] as $k => $v){
                    $sel = '';
                    if ($v['id'] == $p) {
                        $this->_oo['res'] =$v;
                        $this->_oo['ok'] = true;
                        $sel = 'selected';
                    }
                    //
                    $out .= "<option value='{$v['id']}' {$sel}>{$v['nombre']} ({$v['stock']})</option>";
                }
                $this->_oo['html'] = "<select onchange='this.form.submit()' name='producto[]' required>{$out}</select>";
            }
        } catch (Exception $e) {
            $this->_oo['msg'] = "ERROR: " . $e->getMessage();
            $this->_oo['ok'] = false;
        }
        //
        return $this->_oo['html'];
    }//FIN pulldown    
    
    // FUNCION pdCantidad
    function pdCantidad ( $p = 1, $max = 20){
        //
        $out = "";
        //
        for ($i = 1; $i <= $max; $i ++){
            $default = ($p == $i) ? 'selected' : '';            
            $out .= "<option value='{$i}'{$default}>{$i} de {$max}</option>";
        }
        //
        return "<select onchange='this.form.submit()' name='cantidad[]' required>{$out}</select>";        
    }
    // FIN FUNCION pdCantidad
    
}// FIN Clase producto
?>