CREATE DATABASE pharmacy;
USE pharmacy;

-- Sección contactos
CREATE TABLE tipo_contacto (
    id_tipo_contacto INT NOT NULL AUTO_INCREMENT,
    tipo_contacto_nombre VARCHAR(50) NOT NULL,
    PRIMARY KEY (id_tipo_contacto)
);

CREATE TABLE persona (
    id_persona INT NOT NULL AUTO_INCREMENT,
    persona_nombre VARCHAR(50) NOT NULL,
    persona_apellido VARCHAR(50) NOT NULL,
    persona_fecha_nac DATE NOT NULL,
    persona_dni VARCHAR(10) NOT NULL,
    persona_sexo VARCHAR(10),
    persona_direccion VARCHAR(50) NOT NULL,
    PRIMARY KEY (id_persona)
);

CREATE TABLE proveedor (
    id_proveedor INT NOT NULL AUTO_INCREMENT,
    prov_estado VARCHAR(50) NOT NULL,
    prov_direccion VARCHAR(50) NOT NULL,
    prov_nombre_empresa VARCHAR(50) NULL,
    rela_persona INT NULL,
    PRIMARY KEY (id_proveedor),
    FOREIGN KEY (rela_persona) REFERENCES persona(id_persona)
);

CREATE TABLE contacto_persona (
    id_contacto INT NOT NULL AUTO_INCREMENT,
    contacto_valor VARCHAR(50) NOT NULL,
    rela_tipo_contacto INT NOT NULL,
    rela_persona INT NOT NULL,
    PRIMARY KEY (id_contacto),
    FOREIGN KEY (rela_tipo_contacto) REFERENCES tipo_contacto(id_tipo_contacto),
    FOREIGN KEY (rela_persona) REFERENCES persona(id_persona)
);

CREATE TABLE contacto_empresa (
    id_contacto INT NOT NULL AUTO_INCREMENT,
    contacto_valor VARCHAR(50) NOT NULL,
    rela_tipo_contacto INT NOT NULL,
    rela_proveedor INT NOT NULL,
    PRIMARY KEY (id_contacto),
    FOREIGN KEY (rela_tipo_contacto) REFERENCES tipo_contacto(id_tipo_contacto),
    FOREIGN KEY (rela_proveedor) REFERENCES proveedor(id_proveedor)
);

-- Sección Usuarios y roles
CREATE TABLE rol (
    id_rol INT NOT NULL AUTO_INCREMENT,
    nombre_rol VARCHAR(50),
    PRIMARY KEY (id_rol)
);

CREATE TABLE modulo (
    id_modulo INT NOT NULL AUTO_INCREMENT,
    modulo_nombre VARCHAR(50),
    PRIMARY KEY (id_modulo)
);

CREATE TABLE rol_modulo (
    rol_id INT NOT NULL,
    modulo_id INT NOT NULL,
    PRIMARY KEY (rol_id, modulo_id),
    FOREIGN KEY (rol_id) REFERENCES rol(id_rol),
    FOREIGN KEY (modulo_id) REFERENCES modulo(id_modulo)
);

CREATE TABLE usuario (
    id_usuario INT NOT NULL AUTO_INCREMENT,
    nombre_usuario VARCHAR(20) NOT NULL,
    contrasena VARCHAR(500) NOT NULL,
    rela_persona INT NOT NULL,
    rela_rol INT NOT NULL,
    PRIMARY KEY (id_usuario),
    FOREIGN KEY (rela_persona) REFERENCES persona(id_persona),
    FOREIGN KEY (rela_rol) REFERENCES rol(id_rol)
);

CREATE TABLE cliente (
    id_cliente INT NOT NULL AUTO_INCREMENT,
    rela_persona INT,
    cliente_fecha_alta DATE NOT NULL,
    cliente_estado VARCHAR(50) NOT NULL,
    PRIMARY KEY (id_cliente),
    FOREIGN KEY (rela_persona) REFERENCES persona(id_persona)
);

CREATE TABLE cuenta_corriente (
    id_cuenta_corriente INT NOT NULL AUTO_INCREMENT,
    rela_cliente INT,
    cc_saldo INT NOT NULL,
    cc_limite_credito INT,
    PRIMARY KEY (id_cuenta_corriente),
    FOREIGN KEY (rela_cliente) REFERENCES cliente(id_cliente)
);

CREATE TABLE tipo_movimiento (
    id_tipo_movimiento INT NOT NULL AUTO_INCREMENT,
    tipo_movimiento_descri VARCHAR(50) NOT NULL,
    PRIMARY KEY (id_tipo_movimiento)
);

CREATE TABLE tipo_producto (
    id_tipo_producto INT NOT NULL AUTO_INCREMENT,
    tipo_producto_descri VARCHAR(50) NOT NULL,
    PRIMARY KEY (id_tipo_producto)
);

CREATE TABLE tipoventa (
    id_tipoventa INT NOT NULL AUTO_INCREMENT,
    tipoventa_descri VARCHAR(20) NOT NULL,
    PRIMARY KEY (id_tipoventa)
);

CREATE TABLE categoria (
    id_categoria INT NOT NULL AUTO_INCREMENT,
    categoria_descri VARCHAR(100),
    PRIMARY KEY (id_categoria)
);
-- SELECT * FROM marca where marca_descri LIKE '%"b"%' ORDER BY marca_descri ASC;
CREATE TABLE alfabeta (
    id_alfabeta INT NOT NULL AUTO_INCREMENT,
    alfabeta_SiNo INT NOT NULL,
    PRIMARY KEY (id_alfabeta)
);

CREATE TABLE accion_farmaceutica (
    id_accion_farmaceutica INT NOT NULL AUTO_INCREMENT,
    accion_farmaceutica_descri VARCHAR(50) NOT NULL,
    PRIMARY KEY (id_accion_farmaceutica)
);

CREATE TABLE origen (
    id_origen INT NOT NULL AUTO_INCREMENT,
    origen_descri VARCHAR(50) NOT NULL,
    PRIMARY KEY (id_origen)
);

CREATE TABLE forma (
    id_forma INT NOT NULL AUTO_INCREMENT,
    forma_descri VARCHAR(50) NOT NULL,
    PRIMARY KEY (id_forma)
);

CREATE TABLE marca (
    id_marca INT NOT NULL AUTO_INCREMENT,
    marca_descri VARCHAR(50) NOT NULL,
    PRIMARY KEY (id_marca)
);

CREATE TABLE droga (
    id_droga INT NOT NULL AUTO_INCREMENT,
    droga_descri VARCHAR(50),
    PRIMARY KEY (id_droga)
);

CREATE TABLE metodo_administracion (
    id_metodo_administracion INT NOT NULL AUTO_INCREMENT,
    metodo_administracion_descri VARCHAR(50) NOT NULL,
    PRIMARY KEY (id_metodo_administracion)
);

CREATE TABLE conservacion (
    id_conservacion INT NOT NULL AUTO_INCREMENT,
    conservacion_descri VARCHAR(50) NOT NULL,
    PRIMARY KEY (id_conservacion)
);

CREATE TABLE laboratorio (
    id_laboratorio INT NOT NULL AUTO_INCREMENT,
    laboratorio_descri VARCHAR(50) NOT NULL,
    PRIMARY KEY (id_laboratorio)
);

CREATE TABLE producto (
    id_producto INT NOT NULL AUTO_INCREMENT,
    producto_nombre VARCHAR(50) NOT NULL,
    producto_codigobarra VARCHAR(50) NOT NULL,
    producto_preciounitario INT NOT NULL,
    producto_cantidad INT NOT NULL,
    producto_cantidadmin INT NOT NULL,
    producto_descripcion VARCHAR(100) NOT NULL,
    producto_fecha_alta DATE,
    producto_estado VARCHAR(10) NOT NULL,
    producto_cod_nroregistro VARCHAR(50) NULL,
    producto_potencia VARCHAR(50) NULL,
    producto_presentacion VARCHAR(100) NULL,
    rela_tipoproducto INT NOT NULL,
    rela_tipoventa INT NOT NULL,
    rela_alfabeta INT NOT NULL,
    rela_accion_farmaceutica INT NULL,
    rela_categoria INT NULL,
    rela_marca INT NULL,
    rela_droga INT NULL,
    rela_forma INT NULL,
    rela_metodo_administracion INT NULL,
    rela_origen INT NULL,
    rela_laboratorio INT NULL,
    rela_conservacion INT NULL,
    PRIMARY KEY (id_producto),
    FOREIGN KEY (rela_tipoproducto) REFERENCES tipo_producto(id_tipo_producto),
    FOREIGN KEY (rela_tipoventa) REFERENCES tipoventa(id_tipoventa),
    FOREIGN KEY (rela_alfabeta) REFERENCES alfabeta(id_alfabeta),
    FOREIGN KEY (rela_accion_farmaceutica) REFERENCES accion_farmaceutica(id_accion_farmaceutica),
    FOREIGN KEY (rela_categoria) REFERENCES categoria(id_categoria),
    FOREIGN KEY (rela_marca) REFERENCES marca(id_marca),
    FOREIGN KEY (rela_droga) REFERENCES droga(id_droga),
    FOREIGN KEY (rela_forma) REFERENCES forma(id_forma),
    FOREIGN KEY (rela_metodo_administracion) REFERENCES metodo_administracion(id_metodo_administracion),
    FOREIGN KEY (rela_origen) REFERENCES origen(id_origen),
    FOREIGN KEY (rela_laboratorio) REFERENCES laboratorio(id_laboratorio),
    FOREIGN KEY (rela_conservacion) REFERENCES conservacion(id_conservacion)
);

CREATE TABLE lotes (
    id_lote INT NOT NULL AUTO_INCREMENT,
    rela_producto INT,
    cantidadxlote INT NULL,
    lote_codigo VARCHAR(100) NOT NULL,
    lote_vencimiento DATE NOT NULL,
    PRIMARY KEY (id_lote),
    FOREIGN KEY (rela_producto) REFERENCES producto(id_producto)
);

CREATE TABLE datos_farmacia (
    id_farmacia INT NOT NULL AUTO_INCREMENT,
    farmacia_nombre VARCHAR(50) NOT NULL,
    farmacia_direccion VARCHAR(50) NOT NULL,
    farmacia_cuil VARCHAR(20),
    PRIMARY KEY (id_farmacia)
);

CREATE TABLE detalle (
    id_detalle INT NOT NULL AUTO_INCREMENT,
    rela_producto INT NOT NULL,
    detalle_cant_vendida INT NOT NULL,
    detalle_subtotal INT NOT NULL,
    PRIMARY KEY (id_detalle),
    FOREIGN KEY (rela_producto) REFERENCES producto(id_producto)
);

CREATE TABLE factura_cabecera (
    id_factura_cabecera INT NOT NULL AUTO_INCREMENT,
    fac_tipo VARCHAR(50) NOT NULL,
    fac_numero INT NOT NULL,
    fac_fechayhora DATETIME NOT NULL,
    rela_farmacia INT NOT NULL,
    rela_cliente INT,
    rela_detalle INT NOT NULL,
    PRIMARY KEY (id_factura_cabecera),
    FOREIGN KEY (rela_farmacia) REFERENCES datos_farmacia(id_farmacia),
    FOREIGN KEY (rela_cliente) REFERENCES cliente(id_cliente),
    FOREIGN KEY (rela_detalle) REFERENCES detalle(id_detalle)
);

CREATE TABLE mediopago (
    id_mediopago INT NOT NULL AUTO_INCREMENT,
    mediopago_tipo VARCHAR(50),
    PRIMARY KEY (id_mediopago)
);

CREATE TABLE factura_mediopago (
    factura_cabecera_id INT NOT NULL,
    mediopago_id INT NOT NULL,
    importe INT NOT NULL,
    PRIMARY KEY (factura_cabecera_id, mediopago_id),
    FOREIGN KEY (factura_cabecera_id) REFERENCES factura_cabecera(id_factura_cabecera),
    FOREIGN KEY (mediopago_id) REFERENCES mediopago(id_mediopago)
);

CREATE TABLE recibo (
    id_recibo INT NOT NULL AUTO_INCREMENT,
    rela_farmacia INT NOT NULL,
    rela_cuenta_corriente INT NOT NULL,
    rela_tipo_movimiento INT,
    recibo_numero_comprobante INT,
    recibo_fechayhora DATETIME NOT NULL,
    recibo_estado VARCHAR(50) NOT NULL,
    rela_detalle INT,
    PRIMARY KEY (id_recibo),
    FOREIGN KEY (rela_farmacia) REFERENCES datos_farmacia(id_farmacia),
    FOREIGN KEY (rela_cuenta_corriente) REFERENCES cuenta_corriente(id_cuenta_corriente),
    FOREIGN KEY (rela_tipo_movimiento) REFERENCES tipo_movimiento(id_tipo_movimiento),
    FOREIGN KEY (rela_detalle) REFERENCES detalle(id_detalle)
);

CREATE TABLE recibo_mediopago (
    recibo_id INT NOT NULL,
    mediopago_id INT NOT NULL,
    importe INT,
    PRIMARY KEY (recibo_id, mediopago_id),
    FOREIGN KEY (recibo_id) REFERENCES recibo(id_recibo),
    FOREIGN KEY (mediopago_id) REFERENCES mediopago(id_mediopago)
);

CREATE TABLE detalle_compra (
    id_detalle_compra INT NOT NULL AUTO_INCREMENT,
    rela_producto INT NOT NULL,
    dc_cantidad_comprada INT NOT NULL,
    dc_subtotal INT NOT NULL,
    PRIMARY KEY (id_detalle_compra),
    FOREIGN KEY (rela_producto) REFERENCES producto(id_producto)
);

CREATE TABLE compras (
    id_compra INT NOT NULL AUTO_INCREMENT,
    compra_fecha DATETIME NOT NULL,
    compra_total INT NOT NULL,
    compra_estado VARCHAR(50) NOT NULL,
    rela_proveedor INT NOT NULL,
    rela_detalle_compra INT DEFAULT NULL,
    PRIMARY KEY (id_compra),
    FOREIGN KEY (rela_proveedor) REFERENCES proveedor(id_proveedor),
    FOREIGN KEY (rela_detalle_compra) REFERENCES detalle_compra(id_detalle_compra)
);

CREATE TABLE detalle_pedido (
    id_detalle_pedido INT NOT NULL AUTO_INCREMENT,
    rela_producto INT NOT NULL,
    dp_cantidad_sugerida INT NOT NULL,
    PRIMARY KEY (id_detalle_pedido),
    FOREIGN KEY (rela_producto) REFERENCES producto(id_producto)
);

CREATE TABLE pedido (
    id_pedido INT NOT NULL AUTO_INCREMENT,
    pedido_fecha DATE NOT NULL,
    pedido_estado VARCHAR(50) NOT NULL,
    rela_detalle_pedido INT NOT NULL,
    PRIMARY KEY (id_pedido),
    FOREIGN KEY (rela_detalle_pedido) REFERENCES detalle_pedido(id_detalle_pedido)
);

-- -------------------------INSERTS----------------------------
-- Categorías
INSERT INTO categoria (categoria_descri) VALUES ('Medicamentos');
INSERT INTO categoria (categoria_descri) VALUES ('Dermocosmética');
INSERT INTO categoria (categoria_descri) VALUES ('Cuidado Capilar');
INSERT INTO categoria (categoria_descri) VALUES ('Higiene Personal');
INSERT INTO categoria (categoria_descri) VALUES ('Equipo médico');
INSERT INTO categoria (categoria_descri) VALUES ('Cuidado Infantil');
INSERT INTO categoria (categoria_descri) VALUES ('Ortopédicos');
INSERT INTO categoria (categoria_descri) VALUES ('Cosméticos');
INSERT INTO categoria (categoria_descri) VALUES ('Alimentos');
INSERT INTO categoria (categoria_descri) VALUES ('Salud Sexual');
INSERT INTO categoria (categoria_descri) VALUES ('Perfumería');
INSERT INTO categoria (categoria_descri) VALUES ('Otro');

-- Tipos de producto
INSERT INTO tipo_producto (tipo_producto_descri) VALUES ('Farmacéutico');
INSERT INTO tipo_producto (tipo_producto_descri) VALUES ('Bienestar y Cuidado Personal');

-- Tipos de venta
INSERT INTO tipoventa (tipoventa_descri) VALUES ('Libre');
INSERT INTO tipoventa (tipoventa_descri) VALUES ('Receta');

-- Acciones farmacéuticas
INSERT INTO accion_farmaceutica (accion_farmaceutica_descri) VALUES ('Analgésicos');
INSERT INTO accion_farmaceutica (accion_farmaceutica_descri) VALUES ('Antiinflamatorios');
INSERT INTO accion_farmaceutica (accion_farmaceutica_descri) VALUES ('Antigripales');
INSERT INTO accion_farmaceutica (accion_farmaceutica_descri) VALUES ('Antiácidos');
INSERT INTO accion_farmaceutica (accion_farmaceutica_descri) VALUES ('Antihistamínicos');
INSERT INTO accion_farmaceutica (accion_farmaceutica_descri) VALUES ('Laxantes');
INSERT INTO accion_farmaceutica (accion_farmaceutica_descri) VALUES ('Sedantes');
INSERT INTO accion_farmaceutica (accion_farmaceutica_descri) VALUES ('Antibióticos');
INSERT INTO accion_farmaceutica (accion_farmaceutica_descri) VALUES ('Ansiolíticos');
INSERT INTO accion_farmaceutica (accion_farmaceutica_descri) VALUES ('Antihipertensivos');
INSERT INTO accion_farmaceutica (accion_farmaceutica_descri) VALUES ('Insulina');

-- Formas farmacéuticas
INSERT INTO forma (forma_descri) VALUES ('Tableta o comprimido');
INSERT INTO forma (forma_descri) VALUES ('Cápsula');
INSERT INTO forma (forma_descri) VALUES ('Polvo');
INSERT INTO forma (forma_descri) VALUES ('Efervescente');
INSERT INTO forma (forma_descri) VALUES ('Jarabe');
INSERT INTO forma (forma_descri) VALUES ('Ampolla');
INSERT INTO forma (forma_descri) VALUES ('Gota');
INSERT INTO forma (forma_descri) VALUES ('Ungüento');
INSERT INTO forma (forma_descri) VALUES ('Crema');
INSERT INTO forma (forma_descri) VALUES ('Gel');
INSERT INTO forma (forma_descri) VALUES ('Supositorio');
INSERT INTO forma (forma_descri) VALUES ('Parche transdérmico');
INSERT INTO forma (forma_descri) VALUES ('Inhalador');
INSERT INTO forma (forma_descri) VALUES ('Solución inyectable');
INSERT INTO forma (forma_descri) VALUES ('Emulsión');

-- Origen
INSERT INTO origen (origen_descri) VALUES ('Nacional');
INSERT INTO origen (origen_descri) VALUES ('Importado');

-- Alfabeta
INSERT INTO alfabeta (alfabeta_SiNo) VALUES (1);
INSERT INTO alfabeta (alfabeta_SiNo) VALUES (2);

-- Conservación
INSERT INTO conservacion (conservacion_descri) VALUES ('Temperatura Ambiente');
INSERT INTO conservacion (conservacion_descri) VALUES ('Refrigerado');
INSERT INTO conservacion (conservacion_descri) VALUES ('Congelado');

-- Métodos de administración
INSERT INTO metodo_administracion (metodo_administracion_descri) VALUES ('Oral');
INSERT INTO metodo_administracion (metodo_administracion_descri) VALUES ('Tópica');
INSERT INTO metodo_administracion (metodo_administracion_descri) VALUES ('Intravenosa');
INSERT INTO metodo_administracion (metodo_administracion_descri) VALUES ('Intramuscular');
INSERT INTO metodo_administracion (metodo_administracion_descri) VALUES ('Intradérmica');
INSERT INTO metodo_administracion (metodo_administracion_descri) VALUES ('Subcutánea');
INSERT INTO metodo_administracion (metodo_administracion_descri) VALUES ('Epidural');
INSERT INTO metodo_administracion (metodo_administracion_descri) VALUES ('Intratecal');
INSERT INTO metodo_administracion (metodo_administracion_descri) VALUES ('Ótica');
INSERT INTO metodo_administracion (metodo_administracion_descri) VALUES ('Nasal');
INSERT INTO metodo_administracion (metodo_administracion_descri) VALUES ('Sublingual');
INSERT INTO metodo_administracion (metodo_administracion_descri) VALUES ('Ocular');
INSERT INTO metodo_administracion (metodo_administracion_descri) VALUES ('Rectal');
INSERT INTO metodo_administracion (metodo_administracion_descri) VALUES ('Vaginal');

-- Drogas
INSERT INTO droga (droga_descri) VALUES ('Aspirina');
INSERT INTO droga (droga_descri) VALUES ('Paracetamol');
INSERT INTO droga (droga_descri) VALUES ('Ibuprofeno');
INSERT INTO droga (droga_descri) VALUES ('Amoxicilina');
INSERT INTO droga (droga_descri) VALUES ('Losartan');
INSERT INTO droga (droga_descri) VALUES ('Insulina');
INSERT INTO droga (droga_descri) VALUES ('Loratadina');
INSERT INTO droga (droga_descri) VALUES ('Diazepam');
INSERT INTO droga (droga_descri) VALUES ('Lorazepam');
INSERT INTO droga (droga_descri) VALUES ('Clonazepam');
INSERT INTO droga (droga_descri) VALUES ('Fentanilo');
INSERT INTO droga (droga_descri) VALUES ('Enalapril');
INSERT INTO droga (droga_descri) VALUES ('Azitromicina');
INSERT INTO droga (droga_descri) VALUES ('Omeprazol');
INSERT INTO droga (droga_descri) VALUES ('Tramadol');
INSERT INTO droga (droga_descri) VALUES ('Atenolol');
INSERT INTO droga (droga_descri) VALUES ('Diclofenaco');
INSERT INTO droga (droga_descri) VALUES ('Salbutamol');
INSERT INTO droga (droga_descri) VALUES ('Simvastatina');
INSERT INTO droga (droga_descri) VALUES ('Atorvastatina');
INSERT INTO droga (droga_descri) VALUES ('Ranitidina');
INSERT INTO droga (droga_descri) VALUES ('Morfina');
INSERT INTO droga (droga_descri) VALUES ('Prednisona');

-- Laboratorios
INSERT INTO laboratorio (laboratorio_descri) VALUES ('GlaxoSmithKline (GSK)');
INSERT INTO laboratorio (laboratorio_descri) VALUES ('Johnson & Johnson (J&J)');
INSERT INTO laboratorio (laboratorio_descri) VALUES ('Colgate-Palmolive');
INSERT INTO laboratorio (laboratorio_descri) VALUES ('Procter & Gamble (P&G)');
INSERT INTO laboratorio (laboratorio_descri) VALUES ('Sanofi');
INSERT INTO laboratorio (laboratorio_descri) VALUES ('Abbott');
INSERT INTO laboratorio (laboratorio_descri) VALUES ('Reckitt');
INSERT INTO laboratorio (laboratorio_descri) VALUES ('Novartis');
INSERT INTO laboratorio (laboratorio_descri) VALUES ('Unilever');
INSERT INTO laboratorio (laboratorio_descri) VALUES ('Beiersdorf');

-- Marcas
INSERT INTO marca (marca_descri) VALUES ('Bayer');
INSERT INTO marca (marca_descri) VALUES ('Pfizer');
INSERT INTO marca (marca_descri) VALUES ('Tafirol');
INSERT INTO marca (marca_descri) VALUES ('Johnson & Johnson');
INSERT INTO marca (marca_descri) VALUES ('Advil');
INSERT INTO marca (marca_descri) VALUES ('Tylenol');
INSERT INTO marca (marca_descri) VALUES ('Dolex');
INSERT INTO marca (marca_descri) VALUES ("L'Oréal");
INSERT INTO marca (marca_descri) VALUES ('Neutrogena');
INSERT INTO marca (marca_descri) VALUES ('Oral-B');
INSERT INTO marca (marca_descri) VALUES ('Nivea');
INSERT INTO marca (marca_descri) VALUES ('Head & Shoulders');
INSERT INTO marca (marca_descri) VALUES ('Colgate');

-- -----------------------------------------------------------------------
INSERT INTO `pharmacy`.`rol` (`nombre_rol`) VALUES ('Administrador');
INSERT INTO `pharmacy`.`rol` (`nombre_rol`) VALUES ('Empleado');
INSERT INTO `pharmacy`.`rol` (`nombre_rol`) VALUES ('Cliente');

INSERT INTO `pharmacy`.`modulo` (`modulo_nombre`) VALUES ('Productos');
INSERT INTO `pharmacy`.`modulo` (`modulo_nombre`) VALUES ('Clientes');
INSERT INTO `pharmacy`.`modulo` (`modulo_nombre`) VALUES ('Ventas');
INSERT INTO `pharmacy`.`modulo` (`modulo_nombre`) VALUES ('Proveedores');
INSERT INTO `pharmacy`.`modulo` (`modulo_nombre`) VALUES ('Compras');
INSERT INTO `pharmacy`.`modulo` (`modulo_nombre`) VALUES ('Fidelización');
INSERT INTO `pharmacy`.`modulo` (`modulo_nombre`) VALUES ('Reportes');
INSERT INTO `pharmacy`.`modulo` (`modulo_nombre`) VALUES ('Usuarios');
INSERT INTO modulo (modulo_nombre) VALUES ('Roles');

-- Modulos para roles --
INSERT INTO `pharmacy`.`rol_modulo` (`rol_id`, `modulo_id`) VALUES ('1', '1');
INSERT INTO `pharmacy`.`rol_modulo` (`rol_id`, `modulo_id`) VALUES ('1', '2');
INSERT INTO `pharmacy`.`rol_modulo` (`rol_id`, `modulo_id`) VALUES ('1', '3');
INSERT INTO `pharmacy`.`rol_modulo` (`rol_id`, `modulo_id`) VALUES ('1', '4');
INSERT INTO `pharmacy`.`rol_modulo` (`rol_id`, `modulo_id`) VALUES ('1', '5');
INSERT INTO `pharmacy`.`rol_modulo` (`rol_id`, `modulo_id`) VALUES ('1', '6');
INSERT INTO `pharmacy`.`rol_modulo` (`rol_id`, `modulo_id`) VALUES ('1', '7');
INSERT INTO `pharmacy`.`rol_modulo` (`rol_id`, `modulo_id`) VALUES ('2', '1');
INSERT INTO `pharmacy`.`rol_modulo` (`rol_id`, `modulo_id`) VALUES ('2', '2');
INSERT INTO `pharmacy`.`rol_modulo` (`rol_id`, `modulo_id`) VALUES ('2', '3');
INSERT INTO `pharmacy`.`rol_modulo` (`rol_id`, `modulo_id`) VALUES ('2', '5');
INSERT INTO `pharmacy`.`rol_modulo` (`rol_id`, `modulo_id`) VALUES ('2', '6');
INSERT INTO `pharmacy`.`rol_modulo` (`rol_id`, `modulo_id`) VALUES ('3', '6');
INSERT INTO `pharmacy`.`rol_modulo` (`rol_id`, `modulo_id`) VALUES ('1', '7');
INSERT INTO `pharmacy`.`rol_modulo` (`rol_id`, `modulo_id`) VALUES ('1', '8');
INSERT INTO rol_modulo (rol_id, modulo_id)
SELECT 1, id_modulo FROM modulo WHERE modulo_nombre = 'Roles';

/* SELECT modulo.* FROM modulo 
INNER JOIN rol_modulo 
ON rol_modulo.modulo_id = modulo.id_modulo 
WHERE rol_modulo.rol_id=2; */

-- -------------------------------------------------------------------------------------------------------------------------------------
-- persona
INSERT INTO persona (persona_nombre, persona_apellido, persona_fecha_nac, persona_dni, persona_sexo, persona_direccion)
VALUES ('Juan', 'Pérez', '1990-05-10', '12345678', 'Masculino', 'Calle Falsa 123'),
       ('Liz', 'Pérez', '2000-02-02', '46222222', 'Femenino', 'Guemes 123'),
	   ('Cris', 'Méndez', '2000-01-01', '21324562', 'Masculino', 'Calle Bob');


INSERT INTO usuario (
    nombre_usuario,
    contrasena,
    rela_persona,
    rela_rol
) VALUES (
    'juan','123', 1, 1);

-- proveedor 
INSERT INTO proveedor (prov_estado, prov_direccion, prov_nombre_empresa, rela_persona)
VALUES ('Activo', 'Av. Siempre Viva 742', 'Farmacia Central', 1);

-- tipo_contacto
INSERT INTO tipo_contacto (tipo_contacto_nombre) VALUES ('Email');
-- Esto creará un registro con id_tipo_contacto = 1 (si la tabla estaba vacía)
INSERT INTO `pharmacy`.`tipo_contacto` (`tipo_contacto_nombre`) VALUES ('Teléfono');


-- contacto_persona 
INSERT INTO contacto_persona (contacto_valor, rela_tipo_contacto, rela_persona)
VALUES ('juan@mail.com', 1, 1);

INSERT INTO contacto_empresa (contacto_valor, rela_tipo_contacto, rela_proveedor)
VALUES ('011-1234-5678', 1, 1);

-- cliente 
INSERT INTO cliente (rela_persona, cliente_fecha_alta, cliente_estado)
VALUES (1, '2024-01-01', 'Activo');

-- cuenta_corriente 
INSERT INTO cuenta_corriente (rela_cliente, cc_saldo, cc_limite_credito)
VALUES (1, 5000, 10000);

-- tipo_movimiento
INSERT INTO tipo_movimiento (tipo_movimiento_descri)
VALUES ('Pago');
-- ------------------------------------------------------
INSERT INTO producto (
    producto_nombre, producto_codigobarra, producto_preciounitario, 
    producto_cantidad, producto_cantidadmin, producto_descripcion, 
    producto_fecha_alta, producto_estado, rela_tipoproducto, 
    rela_tipoventa, rela_alfabeta, rela_accion_farmaceutica, 
    rela_categoria, rela_marca, rela_droga, rela_forma, 
    rela_metodo_administracion, rela_origen, rela_laboratorio, 
    rela_conservacion
) VALUES (
    'Prueba', '000000000001', 100, 10, 2, 'Producto de prueba', 
    '2024-06-01', 'Activo', 
    1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1
);
-- detalle 
INSERT INTO detalle (rela_producto, detalle_cant_vendida, detalle_subtotal)
VALUES (1, 2, 3000);

INSERT INTO datos_farmacia (farmacia_nombre, farmacia_direccion, farmacia_cuil)
VALUES ('Farmacia Central', 'Av. Siempre Viva 742', '30-12345678-9');

INSERT INTO detalle (rela_producto, detalle_cant_vendida, detalle_subtotal)
VALUES (1, 2, 3000);

-- factura_cabecera 
INSERT INTO factura_cabecera (fac_tipo, fac_numero, fac_fechayhora, rela_farmacia, rela_cliente, rela_detalle)
VALUES ('A', 1001, '2024-06-01 10:00:00', 1, 1, 1);

-- mediopago
INSERT INTO mediopago (mediopago_tipo)
VALUES ('Efectivo');

-- factura_mediopago 
INSERT INTO factura_mediopago (factura_cabecera_id, mediopago_id, importe)
VALUES (1, 1, 3000);

-- recibo 
INSERT INTO recibo (rela_farmacia, rela_cuenta_corriente, rela_tipo_movimiento, recibo_numero_comprobante, recibo_fechayhora, recibo_estado, rela_detalle)
VALUES (1, 1, 1, 5001, '2024-06-01 11:00:00', 'Activo', 1);

-- recibo_mediopago 
INSERT INTO recibo_mediopago (recibo_id, mediopago_id, importe)
VALUES (1, 1, 3000);

-- detalle_compra 
INSERT INTO detalle_compra (rela_producto, dc_cantidad_comprada, dc_subtotal)
VALUES (1, 10, 15000);

-- compras 
INSERT INTO compras (compra_fecha, compra_total, compra_estado, rela_proveedor, rela_detalle_compra)
VALUES ('2024-06-01 12:00:00', 15000, 'Completada', 1, 1);

-- detalle_pedido 
INSERT INTO detalle_pedido (rela_producto, dp_cantidad_sugerida)
VALUES (1, 20);

-- pedido 
INSERT INTO pedido (pedido_fecha, pedido_estado, rela_detalle_pedido)
VALUES ('2024-06-02', 'Pendiente', 1);
-- -------------------------------------------------------------------------------------------------------------------------------------

-- Módulo Caja: tablas básicas
CREATE TABLE caja (
    id_caja INT NOT NULL AUTO_INCREMENT,
    caja_nombre VARCHAR(100) DEFAULT 'Caja Principal',
    usuario_apertura INT DEFAULT NULL,
    apertura_fecha DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    apertura_monto DECIMAL(12,2) NOT NULL DEFAULT 0,
    usuario_cierre INT DEFAULT NULL,
    cierre_fecha DATETIME DEFAULT NULL,
    cierre_monto DECIMAL(12,2) DEFAULT NULL,
    estado ENUM('abierta','cerrada') NOT NULL DEFAULT 'abierta',
    PRIMARY KEY (id_caja),
    FOREIGN KEY (usuario_apertura) REFERENCES persona(id_persona),
    FOREIGN KEY (usuario_cierre) REFERENCES persona(id_persona)
);

CREATE TABLE movimiento_caja (
    id_movimiento INT NOT NULL AUTO_INCREMENT,
    rela_caja INT NOT NULL,
    tipo ENUM('ingreso','egreso') NOT NULL,
    monto DECIMAL(12,2) NOT NULL,
    forma_pago VARCHAR(50) DEFAULT 'efectivo',
    descripcion VARCHAR(255) DEFAULT NULL,
    referencia_tipo VARCHAR(50) DEFAULT NULL,
    referencia_id INT DEFAULT NULL,
    creado_por INT NOT NULL,
    creado_en DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_movimiento),
    FOREIGN KEY (rela_caja) REFERENCES caja(id_caja),
    FOREIGN KEY (creado_por) REFERENCES persona(id_persona)
);

CREATE TABLE caja_auditoria (
    id_audit INT NOT NULL AUTO_INCREMENT,
    entidad VARCHAR(50) NOT NULL,
    entidad_id INT NOT NULL,
    accion VARCHAR(50) NOT NULL,
    detalle TEXT,
    usuario_id INT,
    creado_en DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id_audit)
);

