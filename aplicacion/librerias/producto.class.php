<?php

class producto {
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
			$this->_oo['file'] = $CONF["path"]["dat"].'/productos.csv';
			//
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
                    $linea['id']          = isset($fila[0]) ? $fila[0] : null;
                    $linea['nombre']      = isset($fila[1]) ? $fila[1] : null;
                    $linea['descripcion'] = isset($fila[2]) ? $fila[2] : null;
                    $linea['importe']     = isset($fila[3]) ? $fila[3] : null;
                    $linea['stock']       = isset($fila[4]) ? $fila[4] : null;

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
		$out = "<option value='0'>Seleccione un producto</option>";
		
		
		try {		
			if ($this->cargar())
			{	
				foreach ($this->_oo['data'] as $k => $v){
					$sel = '';
					if ($v['id'] == $p) 
					{
						$this->_oo['res'] =$v;
						$this->_oo['ok'] = true;
						$sel = 'selected';
					}
					//

					$opcion = false;
					if (!isset($_REQUEST['producto'])) {
						$opcion = true;
					}
					else
					{
						if ($v['id'] == $p)
						{
							$opcion = true;
						}
						else
						{
							if (!in_array($v['id'], $_REQUEST['producto'])) {
								$opcion = true;
							}
						}
					}

					if ($opcion) {
						$out .= "<option value='{$v['id']}' {$sel}>{$v['descripcion']} ({$v['nombre']} )</option>";
					}
				}
				$this->_oo['html'] = "<select onchange='this.form.submit()' name='producto[]' required>{$out}</select>";
			}
		} catch (Exception $e) {
			$this->_oo['msg'] = "ERROR: " . $e->getMessage();
			$this->_oo['ok'] = false;
		}
		//
		return $this->_oo['ok'];
	}//FIN pulldown
	
}// FIN Clase producto
?>