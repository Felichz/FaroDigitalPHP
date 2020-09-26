
CREATE TABLE IF NOT EXISTS clientes (
  id BIGSERIAL NOT NULL,
  nombre VARCHAR(30) NOT NULL,
  apellido VARCHAR(30) NOT NULL,
  edad SMALLINT NOT NULL,
  nacimiento TIMESTAMP NOT NULL,
  antiguedad SMALLINT NOT NULL,
  descuento REAL  NOT NULL,
  direccion VARCHAR(100) NOT NULL,
  celular VARCHAR(30) NOT NULL,
  email VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS documento (
  id BIGSERIAL NOT NULL,
  id_cliente BIGSERIAL NOT NULL,
  fecha_venta TIMESTAMP NOT NULL,
  descuento REAL NOT NULL,
  iva REAL NOT NULL,
  monto REAL NOT NULL,
  id_documento TEXT NOT NULL
);

CREATE TABLE IF NOT EXISTS documento_detalle (
  id BIGSERIAL NOT NULL,
  id_documento TEXT NOT NULL,
  id_producto BIGSERIAL NOT NULL,
  nombre VARCHAR(45) NOT NULL,
  descripcion TEXT NOT NULL,
  importe REAL NOT NULL,
  cantidad BIGINT NOT NULL,
  monto REAL NOT NULL
);

CREATE TABLE IF NOT EXISTS productos (
  id BIGSERIAL NOT NULL,
  nombre VARCHAR(45) NOT NULL,
  descripcion TEXT NOT NULL,
  importe REAL NOT NULL,
  stock BIGINT  NOT NULL
);