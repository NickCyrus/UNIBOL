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
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\itemsController;
use App\Http\Controllers\materialesController;
use App\Http\Controllers\OrderController;
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

    // Usuarios
    Route::get('usuarios', [usuariosController::class,'index'])->name('usuarios');
    Route::post('usuarios/add', [usuariosController::class,'add'])->name('usuarios.add');
    Route::post('usuarios/{id}/edit', [usuariosController::class,'edit'])->name('usuarios.edit');
    Route::get('usuarios/{id}/delete', [usuariosController::class,'delete'])->name('usuarios.delete');
    Route::post('usuarios/save', [usuariosController::class,'save'])->name('usuarios.save');


    Route::group(['prefix'=>'registro-ingresos-egresos'], function(){
        $slug= 'registro-ingresos-egresos';
        Route::get('/', [IncomeExpenses::class,'index'])->name($slug);
        Route::get('/new', [IncomeExpenses::class,'new'])->name("{$slug}.new");
        Route::match(['get', 'post'], '{id}/edit/', [IncomeExpenses::class,'edit'])->name("{$slug}.edit");
        Route::post('/save/', [IncomeExpenses::class,'save'])->name("{$slug}.save");
        Route::get('{id}/delete', [IncomeExpenses::class,'del'])->name("{$slug}.delete");


        Route::match(['get', 'post'], '/excel', [IncomeExpenses::class,'excel'])->name("{$slug}.excel");


    });

    Route::group(['prefix'=>'inventories'], function(){
        $slug= 'inventories';
        Route::get('/', [InventoryController::class,'index'])->name($slug);
        Route::match(['get', 'post'], '/excelClear', [InventoryController::class,'excelClear'])->name("{$slug}.excelClear");
        Route::match(['get', 'post'], '/excelUpdate', [InventoryController::class,'excelUpdate'])->name("{$slug}.excelUpdate");
    });

    Route::group(['prefix'=>'orders'], function(){
        $slug= 'orders';
        Route::get('/', [OrderController::class,'index'])->name($slug);
        Route::get('/escenarios', [OrderController::class,'scenarios'])->name("{$slug}.scenarios");
        Route::match(['get', 'post'], '/importExcel', [OrderController::class,'importExcel'])->name("{$slug}.importExcel");
        Route::match(['get', 'post'], '/excelUpdate', [OrderController::class,'excelUpdate'])->name("{$slug}.excelUpdate");
    });

});

Route::match(['get','post'] , 'movi/ajax/{opc}', [IncomeExpenses::class,'ajax'])->name("movi.ajax");
