@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 align="center">PEDIDO # {{ $id }}</h3>
                    <a class="btn btn-dark btn-lg" data-toggle="tooltip" title="
                    Volver" href="/pedidos">
                        <i class="pe-7s-back">
                        </i>
                    </a>
                </div>
                    <table class="table">
                        <thead align="center" class="thead-light">
                            <tr>
                                <th scope="col">
                                    Cantidad
                                </th>
                                <th scope="col">
                                    Producto
                                </th>
                                <th scope="col">
                                    P. Unitario
                                </th>
                                <th scope="col">
                                    Total
                                </th>
                            </tr>
                        </thead>
                        <tbody align="center">
                        	@foreach($pedidos as $item)
                        	<tr>
                        		<td>{{ $item->cantidad }}</td>
                        		<td>{{ $item->nombre }}</td>
                        		<td>{{ $item->valor }}</td>
                        		<td>{{ $item->total }}</td>
                        	</tr>
                        	@endforeach 
                        </tbody>
                    </table>
                    {{-- fin card body --}}
                </div>
                <div class="card-footer">
                    <h3 align="right" style="color: red; text-transform: uppercase;"> 
                        <strong>Total: ${{ $total_final }}</strong>
                    </h3>
                </div>
            </div>
        </div>
    </div>

@endsection
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>