<?php

class cliente {
	var $_oo;	

	public function __construct($p = null) {
		GLOBAL $CONF;
		
		$this->_oo['ok'] = true;
		try {
			$this->_oo = array();
			$this->_oo['data'] = array();
			$this->_oo['res'] = array();
			$this->_oo['html'] = '';
			$this->_oo['ok'] = '';
			$this->_oo['msg'] = '';
			$this->_oo['file'] = $CONF["path"]["dat"].'/clientes.csv';
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
                    $linea['id']         = isset($fila[0]) ? $fila[0] : null;
                    $linea['nombre']     = isset($fila[1]) ? $fila[1] : null;
                    $linea['apellido']   = isset($fila[2]) ? $fila[2] : null;
                    $linea['edad']       = isset($fila[3]) ? $fila[3] : null;
                    $linea['antiguedad'] = isset($fila[4]) ? $fila[4] : null;
                    $linea['descuento']  = isset($fila[5]) ? $fila[5] : null;
                    $linea['direccion']  = isset($fila[6]) ? $fila[6] : null;
                    $linea['celular']    = isset($fila[7]) ? $fila[7] : null;
                    $linea['email']      = isset($fila[8]) ? $fila[8] : null;

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
		$out = "<option value=0>Seleccione un cliente</option>";
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
					$out .= "<option value='{$v['id']}' {$sel}>{$v['nombre']} {$v['apellido']}</option>\n";
				}
				$this->_oo['html'] = "<select onchange='this.form.submit()' name='idCliente' required>\n{$out}\n</select>";
			}	
		} catch (Exception $e) {
			$this->_oo['msg'] = "ERROR: " . $e->getMessage();
			$this->_oo['ok'] = false;
		}
		//
		return $this->_oo['ok'];
	}//FIN pulldown
	
}// FIN Clase cliente
?>