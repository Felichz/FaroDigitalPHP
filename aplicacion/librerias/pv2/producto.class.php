<?php

require_once "{$CONF['path']['modelo']}/consultas.class.php";

$oCO = consultas::objetoConsultas();

class producto 
{
    var $_oo;

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
    

    // FUNCION modificar
    function modificarStock($p=null){
        //
        $this->_oo['msg'] = "";
        $this->_oo['ok'] = true;
        
        try 
        {
            if (!isset($p['id']))
            {
                throw new Exception("ID de producto inválido");
            }
            else
            {
                // ACTUALIZANDO STOCK
                if (isset($p['stock']))
                {
                    if ($p['stock'] < 0)
                    {
                        throw new Exception("Stock insuficiente");

                    } 
                    else 
                    {
                        $this->oCO->modificar("productos", "stock", $p["id"], $p["stock"]);
                        if (!$this->oCO->_oo['ok'])
                        {
                            throw new Exception($this->oCO->_oo['msg']);
                        }
                    }            
                }
            }     

        }
        catch (Exception $e) 
        {
            $this->_oo['msg'] = "ERROR: " . $e->getMessage();
            $this->_oo['ok'] = false;
        }
        //
        return $this->_oo['ok'];
    }
    // FIN FUNCION modificar
    
    
    // FUNCION buscar
    function buscar($p){
        $salida = array();
        $salida['id'] = '';
        $salida['nombre'] = '';
        $salida['descripcion'] = '';
        $salida['importe'] = '';
        $salida['stock'] = '';
        //
        try 
        {
            if($p >= 0)
            {
                $salida = $this->oCO->cargar("productos", "id", $p);
                if (!$this->oCO->_oo['ok'])
                {
                    throw new Exception($this->oCO->_oo['msg']);
                }
                    
                $salida = $salida[0];
            }
            else
            {
                throw new Exception("ID de producto inválido");
                
            }
        } 
        catch (Exception $e) 
        {
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
        $this->_oo['data'] = $this->oCO->cargar("productos");
        if (!$this->oCO->_oo['ok'])
        {
            throw new Exception($this->oCO->_oo['msg']);
        }

        $out = "<option value=''>Seleccione un producto</option>";
        //
        try 
        {
            foreach ($this->_oo['data'] as $k => $v){
                $sel = '';
                if ($v['id'] == $p) {
                    $this->_oo['res'] = $v;
                    $this->_oo['ok'] = true;
                    $sel = 'selected';
                }
                
                $out .= "<option value='{$v['id']}' {$sel}>{$v['nombre']} ({$v['stock']})</option>";
            }
            $this->_oo['html'] = "<select onchange='this.form.submit()' name='producto[]' required>{$out}</select>";
            
        } catch (Exception $e) {
            $this->_oo['msg'] = "ERROR: " . $e->getMessage();
            $this->_oo['ok'] = false;
        }
        //
        return $this->_oo['html'];
    }//FIN pulldown

    // FUNCION pdCantidad
    function pdCantidad ( $p = 1, $max = 20){

        $out = "<input onchange='this.form.submit()' name='cantidad[]' type='number' value='{$p}' max='{$max}' min='1' required/> &nbsp <b>({$max} en stock)</b>";

        return $out;
    }
    // FIN FUNCION pdCantidad
    
}// FIN Clase producto
?>