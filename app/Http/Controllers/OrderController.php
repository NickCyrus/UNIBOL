<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\OrderImport;

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
}
