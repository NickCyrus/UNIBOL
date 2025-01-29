<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\categoriesController;
use App\Http\Controllers\contratosController;
use App\Http\Controllers\DinamicController;
use App\Http\Controllers\diversosController;
use App\Http\Controllers\logUserController;
use App\Http\Controllers\modulesController;
use App\Http\Controllers\perfilController;
use App\Http\Controllers\perfilesController;
use App\Http\Controllers\personalController;
use App\Http\Controllers\usuariosController;
use App\Http\Controllers\equiposController;
use App\Http\Controllers\equipossubController;
use App\Http\Controllers\ie\CostCenters;
use App\Http\Controllers\ie\IeCostCenter;
use App\Http\Controllers\ie\IncomeExpenses;
use App\Http\Controllers\ie\SubCostCenter;
use App\Http\Controllers\ie\Thirdparties;
use App\Http\Controllers\ie\IeBankBalancesController;
use App\Http\Controllers\itemsController;
use App\Http\Controllers\materialesController;
use App\Http\Controllers\prestecController;
use App\Http\Controllers\salariesController;
use App\Http\Controllers\salariesnotownerController;
use App\Http\Controllers\salariesownerController;
use App\Http\Controllers\taxesController;
use App\Models\quotesModel;
use Illuminate\Support\Facades\Route;
use Barryvdh\DomPDF\Facade\Pdf;

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
/*
Route::get('/', function () {
    return view('app');
});



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Auth::routes();

*/
Route::post('login', [LoginController::class, 'login']);
Route::match(['get', 'post'], 'logout', [LoginController::class, 'logout'])->name('logout');

Route::get('login', function () {
    return view('login');
})->name('login');

Route::get('errorAccess',function(){
    return view('access-invalid');
})->name('errorAccess');

Route::group(['middleware' => ['auth','ControlModules'] ], function () {

    Route::get('/', function () { return view('dashboard'); });
    Route::get('dashboard', function () { return view('dashboard'); })->name('home');
    Route::get('profile', [perfilController::class , 'index']  )->name('profile');
    Route::get('profile/log-access', [perfilController::class , 'logaccess']  )->name('logaccess');
    Route::post('profile/changepassword', [perfilController::class , 'changepassword']  )->name('profile.changepassword');
    Route::get('logsusers', [logUserController::class, 'index'])->name('logsusers');

   
    Route::group(['prefix'=>'/modules' ], function(){
    // modules
        Route::get('/', [modulesController::class,'index'])->name('modules');
        Route::post('add', [modulesController::class,'add'])->name('modules.add');
        Route::post('{id}/edit', [modulesController::class,'edit'])->name('modules.edit');
        Route::get('{id}/delete', [modulesController::class,'delete'])->name('modules.delete');
        Route::post('save', [modulesController::class,'save'])->name('modules.save');
    });

    

    // Pefiles
    Route::get('perfiles', [perfilesController::class,'index'])->name('perfiles');
    Route::post('perfiles/add', [perfilesController::class,'add'])->name('perfiles.add');
    Route::post('perfiles/{id}/edit', [perfilesController::class,'edit'])->name('perfiles.edit');
    Route::get('perfiles/{id}/delete', [perfilesController::class,'delete'])->name('perfiles.delete');
    Route::post('perfiles/save', [perfilesController::class,'save'])->name('perfiles.save');

    // Personal
    Route::get('personal', [personalController::class,'index'])->name('personal');
    Route::post('personal/add', [personalController::class,'add'])->name('personal.add');
    Route::post('personal/{id}/edit', [personalController::class,'edit'])->name('personal.edit');
    Route::get('personal/{id}/delete', [personalController::class,'delete'])->name('personal.delete');
    Route::post('personal/save', [personalController::class,'save'])->name('personal.save');

    // Usuarios
    Route::get('usuarios', [usuariosController::class,'index'])->name('usuarios');
    Route::post('usuarios/add', [usuariosController::class,'add'])->name('usuarios.add');
    Route::post('usuarios/{id}/edit', [usuariosController::class,'edit'])->name('usuarios.edit');
    Route::get('usuarios/{id}/delete', [usuariosController::class,'delete'])->name('usuarios.delete');
    Route::post('usuarios/save', [usuariosController::class,'save'])->name('usuarios.save');

    // Equipos
    Route::get('equipos', [ equiposController::class , 'index'])->name('equipos');
    Route::post('equipos/add', [equiposController::class,'add'])->name('equipos.add');
    Route::post('equipos/{id}/edit', [equiposController::class,'edit'])->name('equipos.edit');
    Route::get('equipos/{id}/delete', [equiposController::class,'delete'])->name('equipos.delete');
    Route::post('equipos/save', [equiposController::class,'save'])->name('equipos.save');

    // Equipos sub contratados
    Route::get('equipossub', [ equipossubController::class , 'index'])->name('equipossub');
    Route::post('equipossub/add', [equipossubController::class,'add'])->name('equipossub.add');
    Route::post('equipossub/{id}/edit', [equipossubController::class,'edit'])->name('equipossub.edit');
    Route::get('equipossub/{id}/delete', [equipossubController::class,'delete'])->name('equipossub.delete');
    Route::post('equipossub/save', [equipossubController::class,'save'])->name('equipossub.save');



    // Materiales
    Route::get('materiales', [ materialesController::class , 'index'])->name('materiales');
    Route::post('materiales/add', [materialesController::class,'add'])->name('materiales.add');
    Route::post('materiales/{id}/edit', [materialesController::class,'edit'])->name('materiales.edit');
    Route::get('materiales/{id}/delete', [materialesController::class,'delete'])->name('materiales.delete');
    Route::post('materiales/save', [materialesController::class,'save'])->name('materiales.save');

    // Items contratos

    Route::get('items', [ itemsController::class , 'index'])->name('items');
    Route::post('items/add', [itemsController::class,'add'])->name('items.add');
    Route::post('items/{id}/edit', [itemsController::class,'edit'])->name('items.edit');
    Route::get('items/{id}/delete', [itemsController::class,'delete'])->name('items.delete');
    Route::post('items/save', [itemsController::class,'save'])->name('items.save');

    // Contratos
    Route::get('contratos', [ contratosController::class , 'index'])->name('contratos');
    Route::post('contratos/add', [contratosController::class,'add'])->name('contratos.add');
    Route::post('contratos/{id}/edit', [contratosController::class,'edit'])->name('contratos.edit');
    Route::get('contratos/{id}/delete', [contratosController::class,'delete'])->name('contratos.delete');
    Route::post('contratos/save', [contratosController::class,'save'])->name('contratos.save');

    // Contratos Ajax
    Route::match(['get', 'post'], 'contratos/ajax/{opc}', [ contratosController::class , 'ajax'])->name('contratos.ajax');

    // Contratos Item
    Route::get('contratos/{id}/items', [contratosController::class,'items'])->name('contratos.items');
    Route::get('contratos/{id}/items/add', [contratosController::class,'add_item'])->name('contratos.items.add');
    Route::get('contratos/{id}/items/{item}/delete', [contratosController::class,'delete_item'])->name('contratos.items.delete');
    Route::post('contratos/{id}/items/save', [contratosController::class,'items_save'])->name('contratos.items.save');

    // Contratos cotizaciones
    Route::get('contratos/{id}/cotizaciones', [contratosController::class,'cotizaciones'])->name('contratos.cotizaciones');
    Route::post('contratos/{id}/cotizaciones/add', [contratosController::class,'add_cotizacion'])->name('contratos.cotizaciones.add');
    Route::post('contratos/{id}/cotizaciones/pdf', [contratosController::class,'showpdf'])->name('contratos.cotizaciones.pdf');

    Route::post('contratos/{id}/cotizaciones/{item}/edit', [contratosController::class,'edit_cotizacion'])->name('contratos.cotizaciones.edit');
    Route::get('contratos/{id}/cotizaciones/{item}/items', [contratosController::class,'items_cotizacion'])->name('contratos.cotizaciones.items');
    Route::get('contratos/{id}/cotizaciones/{item}/delete', [contratosController::class,'delete_cotizacion'])->name('contratos.cotizaciones.delete');
    Route::post('contratos/{id}/cotizaciones/save', [contratosController::class,'save_cotizaciones'])->name('contratos.cotizaciones.save');

    Route::post('contratos/{id}/cotizaciones/{item}/item/{iditem?}', [contratosController::class,'item_cotizacion'])->name('contratos.cotizaciones.item.add');
    Route::get('contratos/{id}/cotizaciones/{item}/item/{iditem?}/delete', [contratosController::class,'itemdelete_cotizacion'])->name('contratos.cotizaciones.item.delete');

    Route::post('contratos/{id}/cotizaciones/{item}/item/{iditem?}/save', [contratosController::class,'itemsave_cotizacion'])->name('contratos.cotizaciones.item.save');
    Route::post('contratos/cotizaciones/{item}/send-mail', [contratosController::class,'sendmail_cotizacion'])->name('contratos.cotizaciones.sendmail');
    Route::post('contratos/cotizaciones/logsend/{id?}', [contratosController::class,'logSend'])->name('contratos.cotizaciones.item.logsend');
    
    Route::get('contratos/cotizaciones/prestec/pdf/{id}', [prestecController::class,'makePdf'])->name('contratos.cotizaciones.prestec.pdf');
    Route::get('contratos/cotizaciones/prestec/pdf/{id}/{action?}', [prestecController::class,'makePdf'])->name('contratos.cotizaciones.prestec.pdf.download');
    
    Route::get('contratos/cotizaciones/prestec/{id}/{acttab?}', [prestecController::class,'index'])->name('contratos.cotizaciones.prestec');
    Route::get('contratos/cotizaciones/prestec/{id}/{acttab}/{iditem}/mdo/delete', [prestecController::class,'delete_mdo'])->name('contratos.cotizaciones.prestec.delmdo');
    Route::get('contratos/cotizaciones/prestec/{id}/{acttab}/{iditem}/eqhe/delete', [prestecController::class,'delete_eqhe'])->name('contratos.cotizaciones.prestec.deleqhe');
    Route::get('contratos/cotizaciones/prestec/{id}/{acttab}/{iditem}/var/delete', [prestecController::class,'delete_var'])->name('contratos.cotizaciones.prestec.delvar');
    
    Route::post('contratos/cotizaciones/prestec/{id}/{acttab?}', [prestecController::class,'saveFieldExtras'])->name('contratos.cotizaciones.prestec');

    // Categories
    Route::get('categorias', [categoriesController::class,'index'])->name('categorias');
    Route::post('categorias/add', [categoriesController::class,'add'])->name('categorias.add');
    Route::post('categorias/{id}/edit', [categoriesController::class,'edit'])->name('categorias.edit');
    Route::get('categorias/{id}/delete', [categoriesController::class,'delete'])->name('categorias.delete');
    Route::post('categorias/save', [categoriesController::class,'save'])->name('categorias.save');

    // Taxes
    Route::get('taxes', [taxesController::class,'index'])->name('taxes');
    Route::post('taxes/add', [taxesController::class,'add'])->name('taxes.add');
    Route::post('taxes/{id}/edit', [taxesController::class,'edit'])->name('taxes.edit');
    Route::get('taxes/{id}/delete', [taxesController::class,'delete'])->name('taxes.delete');
    Route::post('taxes/save', [taxesController::class,'save'])->name('taxes.save');


    // Diversos
    Route::get('diversos', [diversosController::class,'index'])->name('diversos');
    Route::post('diversos/add', [diversosController::class,'add'])->name('diversos.add');
    Route::post('diversos/{id}/edit', [diversosController::class,'edit'])->name('diversos.edit');
    Route::get('diversos/{id}/delete', [diversosController::class,'delete'])->name('diversos.delete');
    Route::post('diversos/save', [diversosController::class,'save'])->name('diversos.save');

    // Salarios Admon
    Route::get('salariosadmon', [salariesController::class,'index'])->name('salariosadmon');
    Route::post('salariosadmon/add', [salariesController::class,'add'])->name('salariosadmon.add');
    Route::post('salariosadmon/{id}/edit', [salariesController::class,'edit'])->name('salariosadmon.edit');
    Route::get('salariosadmon/{id}/delete', [salariesController::class,'delete'])->name('salariosadmon.delete');
    Route::post('salariosadmon/save', [salariesController::class,'save'])->name('salariosadmon.save');

    // Salarios No Propios 
    Route::get('salariosnopropios', [salariesnotownerController::class,'index'])->name('salariosnopropios');
    Route::post('salariosnopropios/add', [salariesnotownerController::class,'add'])->name('salariosnopropios.add');
    Route::post('salariosnopropios/{id}/edit', [salariesnotownerController::class,'edit'])->name('salariosnopropios.edit');
    Route::get('salariosnopropios/{id}/delete', [salariesnotownerController::class,'delete'])->name('salariosnopropios.delete');
    Route::post('salariosnopropios/save', [salariesnotownerController::class,'save'])->name('salariosnopropios.save');

    // Salarios Propios 
    Route::get('salariospropios', [salariesownerController::class,'index'])->name('salariospropios');
    Route::post('salariospropios/add', [salariesownerController::class,'add'])->name('salariospropios.add');
    Route::post('salariospropios/{id}/edit', [salariesownerController::class,'edit'])->name('salariospropios.edit');
    Route::get('salariospropios/{id}/delete', [salariesownerController::class,'delete'])->name('salariospropios.delete');
    Route::post('salariospropios/save', [salariesownerController::class,'save'])->name('salariospropios.save');
 

    Route::get('pdf/{id}', function($id){
        $pdf = app('dompdf.wrapper');
        list($idCot , $basura) =  explode('|', base64_decode(base64_decode($id)) );
        $cotizacion = quotesModel::where('id',$idCot)->first();
        $pdf->setPaper('letter', 'landscape')
        ->loadView('pdf.cotpresentada', ['cotizacion'=>$cotizacion]);
        return $pdf->stream('archivo.pdf');
    })->name('cotizacion.pdf.view');

    Route::get('pdf/{id}/download', function($id){
        $pdf = app('dompdf.wrapper');
        list($idCot , $basura) =  explode('|', base64_decode(base64_decode($id)) );
        $cotizacion = quotesModel::where('id',$idCot)->first();
        $pdf->setPaper('letter', 'landscape')
        ->loadView('pdf.cotpresentada', ['cotizacion'=>$cotizacion]);
        return $pdf->download("Presupuesto N° {$cotizacion->id}.pdf");
    })->name('cotizacion.pdf.download');

    Route::group(['prefix'=>'/bank' , 'as' => 'bank.', ], function(){
        Route::get('/', [modulesController::class,'index'])->name('bank');
    });

  
    Route::group(['prefix'=>'tipo-documento-aprobacion'], function(){
        $slug= 'tipo-documento-aprobacion';
        Route::get('/', [DinamicController::class,'index'])->name($slug);
        Route::get('/new', [DinamicController::class,'new'])->name("{$slug}.new");
        Route::get('{id}/edit/', [DinamicController::class,'edit'])->name("{$slug}.edit");
        Route::post('/save/', [DinamicController::class,'save'])->name("{$slug}.save");
        Route::get('{id}/delete', [DinamicController::class,'del'])->name("{$slug}.delete");
    });

    Route::group(['prefix'=>'tipo-documento-contable'], function(){
        $slug= 'tipo-documento-contable';
        Route::get('/', [DinamicController::class,'index'])->name($slug);
        Route::get('/new', [DinamicController::class,'new'])->name("{$slug}.new");
        Route::get('{id}/edit/', [DinamicController::class,'edit'])->name("{$slug}.edit");
        Route::post('/save/', [DinamicController::class,'save'])->name("{$slug}.save");
        Route::get('{id}/delete', [DinamicController::class,'del'])->name("{$slug}.delete");
    });

    

    Route::group(['prefix'=>'banks'], function(){
        $slug= 'banks';
        Route::get('/', [DinamicController::class,'index'])->name($slug);
        Route::get('/new', [DinamicController::class,'new'])->name("{$slug}.new");
        Route::get('{id}/edit/', [DinamicController::class,'edit'])->name("{$slug}.edit");
        Route::post('/save/', [DinamicController::class,'save'])->name("{$slug}.save");
        Route::get('{id}/delete', [DinamicController::class,'del'])->name("{$slug}.delete");
        Route::get('{id}/{filter}', [DinamicController::class,'filter'])->name("{$slug}.ByCompany");
        
    });

    Route::group(['prefix'=>'tipo-movimiento-contable'], function(){
        $slug= 'tipo-movimiento-contable';
        Route::get('/', [DinamicController::class,'index'])->name($slug);
        Route::get('/new', [DinamicController::class,'new'])->name("{$slug}.new");
        Route::get('{id}/edit/', [DinamicController::class,'edit'])->name("{$slug}.edit");
        Route::post('/save/', [DinamicController::class,'save'])->name("{$slug}.save");
        Route::get('{id}/delete', [DinamicController::class,'del'])->name("{$slug}.delete");
    });

    Route::group(['prefix'=>'conceptos'], function(){
        $slug= 'conceptos';
        Route::get('/', [DinamicController::class,'index'])->name($slug);
        Route::get('/new', [DinamicController::class,'new'])->name("{$slug}.new");
        Route::get('{id}/edit/', [DinamicController::class,'edit'])->name("{$slug}.edit");
        Route::post('/save/', [DinamicController::class,'save'])->name("{$slug}.save");
        Route::get('{id}/delete', [DinamicController::class,'del'])->name("{$slug}.delete");
    });

    Route::group(['prefix'=>'tipo-de-cuentas'], function(){
        $slug= 'tipo-de-cuentas';
        Route::get('/', [DinamicController::class,'index'])->name($slug);
        Route::get('/new', [DinamicController::class,'new'])->name("{$slug}.new");
        Route::get('{id}/edit/', [DinamicController::class,'edit'])->name("{$slug}.edit");
        Route::post('/save/', [DinamicController::class,'save'])->name("{$slug}.save");
        Route::get('{id}/delete', [DinamicController::class,'del'])->name("{$slug}.delete");
    });

    Route::group(['prefix'=>'estado-de-cuenta'], function(){
        $slug= 'estado-de-cuenta';
        Route::get('/', [DinamicController::class,'index'])->name($slug);
        Route::get('/new', [DinamicController::class,'new'])->name("{$slug}.new");
        Route::get('{id}/edit/', [DinamicController::class,'edit'])->name("{$slug}.edit");
        Route::post('/save/', [DinamicController::class,'save'])->name("{$slug}.save");
        Route::get('{id}/delete', [DinamicController::class,'del'])->name("{$slug}.delete");
    });

    Route::group(['prefix'=>'cuentas'], function(){
        $slug= 'cuentas';
        Route::get('/', [DinamicController::class,'index'])->name($slug);
        Route::get('/new', [DinamicController::class,'new'])->name("{$slug}.new");
        Route::get('{id}/edit/', [DinamicController::class,'edit'])->name("{$slug}.edit");
        Route::post('/save/', [DinamicController::class,'save'])->name("{$slug}.save");
        Route::get('{id}/delete', [DinamicController::class,'del'])->name("{$slug}.delete");

        // cuentas
        Route::get('{id}/{filter}', [DinamicController::class,'filter'])->name("{$slug}.ByCompany");

    });

    Route::group(['prefix'=>'clasificacion'], function(){
        $slug= 'clasificacion';
        Route::get('/', [DinamicController::class,'index'])->name($slug);
        Route::get('/new', [DinamicController::class,'new'])->name("{$slug}.new");
        Route::get('{id}/edit/', [DinamicController::class,'edit'])->name("{$slug}.edit");
        Route::post('/save/', [DinamicController::class,'save'])->name("{$slug}.save");
        Route::get('{id}/delete', [DinamicController::class,'del'])->name("{$slug}.delete");
    });

    Route::group(['prefix'=>'compania'], function(){
        $slug= 'compania';
        Route::get('/', [DinamicController::class,'index'])->name($slug);
        Route::get('/new', [DinamicController::class,'new'])->name("{$slug}.new");
        Route::get('{id}/edit/', [DinamicController::class,'edit'])->name("{$slug}.edit");
        Route::post('/save/', [DinamicController::class,'save'])->name("{$slug}.save");
        Route::get('{id}/delete', [DinamicController::class,'del'])->name("{$slug}.delete");
    });

    Route::group(['prefix'=>'clasificacion-de-terceros'], function(){
        $slug= 'clasificacion-de-terceros';
        Route::get('/', [DinamicController::class,'index'])->name($slug);
        Route::get('/new', [DinamicController::class,'new'])->name("{$slug}.new");
        Route::get('{id}/edit/', [DinamicController::class,'edit'])->name("{$slug}.edit");
        Route::post('/save/', [DinamicController::class,'save'])->name("{$slug}.save");
        Route::get('{id}/delete', [DinamicController::class,'del'])->name("{$slug}.delete");
    });

    Route::group(['prefix'=>'terceros'], function(){
        $slug= 'terceros';
        Route::get('/', [Thirdparties::class,'index'])->name($slug);
        Route::get('/getList', [Thirdparties::class,'getList'])->name("{$slug}.list");

        Route::get('/ajax/{opc}', [Thirdparties::class,'ajax'])->name("{$slug}.ajax");
        
        Route::get('/new', [DinamicController::class,'new'])->name("{$slug}.new");
        Route::get('{id}/edit/', [DinamicController::class,'edit'])->name("{$slug}.edit");
        Route::post('/save/', [DinamicController::class,'save'])->name("{$slug}.save");
        Route::get('{id}/delete', [DinamicController::class,'del'])->name("{$slug}.delete");
    });

    Route::group(['prefix'=>'categorias-centro-de-costo'], function(){
        $slug= 'categorias-centro-de-costo';
        Route::get('/', [DinamicController::class,'index'])->name($slug);
        Route::get('/getList', [CostCenters::class,'getList'])->name("{$slug}.list");
        Route::get('/new', [DinamicController::class,'new'])->name("{$slug}.new");
        Route::get('/new/{id_parent}', [DinamicController::class,'new'])->name("{$slug}.new.parent");
        Route::get('{id}/edit/', [DinamicController::class,'edit'])->name("{$slug}.edit");
        Route::post('/save/', [DinamicController::class,'save'])->name("{$slug}.save");
        Route::get('{id}/delete', [DinamicController::class,'del'])->name("{$slug}.delete");
        Route::match(['get','post'] , 'ajax/{opc}', [CostCenters::class,'ajax'])->name("{$slug}.ajax");
    });

    Route::group(['prefix'=>'sub-centros-de-costos'], function(){
        $slug= 'sub-centros-de-costos';
        Route::get('/', [SubCostCenter::class,'index'])->name($slug);
        Route::get('/new', [SubCostCenter::class,'new'])->name("{$slug}.new");
        Route::get('{id}/edit/', [SubCostCenter::class,'edit'])->name("{$slug}.edit");
        Route::post('/save/', [SubCostCenter::class,'save'])->name("{$slug}.save");
        Route::get('{id}/delete', [SubCostCenter::class,'del'])->name("{$slug}.delete");
    });


    Route::group(['prefix'=>'registro-ingresos-egresos'], function(){
        $slug= 'registro-ingresos-egresos';
        Route::get('/', [IncomeExpenses::class,'index'])->name($slug);
        Route::get('/new', [IncomeExpenses::class,'new'])->name("{$slug}.new");
        Route::match(['get', 'post'], '{id}/edit/', [IncomeExpenses::class,'edit'])->name("{$slug}.edit");
        Route::post('/save/', [IncomeExpenses::class,'save'])->name("{$slug}.save");
        Route::get('{id}/delete', [IncomeExpenses::class,'del'])->name("{$slug}.delete");


        Route::match(['get', 'post'], '/excel', [IncomeExpenses::class,'excel'])->name("{$slug}.excel");
        
        
    });


    Route::group(['prefix'=>'cuentas-contrables'], function(){
        $slug= 'cuentas-contrables';
        Route::get('/', [DinamicController::class,'index'])->name($slug);
        Route::get('/new', [DinamicController::class,'new'])->name("{$slug}.new");
        Route::get('/new/{id_parent}', [DinamicController::class,'new'])->name("{$slug}.new.parent");
        Route::get('{id}/edit/', [DinamicController::class,'edit'])->name("{$slug}.edit");
        Route::post('/save/', [DinamicController::class,'save'])->name("{$slug}.save");
        Route::get('{id}/delete', [DinamicController::class,'del'])->name("{$slug}.delete");
        Route::get('{id}/{filter}', [DinamicController::class,'filter'])->name("{$slug}.ByAccount");
    });

    
    Route::group(['prefix'=>'saldo-diario'], function(){
        $slug= 'saldo-diario';
        Route::get('/', [IeBankBalancesController::class,'index'])->name($slug);
        Route::match(['get', 'post'], '/ajax/{opc}', [IeBankBalancesController::class,'ajax'])->name("{$slug}.ajax");
    });

    Route::group(['prefix'=>'saldo-consolidados'], function(){
        $slug= 'saldo-consolidados'; 

        Route::match(['get', 'post'],'/',[IeBankBalancesController::class,'filter'])->name($slug);
        // Route::get('/companie/{company}/{fecha?}', [IeBankBalancesController::class,'ConsolidatedBalances'])->name("{$slug}.filterbycompanie");
        
    });

    Route::group(['prefix'=>'reporte-de-saldos'], function(){
        $slug= 'reporte-de-saldos';
        Route::match(['get', 'post'], '/', [IeBankBalancesController::class,'ReportBalance'])->name($slug);
        Route::match(['get', 'post'], '/pdf', [IeBankBalancesController::class,'ReportBalancePdf'])->name("{$slug}.pdf");
    });
   
    
 
});

Route::match(['get','post'] , 'movi/ajax/{opc}', [IncomeExpenses::class,'ajax'])->name("movi.ajax");
