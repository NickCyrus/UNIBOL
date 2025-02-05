@extends('app')

@section('content')

<div class="card">
    <div class="card-header row">
        <div class="col-md-9">
            <h4 class="fw-bold p-0 mb-0">Pedidos</h4>
        </div>
        <div class="col-md-3 d-flex gap-2">
            <form class="pull-right" action="{{ route('orders.importExcel') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="load-excel-clear">
                    <input class="d-none" type="file" name="excel" onchange="this.form.submit()" required accept=".xls,.xlsx" id="load-excel-clear" />
                    <span class="btn btn-sm btn-success">Importar desde cero</span>
                </label>
            </form>
            <a href="{{route('orders.scenarios')}}" class="btn btn-sm btn-info text-white">Generar escenarios</a>
        </div>
    </div>
</div>

<div class="card mt-3">
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @elseif (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @include('orders.list', ['orders' => $orders])
    </div>
</div>

@endsection
