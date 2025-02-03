<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\OrderImport;
use DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('inventory')->get();
        return view('orders.index', compact('orders'));
    }

    public function importExcel(Request $request)
    {
        $excel = $request->file('excel');

        if (!$excel) {
            return redirect()->route('orders')->with('error', 'No se ha seleccionado un archivo');
        }

        Order::truncate();

        $import = new OrderImport();
        Excel::import($import, $excel);

        return redirect()->route('orders')->with('success', 'Pedidos importados correctamente');
    }

    public function scenarios(){
        return view('orders.scenarios' , ['query'=> Order::query()]);
    }

    static function escenarios($g){
       $productos = DB::select("SELECT material_name , g , cm FROM orders , inventories
                    WHERE saldo < 0
                    AND inventories.id_material = orders.id_material
                    AND g = $g
                    ORDER BY g , cm"); 
        if ($productos){
            foreach($productos as $producto){
                $array['cm'][] =  $producto;
            }
        } 

        return $array;
    }
    
}
