<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Support\Facades\Route;

Route::get('/', 'ClienteController@index');

Route::get('cliente','ClienteController@show');

Route::get('cliente/buscar','ClienteController@buscar');//ver como mostrar nombre facultad
Route::get('cliente/create','ClienteController@create');
Route::get('cliente/create/alta','ClienteController@alta');
Route::get('editarCliente/{ISBN}','ClienteController@edit');
Route::get('cliente/edit/modificacion','ClienteController@modificacion');
 

Route::get('nuevoLibro', function () {
    return view('createLibro');
});

Route::get('/libro/eliminar', function () {
    return view('eliminarLibro');
});

Route::get('/editar','LibroController@editar');

Route::get('/crearLib', 'LibroController@store');

Route::get('/BuscarLib', 'LibroController@buscar');

Route::get('/consultarLib', 'LibroController@consultar');

Route::get('/eliminarLib', 'LibroController@eliminar');

Route::get('/modificarLib', 'LibroController@modificar');

Route::get('/modificarStock','LibroController@agregarStock');

Route::resource('libro','LibroController');


//PAGINA PRINCIPAL

Route::get('/paginaprincipal', 'LibroController@paginaprincipal');
Route::get('/paginaprincipalBuscador', 'LibroController@paginaprincipalBuscador');
Route::get('/todos', 'LibroController@todos');


//Exel
Route::get('/exelFunciones', 'ExelController@show');
Route::get('/exelExportar', 'ExelController@exportar');
Route::post('/exelImportar', 'ExelController@importar');
Route::get('/exelPreparacion', 'ExelController@ayuda');
Route::get('/test', 'ExelController@test');


//VENTAS

//ACCEDER PARA UNA NUEVA VENTA
Route::get('/altaVentas', 'VentaController@index');

//RUTA PARA EL BUSCADOR EN TIEMPO REAL
Route::get('nombres/buscador','LibroController@buscador');//nombres de libros
Route::get('nombresClientes/buscador','ClienteController@buscadorCliente');//nombres de clientes


//TODAS LAS VENTAS
Route::get('/todasVentas', 'VentaController@Ventas');

//BORRAR VENTA
Route::get('formulario', 'VentaController@deleteVenta');


//MODIFICAR VENTA 
Route::get('ConfirmarModificacion', 'VentaController@updateVenta');


//INSERTAR VENTA
Route::get('InsertVenta', 'VentaController@insertVenta');

//NOTIFICACIONES
//CREAR NOTIFICACION
Route::get('altaNotificacion','LibroController@altaNotificar');
//MOSTRAR NOTIFICACIONES
Route::get('notificaciones','LibroController@verNotificacion');
//ENVIAR MAIL
Route::get('enviarMail','LibroController@enviarMail');
//ELIMINAR NOTIFICACION
Route::get('bajaNotificacion/{ISBN}','LibroController@bajaNotificacion');
//MODIFICACION NOTIFICACION A LEIDA
Route::get('modificarNotificacion/{ISBN}','LibroController@modificarNotificacion');

//CREAR DESCUENTO (muestra la vista que se encarga de recepcionar el libro al cual se le desea crear un descuento)
Route::get('descuento/crear','DescuentoController@create');

//BUSCAR LIBRO (una ruta para la llamada AJAX que se encarga de encontrar el libro que se solicita en la 
//vista CREAR DESCUENTO)
Route::get('descuento/buscarLibros','DescuentoController@buscarLibros');

//REGISTRAR DESCUENTO (una vez recibe el libro de la vista CREAR DESCUENTO, ofrece los elementos visuales para
//finalizar con el registro del nuevo descuento, vinculado a un libro (libroXdescuento))
Route::get('descuento/crear/confirmar/{ID}','DescuentoController@vistaRegistrarDescuento');

//EJECUTAR ALTA DEL DESCUENTO
Route::get('descuento/crear/alta','DescuentoController@store');

//MODIFICAR DESCUENTO
Route::get('descuento/modificar/{ID}','DescuentoController@modificar');

//BUSCAR DESCUENTO
Route::get('descuento/modificar/buscarDescuento','DescuentoController@buscarDes');

//EJECUTAR MODIFICACION DEL  DESCUENTO
Route::get('descuento/modificacion/alta','DescuentoController@modificarAlta');

//MOSTRAR DESCUENTOS
Route::get('descuento','DescuentoController@show');

//MOSTRAR DESCUENTOS FILTRADOS POR UNA BUSQUEDA
Route::get('descuento/buscar','DescuentoController@showFiltrado');

//ELEGIR DESCUENTO A ELIMINAR
Route::get('descuento/eliminar/{ID}','DescuentoController@destroy');

//EJECUTAR ELIMINACION DEL DESCUENTO
Route::get('descuento/eliminar/alta','DescuentoController@show');



//FACTURACION
Route::get('reciboAlta','VentaController@insertVenta');
Route::get('talonario/mailFacturacion/{ID}','TalonarioController@enviarMailFacturacion');

//TALONARIOS
Route::get('talonario','TalonarioController@show');//Mostrar
Route::get('agregarTalonario','TalonarioController@store');//FormAgregar
Route::get('agregarTalonario/alta','TalonarioController@create');//Agregar