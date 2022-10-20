<?php

use Illuminate\Support\Facades\Route;

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


Route::group(['as' => 'frontend.'], function () {
    Route::get('/evento/codigos-download/{evento_promotor}', [\App\Http\Controllers\EventoPromotorController::class, 'exportCodigos'])->name('evento.codigo-download');
    Route::get('/', [App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('home');
    Route::get('/gracias', [App\Http\Controllers\Frontend\HomeController::class, 'thankyou'])->name('gracias');
    Route::post('/cliente/save',         [App\Http\Controllers\ClienteController::class, 'sendNotifactionRegister'])->name('sendNotifactionRegister');
    Route::post('/cliente/validar-codigo',         [App\Http\Controllers\ClienteController::class, 'validarCodigo'])->name('validarCodigo');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/home', function(){
        return redirect('/admin/home');
    });
});

Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => ['guest']], function () {
        Route::get('/', 'Auth\LoginController@showLoginForm');
        Route::get('/login', 'Auth\LoginController@showLoginForm');
        Route::post('/login', 'Auth\LoginController@login')->name('login');
    });

    Route::middleware(['auth'])->group(function () {

        Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

        Route::get('/home', 'HomeController@index')->name('home.index');
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard.index');

        Route::get('usuarios', "UserController@index")->name('administrator.index');
        Route::get('/usuarios/load', 'UserController@load')->name('administrator.load');
        Route::post('usuarios/register', "UserController@store")->name('administrator.register');
        Route::get('usuarios/create', "UserController@create")->name('administrator.create');
        Route::get('usuarios/edit/{user}', "UserController@edit")->name('administrator.edit');
        Route::post('usuarios/update/{user}', 'UserController@update')->name('administrator.update');
        Route::post('usuarios/delete', "UserController@delete")->name('administrator.delete');
        Route::post('usuarios/desactive', "UserController@desactive")->name('administrator.desactive');
        Route::post('usuarios/active', "UserController@active")->name('administrator.active');

        /***********Zonas**********/
        route::get('zonas', "ZonaController@index")->name('zona.index');
        Route::get('zonas/load', 'ZonaController@load')->name('zona.load');
        Route::get('zonas/create', "ZonaController@create")->name('zona.create');
        Route::post('zonas/store', "ZonaController@store")->name('zona.store');
        Route::get('zonas/edit/{zona}', "ZonaController@edit")->name('zona.edit');
        Route::post('zonas/update/{zona}', 'ZonaController@update')->name('zona.update');
        Route::post('zonas/delete/{zona}', "ZonaController@destroy")->name('zona.delete');
        Route::post('zonas/desactive', "ZonaController@desactive")->name('zona.desactive');
        Route::post('zonas/active', "ZonaController@active")->name('zona.active');

        /***********Eventos**********/
        route::get('eventos', "EventosController@index")->name('evento.index');
        Route::get('eventos/load', 'EventosController@load')->name('evento.load');
        Route::get('eventos/create', "EventosController@create")->name('evento.create');
        Route::post('eventos/store', "EventosController@store")->name('evento.store');
        Route::get('eventos/edit/{evento}', "EventosController@edit")->name('evento.edit');
        Route::post('eventos/update/{evento}', 'EventosController@update')->name('evento.update');
        Route::post('eventos/delete/{evento}', "EventosController@destroy")->name('evento.delete');
        Route::post('eventos/desactive', "EventosController@desactive")->name('evento.desactive');
        Route::post('eventos/active', "EventosController@active")->name('evento.active');

        Route::get('evento/{evento}/promotores', "EventoPromotorController@index")->name('evento.promotor.index');
        Route::get('evento/{evento}/promotores/load', "EventoPromotorController@load")->name('evento.promotor.load');
        Route::get('evento/{evento}/promotores/create', "EventoPromotorController@create")->name('evento.promotor.create');
        Route::post('evento/promotor/store', "EventoPromotorController@store")->name('evento.promotor.store');
        Route::get('evento/promotor/edit/{evento_promotor}', "EventoPromotorController@edit")->name('evento.promotor.edit');
        Route::post('evento/promotor/update/{evento_promotor}', "EventoPromotorController@update")->name('evento.promotor.update');
        Route::post('evento/promotor/active', "EventoPromotorController@active")->name('evento.promotor.active');
        Route::post('evento/promotor/desactive', "EventoPromotorController@desactive")->name('evento.promotor.desactive');
        Route::post('evento/promotor/destroy/{evento_promotor}', "EventoPromotorController@destroy")->name('evento.promotor.delete');
        Route::get('evento/promotor/export-data/{evento_promotor}', 'EventoPromotorController@exportCodigos')->name('evento.promotor.exportCodigos');
        Route::get('evento/promotor/lista-promotor-filtro', 'EventoPromotorController@listPromotoresFiltro')->name('evento.promtor.list-promtor-filter');
        Route::post('evento/promotor/export-data-excel', 'EventoPromotorController@exportCodigoPromotor')->name('evento.promotor.exportCodigosPromotor');

        /***********Promotores**********/
        route::get('promotores', "PromotorController@index")->name('promotor.index');
        Route::get('promotores/load', 'PromotorController@load')->name('promotor.load');
        Route::get('promotores/create', "PromotorController@create")->name('promotor.create');
        Route::post('promotores/store', "PromotorController@store")->name('promotor.store');
        Route::get('promotores/edit/{promotor}', "PromotorController@edit")->name('promotor.edit');
        Route::post('promotores/update/{promotor}', 'PromotorController@update')->name('promotor.update');
        Route::post('promotores/delete/{promotor}', "PromotorController@destroy")->name('promotor.delete');
        Route::post('promotores/desactive', "PromotorController@desactive")->name('promotor.desactive');
        Route::post('promotores/active', "PromotorController@active")->name('promotor.active');


        route::get('dashboard/load', "DashboardController@load")->name('reporte.load');

        Route::get('clientes', "ClienteController@index")->name('cliente.index');
        Route::get('clientes/load', 'ClienteController@load')->name('cliente.load');
        Route::post('cliente/register', "ClienteController@store")->name('cliente.register');
        Route::get('cliente/create', "ClienteController@create")->name('cliente.create');
        Route::get('cliente/edit/{cliente}', "ClienteController@edit")->name('cliente.edit');
        Route::post('cliente/update/{cliente}', 'ClienteController@update')->name('cliente.update');
        Route::post('cliente/delete', "ClienteController@delete")->name('cliente.delete');
        Route::post('cliente/desactive', "ClienteController@desactive")->name('client.desactive');
        Route::post('cliente/active', "ClienteController@active")->name('cliente.active');
        Route::post('cliente/export-data-excel', 'ClienteController@exportExcel')->name('cliente.export-data');



        Route::get('socios', "SociosController@index")->name('socio.index');
        Route::get('socios/load', 'SociosController@load')->name('socio.load');
        Route::post('socios/register', "SociosController@store")->name('socio.store');
        Route::get('socios/create', "SociosController@create")->name('socio.create');
        Route::get('socios/edit/{socio}', "SociosController@edit")->name('socio.edit');
        Route::post('socios/update/{socio}', 'SociosController@update')->name('socio.update');
        Route::post('socios/delete', "SociosController@delete")->name('socio.delete');
        Route::post('socios/desactive', "SociosController@desactive")->name('socio.desactive');
        Route::post('socios/active', "SociosController@active")->name('socio.active');
        Route::get('socios/import', 'SociosController@formImport')->name('socio.importForm');
        Route::post('socios/import/save', 'SociosController@importSave')->name('socio.import-save');
        Route::post('socios/export-data-excel', 'SociosController@exportExcel')->name('socio.import-data');

        Route::get('filtro/lista-eventos', 'FiltersController@listaEventos')->name('filtro.evento-lista');
        Route::get('filtro/lista-zonas', 'FiltersController@listaZonas')->name('filtro.lista-zona');



        Route::get('cliente/verificar-datos/{cliente}', 'ClienteController@verificarqr')->name('cliente.verificar.qr');
        Route::post('cliente/verificar-datos/{cliente}/store', 'ClienteController@verificarQrStore')->name('cliente.store.qr');
        Route::get('cliente/confirmacion-datos/gracias', 'ClienteController@graciasqr')->name('cliente.gracias.qr');
        Route::get('socio/verificar-datos/{socio}', 'SociosController@verificarqr')->name('socio.verificar.qr');
        Route::post('socio/verificar-datos/{socio}/store', 'SociosController@verificarQrStore')->name('socio.store.qr');
        Route::get('socio/confirmacion-datos/gracias', 'SociosController@graciasqr')->name('socio.gracias.qr');


        route::get('reporte/general', "ReportesController@index")->name('reporte.general');
        route::get('reporte/general/load', "ReportesController@load")->name('reporte.general.load');
        Route::post('reporte-general/export-data-excel', 'ReportesController@exportExcel')->name('reporte.general.import-data');

        route::get('reporte/evento-zona', "ReportesController@indexEventoZona")->name('reporte.evento-zona');
        route::get('reporte/evento-zona/load', "ReportesController@loadEventoZona")->name('reporte.evento-zona.load');
        Route::get('reporte-evento-zona/export-data', 'ReportesController@exportEventoZonaExcel')->name('reporte.evento-zona.import-data');

        route::get('reporte/clientes-por-promotor', "ReportesController@indexPromotores")->name('reporte.clientes-por-promotor');
        route::get('reporte/clientes-por-promotor/load', "ReportesController@loadPromotres")->name('reporte.clientes-por-promotor.load');

        route::get('reporte/list-zonas', "ReportesController@getListZonas")->name('reporte.list-zonas');
        route::get('reporte/list-promotores', "ReportesController@getListPromotor")->name('reporte.list-promotor');
        Route::get('reporte-cliente-promotor/export-data', 'ReportesController@exportClientePromotorExcel')->name('reporte.cliente-promotor.import-data');
        /*Route::get('/roles', 'RoleController@index')->name('role.index');
        Route::get('/roles/load', 'RoleController@load')->name('role.load');
        Route::get('roles/create', 'RoleController@create')->name('role.create');
        Route::post('roles/store', "RoleController@store")->name('role.store');
        Route::get('roles/edit/{role}', "RoleController@edit")->name('role.edit');
        Route::post('roles/update/{role}', 'RoleController@update')->name('role.update');
        Route::post('roles/destroy/{role}', "RoleController@destroy")->name('role.destroy');
        Route::post('roles/desactive', "RoleController@desactive")->name('role.desactive');
        Route::post('roles/active', "RoleController@active")->name('role.active');
        Route::get('roles/{id}/access/', "AccessController@index")->name('access.index');
        Route::get('{role}/access', 'AccessController@getAccess');
        Route::get('/access/{role}', 'AccessController@getAccess')->name('access.load');
        Route::post('access/register', 'AccessController@store');

        Route::get('socios', "ClientController@index")->name('client.index');
        Route::get('/socios/load', 'ClientController@load')->name('client.load');
        Route::post('socios/register', "ClientController@store")->name('client.register');
        Route::get('socios/create', "ClientController@create")->name('client.create');
        Route::get('socios/edit/{cliente}', "ClientController@edit")->name('client.edit');
        Route::post('socios/update/{cliente}', 'ClientController@update')->name('client.update');
        Route::post('socios/delete', "ClientController@delete")->name('client.delete');
        Route::post('socios/desactive', "ClientController@desactive")->name('client.desactive');
        Route::post('socios/active', "ClientController@active")->name('client.active');

        Route::get('/socios/load-compras/{cliente}', 'ClientController@getCompras')->name('client.load-compras');

        Route::get('socios/export/', 'ClientController@exportSociosIngreso')->name('cliente.exportIngresos');
        Route::get('socios/import', 'ClientController@formImportRefinanciados')->name('cliente.importRefinancimiento');
        Route::post('socios/import/save', 'ClientController@importRefinancimientoSave')->name('cliente.importRefinancimiento-save');

        Route::get('socios/delete-form', 'ClientController@formDeleteData')->name('cliente.delete-data-form');
        Route::post('socios/delete/save', 'ClientController@deleteDataSave')->name('cliente.delete-data-save');


        Route::get('marcas', "MarcaController@index")->name('marca.index');
        Route::get('marcas/load', 'MarcaController@load')->name('marca.load');
        Route::get('marcas/create', "MarcaController@create")->name('marca.create');
        Route::post('marcas/store', "MarcaController@store")->name('marca.store');
        Route::get('marcas/edit/{marca}', "MarcaController@edit")->name('marca.edit');
        Route::post('marcas/update/{marca}', 'MarcaController@update')->name('marca.update');
        Route::post('marcas/delete/{marca}', "MarcaController@destroy")->name('marca.delete');
        Route::post('marcas/desactive', "MarcaController@desactive")->name('marca.desactive');
        Route::post('marcas/active', "MarcaController@active")->name('marca.active');
        Route::post('marcas/update-order', "MarcaController@updateOrder")->name('marca.update-order');
        /******************************marcas ofertas*******************
        Route::get('marcas/{marca}/ofertas', "OfertaController@index")->name('marca.oferta.index');
        Route::get('marcas/{marca}/oferta/load', "OfertaController@load")->name('marca.oferta.load');
        Route::get('marcas/{marca}/oferta/create', "OfertaController@create")->name('marca.oferta.create');
        Route::post('marcas/oferta/store', "OfertaController@store")->name('marca.oferta.store');
        Route::get('marcas/oferta/edit/{oferta}', "OfertaController@edit")->name('marca.oferta.edit');
        Route::post('marcas/oferta/update/{oferta}', "OfertaController@update")->name('marca.oferta.update');
        Route::post('marcas/oferta/active', "OfertaController@active")->name('marca.oferta.active');
        Route::post('marcas/oferta/desactive', "OfertaController@desactive")->name('marca.oferta.desactive');
        Route::delete('marcas/oferta/destroy/{oferta}', "OfertaController@destroy")->name('marca.oferta.destroy');

        Route::get('/getListIngreso', "ClientController@listFilterIngreso")->name('filter.ingreso');
        Route::get('marca/list-tipos', 'MarcaController@getTipoMarca')->name('marca.list-tipo');
        Route::get('marca/get-list-filter', 'MarcaController@getMarcaFilter')->name('marca.list-filter');

        /******************************productos*******************
        Route::get('productos', "ProductoController@index")->name('producto.index');
        Route::get('productos/load', 'ProductoController@load')->name('producto.load');
        Route::get('productos/create', "ProductoController@create")->name('producto.create');
        Route::post('productos/store', "ProductoController@store")->name('producto.store');
        Route::get('productos/edit/{product}', "ProductoController@edit")->name('producto.edit');
        Route::post('productos/update/{product}', 'ProductoController@update')->name('producto.update');
        Route::post('productos/delete/{producto}', "ProductoController@destroy")->name('producto.delete');
        Route::post('productos/desactive', "ProductoController@desactive")->name('producto.desactive');
        Route::post('productos/active', "ProductoController@active")->name('producto.active');
        Route::post('productos/desactive-popular', "ProductoController@desactivePopular")->name('producto.desactive-popular');
        Route::post('productos/active-popular', "ProductoController@activePopular")->name('producto.active-popular');
        Route::post('productos/desactive-visto', "ProductoController@desactiveVisto")->name('producto.desactive-visto');
        Route::post('productos/active-visto', "ProductoController@activeVisto")->name('producto.active-visto');
        Route::get('productos/gallery/load/{product}', 'ProductoController@loadGallery')->name('products.gallery.load');
        Route::post('productos/gallery/update-order', "ProductoController@updateOrderImageGallery")->name('products.gallery.update-order');
        Route::post('productos/gallery/destroy/{product}/{product_image}', "ProductoController@destroyImageGallery")->name('products.gallery.destroy');
        Route::get('productos/show-ficha_tecnia/{producto}', "ProductoController@showFile")->name('products.showFile');


        /******************************productos color*******************
        Route::get('producto/{product}/color', "ProductoColorImagenController@index")->name('producto.color.index');
        Route::get('producto/{product}/color/load', "ProductoColorImagenController@load")->name('producto.color.load');
        Route::get('producto/{product}/color/create', "ProductoColorImagenController@create")->name('producto.color.create');
        Route::post('producto/color/store', "ProductoColorImagenController@store")->name('producto.color.store');
        Route::post('producto/color/active', "ProductoColorImagenController@active")->name('producto.color-image.active');
        Route::post('producto/color/desactive', "ProductoColorImagenController@desactive")->name('producto.color-image.desactive');
        Route::post('producto/color/destroy/{producto_color_image}', "ProductoColorImagenController@destroy")->name('producto.color-image.destroy');
        */
    });
});



Route::get('/clear-cache', function () {
    echo Artisan::call('config:clear');
    echo Artisan::call('config:cache');
    echo Artisan::call('cache:clear');
    echo Artisan::call('route:clear');
});
