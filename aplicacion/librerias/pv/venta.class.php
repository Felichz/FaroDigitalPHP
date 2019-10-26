<?php

class venta {
    var $_oo;
    
    // __construct
    public function __construct($p = null) {
        //
        global $CONF;
        //
        try {
            $this->_oo = array();
            $this->_oo['data'] = array();
            $this->_oo['ok'] = true;
            $this->_oo['msg'] = '';
            $this->_oo['file'] = "{$CONF['path']['dat']}/pv/ventas.txt";
        } catch (Exception $e) {
            $this->_oo['msg'] = "ERROR: " . $e->getMessage();
            $this->_oo['ok'] = false;
        }
        return $this->_oo['ok'];
    }// FIN __construct
    
    // FUNCION agregar
    function agregar($p = null){
        //
        $this->_oo['data'] = array();
        $this->_oo['ok'] = true;
        $this->_oo['msg'] = '';
        //
        try {
            // CARGAR VENTAS
            if ($this->buscar($p['id']) == false){
                //
                $data = file_get_contents($this->_oo['file']); 
                $data = ($data == false) ? json_encode($p) : json_encode($p) . "\n{$data}";
                if (file_put_contents($this->_oo['file'], $data) == false){
                    throw new Exception("No se agregar el registro");
                }
                //
                $this->_oo['ok'] = true;
                $this->_oo['msg'] = 'Registro ingresado';
            }
            //
        } catch (Exception $e) {
            $this->_oo['msg'] = "ERROR: Buscar: {$e->getMessage()} :: {$this->_oo['file']}";
            $this->_oo['ok'] = false;
        }
        //
        return $this->_oo['ok'];
    }// FIN FUNCION agregar
    
    // FUNCION buscar
    function buscar($p = null){
        //
        $this->_oo['data'] = array();
        $this->_oo['ok'] = true;
        $this->_oo['msg'] = '';
        //
        try {
            // CARGAR VENTAS
            $archivo_venta = @fopen("{$this->_oo['file']}", "c+");
            $data = array();
            if ($archivo_venta) {
                while (($linea = fgets($archivo_venta, 4096)) !== false) {
                    $venta = json_decode($linea, true);
                    if (isset($venta['id'])){
                        $data["{$venta['id']}"] = $venta;
                        //var_dump($venta);
                        //echo "<br/><br/>";
                    } else {
                        throw new Exception("Entrada de venta invalida");
                    }                    
                }
                if (!feof($archivo_venta)) {
                    throw new Exception("No se pudo leer el archivo");
                }
                fclose($archivo_venta);
            } else {
                throw new Exception("No se pudo abrir el archivo");
            }
            
            // RECUPERAR POR PATRON / SINO DEVUELVO TODOS            
            if ($p != null){
                if (isset($data["{$p}"])){
                    $this->_oo['data']["{$p}"] = $data["{$p}"];
                } else {
                    $this->_oo['ok'] = false;
                    $this->_oo['msg'] = 'Venta no encontrada';
                }
            } else{
                $this->_oo['data'] = $data;
            }
            //            
        } catch (Exception $e) {
            $this->_oo['msg'] = "ERROR: Buscar: {$e->getMessage()} :: {$this->_oo['file']}";
            $this->_oo['ok'] = false;
        }
        //
        return $this->_oo['ok'];
    }// FIN FUNCION buscar
    
      
}// FIN Clase venta
?>