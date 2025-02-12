<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\OrderImport;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('inventory')->get();
        return view('orders.index', ['orders'=>$orders]);
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

    public function scenarios()
    {
        $maxRebobinadora = 315;
        $maxPapelera = 319;
        $diametroCliente = 78;
        $gramajeCliente = 35;

        $escenarios = [];
        
        $gramajes = DB::table('orders')
            ->join('inventories', 'orders.id_material', '=', 'inventories.id_material')
            ->where('saldo', '<', 0)
            ->select('inventories.g')
            ->distinct()
            ->orderBy('inventories.g')
            ->get()
            ->pluck('g');

            foreach ($gramajes as $gramaje) {
                $grupos = $this->procesarGramaje($gramaje, $maxRebobinadora);
                
                $gruposFiltrados = array_filter($grupos, function($grupo) {
                    return $grupo['eficiencia'] > 90;
                });
        
                if (!empty($gruposFiltrados)) {
                    $escenarios[$gramaje] = $gruposFiltrados;
                }
            }
 
        return view('orders.scenarios', [
            'escenarios' => $escenarios,
            'maxRebobinadora' => $maxRebobinadora,
            'maxPapelera' => $maxPapelera,
            'diametroCliente' => $diametroCliente,
            'gramajeCliente' => $gramajeCliente,
            'query'=> Order::query()
        ]);
    }

    private function procesarGramaje($gramaje, $maxWidth)
    {
        $productos = Order::with('inventory')
            ->whereHas('inventory', fn($q) => $q->where('g', $gramaje))
            ->where('saldo', '<', 0)
            ->where('saldo', '<', -500)
            ->get()
            ->sortByDesc('inventory.cm');

        $grupos = [];
        $grupoActual = [];
        $anchoActual = 0;

        foreach ($productos as $producto) {
            $ancho = $producto->inventory->cm;
            
            if (($anchoActual + $ancho) <= $maxWidth) {
                $grupoActual[] = $producto;
                $anchoActual += $ancho;
            } else {
                $this->completarEspacio($grupoActual, $anchoActual, $productos, $maxWidth);
                $grupos[] = $this->calcularGrupo($grupoActual, $maxWidth, $gramaje);
                $grupoActual = [$producto];
                $anchoActual = $ancho;
            }
        }

        if (!empty($grupoActual)) {
            $grupos[] = $this->calcularGrupo($grupoActual, $maxWidth, $gramaje);
        }

        return $grupos;
    }

    private function completarEspacio(&$grupo, &$ancho, $productos, $maxWidth)
    {
        $espacio = $maxWidth - $ancho;
        $complemento = $productos->filter(fn($p) => 
            $p->inventory->cm <= $espacio && 
            !collect($grupo)->contains('id', $p->id)
        )->sortByDesc('inventory.cm')->first();

        if ($complemento) {
            $grupo[] = $complemento;
            $ancho += $complemento->inventory->cm;
        }
    }

    private function calcularGrupo($productos, $maxWidth, $gramaje)
    {
        $totalCm = collect($productos)->sum(fn($p) => $p->inventory->cm);
        $eficiencia = ($totalCm / $maxWidth) * 100;
        
        $detalles = collect($productos)->map(function($p) use ($maxWidth) {
            $kg = abs($p->saldo);
            $largo = ($kg * 1000) / ($p->inventory->g * ($p->inventory->cm / 100));
            
            return [
                'codigo' => $p->id_material,
                'descripcion' => $p->material_name,
                'gramaje' => $p->inventory->g,
                'bobinas' => 1,
                'ancho' => $p->inventory->cm,
                'total_cm' => $p->inventory->cm,
                'costo' => ($p->inventory->cm / $maxWidth) * 100,
                'cantidad' => $kg,
                'largo' => $largo,
                'm2' => ($p->inventory->cm / 100) * $largo,
                'peso_total' => $kg
            ];
        });

        return [
            'total_cm' => $totalCm,
            'eficiencia' => $eficiencia,
            'productos' => $detalles,
            'peso_total' => $detalles->sum('peso_total'),
            'gramaje' => $gramaje
        ];
    }
}