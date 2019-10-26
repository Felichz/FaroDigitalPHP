<?php

class producto {
	var $_oo;	

	public function __construct($p = null) {
		$this->_oo['ok'] = true;
		try {
			$this->_oo = array();
			$this->_oo['data'] = array();
			$this->_oo['res'] = array();
			$this->_oo['html'] = '';
			$this->_oo['ok'] = '';
			$this->_oo['msg'] = '';
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
			for ($i=1000; $i < 1030; $i++){
				$producto = array();
				$producto['id'] = $i;
				$producto['nombre'] = "Nombre {$i}";
				$producto['descripcion'] = "descripcion xXxxX xXxxxX {$i}";
				$producto['importe'] = rand( 1000, 20000);
				$producto['stock'] = rand( 1, 20);
				//
				$this->_oo['data'][] = $producto;
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
                    $out .= "<option value='{$v['id']}' {$sel}>{$v['descripcion']} ({$v['nombre']} )</option>\n";
                }
                $this->_oo['html'] = "<select onchange='this.form.submit()' name='producto[]' required>\n{$out}\n</select>";
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