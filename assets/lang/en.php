<?php

define('idioma', 'Oscuro');
define('lang', 'es');
define('color', 'secondary');
define('salir', 'Salir');
define('theme', 'lumen');

// Login
define('titulo', 'Bienvenido a Drop2');
define('codigo', 'Codigo');
define('pass', 'Contraseña');
define('btnIngresar', 'Ingresar');
define('btnOlvidoPass', 'Olvide Mi Contraseña');

// login Alerts
define('vacios', 'Existen campos vacios');
define('passIncorret', 'Contraseña Incorrecta');
define('notExists', 'El Usuario No Existe');
define('sendEmail', 'Revise su Correo se ha enviado su Contraseña');
define('inactivo', 'El Usuario Esta Inactivado');

// Recuperar Contraseña
define('tituloRecuperarPass', 'Recuperar Contraseña');
define('btnEnviarEmail', 'Enviar');
define('regresar', 'Regresar');

// Menu
define('inicio', 'Inicio');
//
define('restaurantes', 'Responsables');
define('restaurantesDeudor', 'Deudor');
// ------
define('gestionRestaurante', 'Gestionar Responsables');
define('registrarUsuario', 'Registrar Usuario');
define('consultUsuarios', 'Consultar Usuarios');
define('gestionCargos', 'Gestionar Cargos');
//
define('productos', 'Deudor');
define('productosPrestamo', 'Prestamo');
// ------
define('registrarProduct', 'Registrar Deudor');
define('registrarPrest', 'Registrar Prestamo');
//
define('stock', 'Seguimiento');
// ------
define('consultStock', 'Consultar Seguimiento');
define('registrarStock', 'Registrar Seguimiento');
//
define('merma', 'Pago');
// ------
define('registrarMerma', 'Registrar Pago');
define('consultMerma', 'Consultar Pago');
define('gestionTipoMerma', 'Gestionar Tipos de Pagos');
//
define('menaje', 'Menaje');

// Index
define('tituloIndex', 'Bienvenido al Sistema Drop2 que controla tus Prestamos');
define('textoIndex1', 'Este Sistema facilitara el control de registro de Deudores, registro de prestamos con su debido porcentaje, cantidad de cuotas y valor a prestar, alerta de pago de la cuota, para todos los prestamistas de Colombia.');
define('textoIndex2', 'Cambiando el metodo de realizar los procesos de forma manual de libretas y pasarlos a este Sistema de Información.');

// Form General
define('registrar', 'Registrar');
define('actualizar', 'Actualizar');

// Tablas General
define('editar', 'Editar');
define('eliminar', 'Eliminar');
define('descargar', 'Descargar');
define('activar', 'Activar');
define('inactivar', 'Inactivar');
define('confirmar', 'Confirmar');
define('pregunta', 'el usuario?');
define('acciones', 'Acciones');
define('cancelar', 'Cancelar');
define('nombre', 'Nombre');
define('apellido', 'Apellido');
define('producto', 'Producto');
define('cantidad', 'Pago');
define('fecha', 'Fecha de Prestamo');
define('fechaMerma', 'Fecha de Pago');
define('motivo', 'Motivo');
define('perdida', 'Restante');
define('tipoMerma', 'Tipo de Pago');
define('precio', 'Prestamo (Precio)');
define('deuda', 'Deuda (Restante)');
define('email', 'Email');
define('contraseña', 'Contraseña');
define('cargo', 'Cargo');
define('restaurante', 'Responsable');
define('controlResponable', 'Control de Responsables');
define('direccion', 'Dirección');
define('tittleTableRestaurante', 'Lista de Responsables');
define('tittleTableUsuarios', 'Lista de Usuarios');
define('tittleTableCargos', 'Lista de Cargos');
define('tittleTableTipoMerma', 'Lista de Tipos de Merma');
define('tittleTableProducto', 'Lista de Deudores');
define('tittleTableStock', 'Lista de Stock');
define('tittleTableMerma', 'Lista de Merma');
define('generarPDF', 'Generar PDF');

// Restaurante
define('tittleRest', 'Control de Responsables');
define('formTittleRest1', 'Nuevo Responsable');
define('formTittleRest2', 'Editar Responsable');
define('nombreRestaurante', 'Nombre Responsable');
define('direccionRestaurante', 'Dirección del Responsable');
// Restaurante Alerts
define('restRegistrado', 'Responsable Registrado Exitosamente');
define('restEditado', 'Responsable Editado Exitosamente');
define('restEliminado', 'Responsable Eliminado Exitosamente');
define('imposibleEliminar', 'No Se Puede Eliminar');

// Usuario
define('tittleUser', 'Usuarios Registrados');
define('tittleRegisUsuario1', 'Registro de Usuarios');
define('tittleRegisUsuario2', 'Editar Usuario');
define('selectCargo', 'Seleccionar Cargo');
define('elija', 'Elija...');
define('selectRestaurante', 'Seleccionar Responsable');
define('nombreUsuario', 'Nombre');
define('apellidoUsuario', 'Apellido');
define('emailUsuario', 'Email');
define('passUsuario', 'Contraseña');
define('regisNuevoUsuario', 'Registrar Nuevo Usuario');
define('existUser', 'El Usuario Ya Existe');

// Usuario Alerts
define('userRegistrado', 'Usuario Registrado Exitosamente');
define('userEditado', 'Usuario Editado Exitosamente');
define('userCambiado', 'Usuario Cambiado Exitosamente');

// Cargo
define('tittleCargo', 'Control de Cargos');
define('formTittleCargo1', 'Nuevo Cargo');
define('formTittleCargo2', 'Editar Cargo');
define('nombreCargo', 'Nombre Cargo');
// Cargo Alerts
define('cargoRegistrado', 'Cargo Registrado Exitosamente');
define('cargoEditado', 'Cargo Editado Exitosamente');
define('cargoEliminado', 'Cargo Eliminado Exitosamente');

// Tipo Merma
define('tittleTipoMerma', 'Control de Tipos de Merma');
define('formTittleTipoMerma1', 'Nuevo Tipo de Merma');
define('formTittleTipoMerma2', 'Editar Tipo');
define('nombreTipoMerma', 'Nombre Tipo');
// Tipo Merma Alerts
define('tipoMermaRegistrado', 'Tipo de Merma Registrado Exitosamente');
define('tipoMermaEditado', 'Tipo de Merma Editado Exitosamente');
define('tipoMermaEliminado', 'Tipo de Merma Eliminado Exitosamente');

// Producto
define('tittleProducto', 'Control de Deudores');
define('formTittleProducto1', 'Nuevo Prestamo');
define('formTittleProducto2', 'Editar ID Deudor Nº ');
define('selectNombreDeudor', 'Nombre Deudor');
define('nombreProducto', 'Seleccionar Deudor');
define('precioProducto', 'Prestamo Deudor');
define('precioProductoTotal', 'Prestamo (Precio)');
define('deudaRestante', 'Deuda (Restante)');
define('mesesProducto', '¿A cuantos meses?');
define('numeroMeses', 'Numero de meses');
// Producto Alerts
define('productoRegistrado', 'Deudor Registrado Exitosamente');
define('productoEditado', 'Deudor Editado Exitosamente');
define('productoEliminado', 'Deudor Eliminado Exitosamente');

// Stock
define('tittleStock', 'Control de Stock');
define('tittleRegisStock1', 'Registro de Stock');
define('tittleRegisStock2', 'Editar Stock');
define('selectProducto', 'Seleccionar Deudor');
define('selectDeudor', 'Seleccionar Deudor');
define('cantidadActualStock', 'Cantidad de Stock Actual = ');
define('addStock', 'Agregar / Disminuir Stock');
define('mensajeCantidad', 'La cantidad sería menor que 0');
define('fechaVenciProducto', 'Fecha Vencimiento');
define('loteStock', 'Lote');
define('regisNuevoStock', 'Registrar Nuevo Stock');
define('existStock', 'El producto ya esta Registrado');
// Stock Alerts
define('stockRegistrado', 'Stock Registrado Exitosamente');
define('stockEditado', 'Stock Editado Exitosamente');
define('stockEliminado', 'Stock Eliminado Exitosamente');

// Merma
define('tittleMerma', 'Control de Pagos');
define('tittleRegisMerma1', 'Registro de Pagos');
define('tittleRegisMerma2', 'Editar Pago');
define('cantidadActualMerma', 'Valor de Pago Actual = ');
define('addMerma', 'Agregar / Disminuir Valor de Pago');
define('regisNuevaMerma', 'Registrar Nuevo Pago');
// Merma Alerts
define('mermaRegistrado', 'Pago Registrado Exitosamente');
define('mermaEditado', 'Pago Editado Exitosamente');
define('mermaEliminado', 'Pago Eliminado Exitosamente');