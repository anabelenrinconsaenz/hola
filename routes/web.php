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

Route::group(['middleware' => 'auth'], function () {

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

    Route::post('/modificarLib', 'LibroController@modificar');

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
        //BUSCADOR DE CLIENTES X VENTA
        Route::get('/clientes/buscadorVentas','VentaController@buscadorClientexventa');
        Route::get('/todasVentas/buscadorAJAX','VentaController@buscadorTodasVentas');//VUELVO A MOSTRAR TODAS LAS VENTAS

        //MODIFICAR VENTA
        Route::get('formulario', 'VentaController@modificarVenta');
        Route::get('ConfirmarModificacion', 'VentaController@updateVenta');

        //BORRAR VENTA
        Route::get('/eliminarVenta', 'VentaController@eliminarVenta');///////////////
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
    //Route::get('descuento/crear','DescuentoController@create');

    //BUSCAR LIBRO (una ruta para la llamada AJAX que se encarga de encontrar el libro que se solicita en la 
    //vista CREAR DESCUENTO)
    Route::get('descuento/buscarLibros','DescuentoController@buscarLibros');

    //REGISTRAR DESCUENTO (una vez recibe el libro de la vista CREAR DESCUENTO, ofrece los elementos visuales para
    //finalizar con el registro del nuevo descuento, vinculado a un libro (libroXdescuento))
    Route::get('descuento/crear','DescuentoController@vistaRegistrarDescuento');

    //EJECUTAR ALTA DEL DESCUENTO
    Route::get('descuento/crear/alta','DescuentoController@store');

    //MODIFICAR DESCUENTO
    Route::get('descuento/modificar/{ID}','DescuentoController@modificar');

    //BUSCAR DESCUENTO
    Route::get('descuento/modificar/buscarDescuento','DescuentoController@buscarDes');

    //EJECUTAR MODIFICACION DEL  DESCUENTO
    Route::post('descuento/modificacion/alta','DescuentoController@modificarAlta');

    //MOSTRAR DESCUENTOS
    Route::get('descuento','DescuentoController@show');

    //MOSTRAR DESCUENTOS FILTRADOS POR UNA BUSQUEDA
    Route::get('descuento/buscar','DescuentoController@showFiltrado');

    //ELEGIR DESCUENTO A ELIMINAR
    Route::get('descuento/eliminar/{ID}','DescuentoController@destroy');

    //EJECUTAR ELIMINACION DEL DESCUENTO
    Route::get('descuento/eliminar/alta','DescuentoController@show');




    //FACTURACION
//Route::get('reciboAlta','VentaController@imprimir');
Route::get('talonario/mailFacturacion/{ID}','TalonarioController@enviarMailFacturacion');
Route::get('guardarRecibo','VentaController@guardarRecibo');
//TALONARIOS
Route::get('talonario','TalonarioController@show');//Mostrar
Route::get('agregarTalonario','TalonarioController@store');//FormAgregar
Route::get('agregarTalonario/alta','TalonarioController@create');//Agregar



Route::name('print')->get('/imprimir', 'VentaController@imprimir');
    
});

//RUTAS PARA INICIO DE SESION

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// Email Verification Routes...
Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');

Route::get('/home', 'HomeController@index')->name('home');
