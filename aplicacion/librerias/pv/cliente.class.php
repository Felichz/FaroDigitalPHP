<?php

class cliente {
	var $_oo;	

	public function __construct($p = null) {
	    global $CONF;
	    //
		$this->_oo['ok'] = true;
		try {
			$this->_oo = array();
			$this->_oo['data'] = array();
			$this->_oo['res'] = array();
			$this->_oo['html'] = '';
			$this->_oo['ok'] = '';
			$this->_oo['msg'] = '';
			$this->_oo['file'] = "{$CONF['path']['dat']}/pv/clientes.csv";
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
                                $linea['apellido'] = $value; 
                            break;
                            
                            case 3:
                                $linea['edad'] = $value; 
                            break;
                            
                            case 4:
                                $linea['antiguedad'] = $value; 
                            break;
                            
                            case 5:
                                $linea['descuento'] = $value; 
                            break;
                            
                            case 6:
                                $linea['direccion'] = $value; 
                            break;
                            
                            case 7:
                                $linea['celular'] = $value; 
                            break;
                            
                            case 8:
                                $linea['email'] = $value; 
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
                    $out .= "<option value='{$v['id']}' {$sel}>{$v['nombre']} {$v['apellido']}</option>";
                }
                $this->_oo['html'] = "<select onchange='this.form.submit()' name='idCliente' required>{$out}</select>";		        
		    }			
		} catch (Exception $e) {
			$this->_oo['msg'] = "ERROR: " . $e->getMessage();
			$this->_oo['ok'] = false;
		}
		//
		return $this->_oo['ok'];
	}//FIN pulldown
	
	// FUNCION buscar
	function buscar($p=null){	    
	    $salida = array();
	    $salida['id'] = '';
	    $salida['nombre'] = '';
	    $salida['apellido'] = '';
	    $salida['edad'] = '';
	    $salida['antiguedad'] = '';
	    $salida['descuento'] = '';
	    $salida['direccion'] = '';
	    $salida['celular'] = '';
	    $salida['email'] = '';
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
	
}// FIN Clase cliente
?>