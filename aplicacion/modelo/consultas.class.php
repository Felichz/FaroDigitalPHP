<?php

// Leyendo el código en 2019 puedo ver muchas cosas que mejoraría el mismo, ya que he
// aprendido mucho durante este tiempo, por ejemplo en esta clase del modelo, veo
// que hay mucho código que deberia ser parte de ciertos controladores y no estar
// mezclado con el modelo.

class consultas
{
	var $db;
	
	private static $oCO;

	private function __construct()
	{
		global $CONF;
		try
		{
			$this->db = array();
			$this->db['user'] = $CONF['db']['puntoventa']['user'];
			$this->db['pw'] = $CONF['db']['puntoventa']['pw'];
			$this->db['host'] = $CONF['db']['puntoventa']['host'];
			$this->db['nombre'] = $CONF['db']['puntoventa']['nombre'];
			$this->_oo['ok'] = true;
			$this->_oo['msg'] = '';
		}
		catch(Exception $e)
		{
			$this->_oo['msg'] = "ERROR: " . $e->getMessage();
			$this->_oo['ok'] = false;
		}

		return $this->_oo['ok'];
	} // FIN FUNCION __construct

	// Crear una única instancia para la clase consultas (Patrón de diseño Singleton)
	public static function objetoConsultas()
	{
		if (!self::$oCO instanceof self)
		{
			consultas::$oCO = new consultas();	
		}
		return consultas::$oCO;
	}

	// Prohibir clones de la instancia
	public function __clone()
	{
		trigger_error("Oparación invalida: No se puede clonar una instancia de consultas", E_USER_ERROR);
	}
	//

	// FUNCION conectar

	function conectar()
	{
		$this->_oo['msg'] = "";
		$this->_oo['ok'] = true;
		try
		{
			$conexion = new PDO("mysql:host={$this->db['host']};dbname={$this->db['nombre']}", $this->db['user'], $this->db['pw'], array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
			// El último parámetro fue necesario para visualizar los tildes correctamente

			return $conexion;
		}
		catch(Exception $e)
		{
			$this->_oo['msg'] = "Error al conectar a la base de datos: " . $e->getMessage();
			return $this->_oo['ok'] = false;
		}
	}

	// FUNCION cargar - Carga registros con posibilidad de filtrarlos por el valor de un campo

	function cargar($arg_tabla, $arg_columna = null, $arg_id_registro = null)
	{

		$this->_oo['msg'] = "";
		$this->_oo['ok'] = true;

		$conexion = $this->conectar();
		if ($this->_oo['ok'] != false)
		{
			try
			{
				if ($arg_id_registro == null) // Toda la tabla
				{
					$sql = "SELECT * FROM $arg_tabla";
					$sentencia = $conexion->prepare($sql);
					if ($sentencia)
					{
						$sentencia->execute();
						$registros = array();
						while ($registro = $sentencia->fetch(PDO::FETCH_ASSOC))
						{
							$registros[] = $registro;
						}
					}
				}
				else // Registros filtrados
				{
					$sql = "SELECT * FROM $arg_tabla WHERE $arg_columna = :id";
					$sentencia = $conexion->prepare($sql);
					$sentencia->bindParam(":id", $arg_id_registro); // Sólo de prueba, no es del todo necesario ya que el usuario no interviene en esto y no podría hacer una inyección SQL, a menos que yo mismo me quiera hacer una desde el código interno jajaj
					if ($sentencia)
					{
						$sentencia->execute();
					}

					$registros = array();
					while ($registro = $sentencia->fetch(PDO::FETCH_ASSOC))
					{
						$registros[] = $registro;
					}
				}

				if(count($registros) != 0)
				{
					return $registros;
				}
				else
				{
					throw new Exception("Registros no encontrados");
				}
			}
			catch(Exception $e)
			{
				$this->_oo['msg'] = "Error al cargar registros: " . $e->getMessage();
				return $this->_oo['ok'] = false;
			}
		}
		else
		{
			return false;
		}
	} // FIN FUNCION cargar

	// FUNCION modificar - Modifica un único registro

	function modificar($arg_tabla, $arg_columna, $arg_id_registro, $arg_valor)
	{

		$this->_oo['msg'] = "";
		$this->_oo['ok'] = true;

		$conexion = $this->conectar();
		if ($this->_oo['ok'] != false)
		{
			try
			{
				$sql = "UPDATE $arg_tabla SET $arg_columna = $arg_valor WHERE id = $arg_id_registro";
				$sentencia = $conexion->prepare($sql);
				if ($sentencia)
				{
					$sentencia->execute();
				}
			}
			catch(Exception $e)
			{
				$this->_oo['msg'] = "Error al modificar registros: " . $e->getMessage();
				$this->_oo['ok'] = false;
			}
		}
		else
		{
			$this->_oo['ok'] = false;
		}

		return $this->_oo['ok'];
	} // FIN FUNCION modificar

	// FUNCION crearRegistro - Inserta un registro único

	function crearRegistro($arg_tabla, $arg_columnas, $arg_valores)
	{

		$this->_oo['msg'] = "";
		$this->_oo['ok'] = true;

		$conexion = $this->conectar();
		if ($this->_oo['ok'] != false)
		{
			try
			{
				// Aquí si veo posibilidad de inyección SQL porque en algún caso el usuario podría intervenir en los argumentos que entran por la función, por ejemplo ingresando datos desde un formulario, como en el registro de un nuevo cliente (Aun no doy uso a esta función, para agregar las ventas tuve que hacer una función exclusiva manejando transiciones)
				$sql = "INSERT INTO :tabla (:columnas) VALUES (:valores)";
				$sentencia = $conexion->prepare($sql);

				$sentencia->bindParam(":tabla", $arg_tabla);
				$sentencia->bindParam(":columnas", $arg_columnas);
				$sentencia->bindParam(":valores", $arg_valores);

				if ($sentencia)
				{
					$sentencia->execute();
				}
			}
			catch(Exception $e)
			{
				$this->_oo['msg'] = "Error al crear registros: " . $e->getMessage();
				$this->_oo['ok'] = false;
			}
		}
		else
		{
			$this->_oo['ok'] = false;
		}

		return $this->_oo['ok'];
	} // FIN FUNCION crearRegistro

	// FUNCION agregarVenta
	function agregarVenta($arg_venta)
	{

		$this->_oo['msg'] = "";
		$this->_oo['ok'] = true;

		$conexion = $this->conectar();
		if ($this->_oo['ok'] != false)
		{
			try
			{
				$venta = $arg_venta;
				$conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$conexion->beginTransaction(); // INICIO TRANSACCIÓN
				$id_documento = mktime() . "_{$arg_venta['id_cliente']}";

				// Agregar registro principal de la venta

				$sql = "
				INSERT INTO documento (id_documento, id_cliente, fecha_venta, descuento, iva, monto) VALUES ('{$id_documento}', '{$arg_venta['id_cliente']}', '{$arg_venta['fecha_venta']}', '{$arg_venta['descuento']}', '{$arg_venta['iva']}', '{$arg_venta['monto']}')";
				$sentencia = $conexion->prepare($sql);
				$sentencia->execute();

				// Agregar detalles de venta

				foreach($venta["detalle_venta"] as $k => $detalle)
				{
					$sql = "INSERT INTO documento_detalle (id, id_documento, id_producto, nombre, descripcion, importe, cantidad, monto) VALUES (NULL, '{$id_documento}', '{$detalle['id']}', '{$detalle['nombre']}', '{$detalle['descripcion']}', '{$detalle['importe']}', '{$detalle['cantidad']}', '{$detalle['monto']}')";
					$sentencia = $conexion->prepare($sql);
					$sentencia->execute();
				}

				$this->id_documento = $id_documento; // Creo atributo para pasar el ID a la clase venta
				$conexion->commit(); // COMMIT DE TRANSACCIÓN
			}
			catch(Exception $e)
			{
				$conexion->rollBack(); // ROLLBACK DE TRANSACCIÓN
				$this->_oo['msg'] = "Error al crear registros de venta: " . $e->getMessage();
				$this->_oo['ok'] = false;
			}
		}
		else
		{
			$this->_oo['ok'] = false;
		}

		echo $this->_oo['msg'];
		return $this->_oo['ok'];
	} // FIN FUNCION agregarVenta
}

?>