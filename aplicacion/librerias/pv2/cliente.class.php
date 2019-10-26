<?php
require_once "{$CONF['path']['modelo']}/consultas.class.php";

$oCO = consultas::objetoConsultas();

class cliente
{
	var $_oo;
	public function __construct($p = null)
	{
		global $CONF;
		global $oCO;

		try
		{
			$this->oCO = $oCO;
			$this->_oo = array();
			$this->_oo['ok'] = true;
			$this->_oo['data'] = array();
			$this->_oo['res'] = array();
			$this->_oo['html'] = '';
			$this->_oo['ok'] = '';
			$this->_oo['msg'] = '';
		}
		catch(Exception $e)
		{
			$this->_oo['msg'] = "ERROR: " . $e->getMessage();
			$this->_oo['ok'] = false;
		}

		return $this->_oo['ok'];
	} // FIN __construct


	// FUNCION pullDown
	public function pullDown($p = null)
	{
		$out = "<option value=''>Seleccione un cliente</option>";

		$this->_oo['msg'] = "";
		$this->_oo['ok'] = true;
		$this->_oo['html'] = '';
		$this->_oo['res'] = array();

		$this->_oo['data'] = $this->oCO->cargar("clientes"); // Carga toda la tabla
        if (!$this->oCO->_oo['ok'])
        {
            throw new Exception($this->oCO->_oo['msg']);
        }

		try
		{
			foreach($this->_oo['data'] as $k => $v)
			{
				$sel = '';
				if ($v['id'] == $p)
				{
					$this->_oo['res'] = $v;
					$this->_oo['ok'] = true;
					$sel = 'selected';
				}

				$out.= "<option value='{$v['id']}' {$sel}>{$v['nombre']} {$v['apellido']}</option>";
			}

			$this->_oo['html'] = "<select onchange='this.form.submit()' name='idCliente' required>{$out}</select>";
		}
		catch(Exception $e)
		{
			$this->_oo['msg'] = "ERROR: " . $e->getMessage();
			$this->_oo['ok'] = false;
		}
		return $this->_oo['ok'];
	} //FIN pulldown


	// FUNCION buscar
	function buscar($p = null)
	{
		$this->_oo['msg'] = "";
		$this->_oo['ok'] = true;
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

		if ($p != null)
		{
			$salida = $this->oCO->cargar("clientes", "id", $p);
			if (!$this->oCO->_oo['ok'])
			{
				throw new Exception($this->oCO->_oo['msg']);
			}

			$salida = $salida[0];
			if ($this->oCO->_oo['ok'] != false)
			{
				return $salida;
			}
			else
			{
				$this->_oo['msg'] = $this->oCO->_oo['msg'];
				return $this->_oo['ok'] = false;
			}
		}
	}

	// FIN FUNCION buscar

} // FIN Clase cliente

?>