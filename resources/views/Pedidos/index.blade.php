@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <a aria-controls="nav-diario" aria-selected="true" class="nav-item nav-link active" data-toggle="tab" href="#nav-diario" id="nav-diario-tab" role="tab">
                            Diario
                        </a>
                        <a aria-controls="nav-historico" aria-selected="false" class="nav-item nav-link" data-toggle="tab" href="#nav-historico" id="nav-historico-tab" role="tab">
                            Histórico
                        </a>
                        <a class="btn btn-dark btn-lg" data-toggle="tooltip" href="/" title="
                    Volver al inicio">
                            <i class="pe-7s-back">
                            </i>
                        </a>
                    </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                    <div aria-labelledby="nav-diario-tab" class="tab-pane fade show active" id="nav-diario" role="tabpanel">
                        <br>
                            <h4 align="center" style="text-transform: uppercase;">
                                <i class="pe-7s-shopbag">
                                </i>
                                LISTA DE PEDIDOS DEL DÍA: {{ $now }}
                            </h4>
                            <div class="card-body justify-content-between align-items-center">
                                <table class="table" id="tablaPedidosDia">
                                    <thead align="center" class="thead-light">
                                        <tr>
                                            <th scope="col">
                                                #
                                            </th>
                                            <th scope="col">
                                                N° Pedido
                                            </th>
                                            <th scope="col">
                                                Cliente
                                            </th>
                                            <th scope="col">
                                                Total ($)
                                            </th>
                                            <th scope="col">
                                                Estado
                                            </th>
                                            <th scope="col">
                                                Acciones
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody align="center">
                                        <?php
                                        $i = 0;
                                        ?>
                                        @foreach ($pedido_dia as $item)
                                        <?php $i++; ?>
                                        <tr>
                                            <th scope="row">
                                                {{ $i }}
                                            </th>
                                            <td>
                                                <a href="{{ route('ver_pedidos', $item->numFac) }}">
                                                    {{ $item->numFac }}
                                                </a>
                                            </td>
                                            <td>
                                                {{ $item->nombre. ' '.$item->apellido }}
                                            </td>
                                            <td>
                                                {{ $item->subtotal }}
                                            </td>
                                            <td>
                                                @if($item->estado == 1)
                                                En proceso...
                                                @else
                                                Finalizado
                                                @endif
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-dark" data-toggle="tooltip" href="{{ route('pedidos.pdf',$item->numFac) }}" title="Imprimir comprobante">
                                                    <i class="pe-7s-print">
                                                    </i>
                                                </a>
                                                @if(Auth::user()->id_tipo_usuario == 1)
                                                <form action="{{ route('pedidos.destroy', $item->numFac) }}" class="d-inline" method="POST">
                                                    @method('DELETE')
                                        @csrf
                                                    <button class="btn btn-danger btn-sm" data-toggle="tooltip" title="Eliminar pedido" type="submit">
                                                        <i class="pe-7s-trash">
                                                        </i>
                                                    </button>
                                                </form>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{-- fin card body --}}
                            </div>
                            <div class="d-flex card-footer justify-content-center">
                                {{$pedido_dia->links()}}
                            </div>
                        </br>
                    </div>
                    <div aria-labelledby="nav-historico-tab" class="tab-pane fade" id="nav-historico" role="tabpanel">
                        <br>
                            <h4 align="center">
                                LISTA DE PEDIDOS
                                <i class="pe-7s-shopbag">
                                </i>
                            </h4>
                            <div class="card-body justify-content-between align-items-center">
                                <table class="table" id="tablaPedidosHist">
                                    <thead align="center" class="thead-light">
                                        <tr>
                                            <th scope="col">
                                                #
                                            </th>
                                            <th scope="col">
                                                N° Pedido
                                            </th>
                                            <th scope="col">
                                                Cliente
                                            </th>
                                            <th scope="col">
                                                Fecha
                                            </th>
                                            <th scope="col">
                                                Total ($)
                                            </th>
                                            <th scope="col">
                                                Acciones
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody align="center">
                                        <?php
                                        $i = 0;
                                        ?>
                                        @foreach ($pedido_hist as $item)
                                        <?php $i++; ?>
                                        <tr>
                                            <th scope="row">
                                                {{ $i }}
                                            </th>
                                            <td>
                                                <a href="{{ route('ver_pedidos', $item->numFac) }}">
                                                    {{ $item->numFac }}
                                                </a>
                                            </td>
                                            <td>
                                                {{ $item->nombre. ' '.$item->apellido }}
                                            </td>
                                            <td>
                                                {{ $item->fecha }}
                                            </td>
                                            <td>
                                                {{ $item->subtotal }}
                                            </td>
                                            <td>
                                                <a class="btn btn-sm btn-dark" data-toggle="tooltip" href="{{ route('pedidos.pdf',$item->numFac) }}" title="Imprimir comprobante">
                                                    <i class="pe-7s-print">
                                                    </i>
                                                </a>
                                                @if(Auth::user()->id_tipo_usuario == 1)
                                                <form action="{{ route('pedidos.destroy', $item->numFac) }}" class="d-inline" method="POST">
                                                    @method('DELETE')
                                        @csrf
                                                    <button class="btn btn-danger btn-sm" data-toggle="tooltip" title="Eliminar pedido" type="submit">
                                                        <i class="pe-7s-trash">
                                                        </i>
                                                    </button>
                                                </form>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{-- fin card body --}}
                            </div>
                            <div class="d-flex card-footer justify-content-center">
                                {{$pedido_hist->links()}}
                            </div>
                        </br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.js">
</script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js">
</script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js">
</script>
{{-- Codigo para DataTable y su personalizacion --}}
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });


    $(document).ready(function() {
        $.noConflict();
        var tableHist = $('#tablaPedidosHist').DataTable({
            "language": {
                "lengthMenu": 'Mostrar <div class="form-group d-inline">'+
                            '<select class="form-control form-control-sm">'+
                            '<option value="5">5</option>'+
                            '<option value="10">10</option>'+
                            '<option value="25">25</option>'+
                            '<option value="50">50</option>'+
                            '<option value="100">100</option>'+
                            '<option value="-1">Todos</option>'+
                            '</select>'+
                            '</div> registros por página',
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "search": "Buscar:",
                "paginate":{
                    "next":"Siguiente",
                    "previous":"Anterior"
                },
                "loadingRecords":"Cargando...",
                "processing":"Procesando...",
                "emptyTable":"No hay datos en la tabla",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(se buscó en un total de _MAX_ registros)",
                "zeroRecords": "No se encontraron coincidencias"
            }
        });

        var tableDia = $('#tablaPedidosDia').DataTable({
            "language": {
                "lengthMenu": 'Mostrar <div class="form-group d-inline">'+
                            '<select class="form-control form-control-sm">'+
                            '<option value="5">5</option>'+
                            '<option value="10">10</option>'+
                            '<option value="25">25</option>'+
                            '<option value="50">50</option>'+
                            '<option value="100">100</option>'+
                            '<option value="-1">Todos</option>'+
                            '</select>'+
                            '</div> registros por página',
                "info": "Mostrando página _PAGE_ de _PAGES_",
                "search": "Buscar:",
                "paginate":{
                    "next":"Siguiente",
                    "previous":"Anterior"
                },
                "loadingRecords":"Cargando...",
                "processing":"Procesando...",
                "emptyTable":"No hay datos en la tabla",
                "infoEmpty": "No hay registros disponibles",
                "infoFiltered": "(se buscó en un total de _MAX_ registros)",
                "zeroRecords": "No se encontraron coincidencias"
            }
        });
    } );
</script>
@endsection
