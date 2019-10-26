<?php
require_once "{$CONF['path']['modelo']}/consultas.class.php";

$oCO = consultas::objetoConsultas();

class venta 
{
    var $_oo;
    
    // __construct
    public function __construct($p = null) 
    {
        //
        global $CONF;
        global $oCO;
        //
        try 
        {
            $this->oCO = $oCO;
            $this->_oo = array();
            $this->_oo['ok'] = true;
            $this->_oo['data'] = array();
            $this->_oo['msg'] = '';
        } catch (Exception $e) {
            $this->_oo['msg'] = "ERROR: " . $e->getMessage();
            $this->_oo['ok'] = false;
        }
        return $this->_oo['ok'];
    }// FIN __construct
    
    // FUNCION agregar
    function agregar($p){
        //
        $this->_oo['ok'] = true;

        try 
        {
            $this->oCO->agregarVenta($p);
            if (!$this->oCO->_oo['ok'])
            {
                throw new Exception($this->oCO->_oo['msg']);
            }

            $this->id_documento = $this->oCO->id_documento;
        }
        catch (Exception $e) 
        {
            $this->_oo['msg'] = "Error generando venta : " . $e->getMessage();
            $this->_oo['ok'] = false;
        }
        //
        return $this->_oo['ok'];
    }// FIN FUNCION agregar

    // FUNCION cargarVentas - Carga una única venta o el total de ellas
    function cargarVentas($p = null)
    {
        try
        {
            if ($p == null) // Toda la tabla
            {
                $ventas = $this->oCO->cargar("documento");
                foreach ($ventas as $k => $v)
                {
                    $ventas[$k]["detalle_venta"] = $this->oCO->cargar("documento_detalle", "id_documento", $p);
                }
            }
            else // Registro único
            {
                $ventas = $this->oCO->cargar("documento", "id_documento", $p);
                $ventas = $ventas[0];
                $ventas["detalle_venta"] = $this->oCO->cargar("documento_detalle", "id_documento", $p);
            }

            if (!$this->oCO->_oo['ok'])
            {
                throw new Exception($this->oCO->_oo['msg']);
            }

            return $ventas;
        }
        catch (Exception $e)
        {
            $this->_oo['msg'] = "Error al cargar ventas: " . $e->getMessage();
            return $this->_oo['ok'] = false;
        }
        
        echo $this->_oo['msg'];
    } // FIN FUNCION cargar Ventas
      
}// FIN Clase venta

//Intentar incluir la modificacion del stock en la transicion de venta
?>