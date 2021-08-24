@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3>
                        REPORTES
                        <i class="pe-7s-graph2">
                        </i>
                    </h3>
                    <a class="btn btn-dark btn-lg" data-toggle="tooltip" href="/" title="Volver al inicio">
                        <i class="pe-7s-back">
                        </i>
                    </a>
                </div>
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4>
                            <i class="pe-7s-filter">
                            </i>
                            Filtrar desde:&nbsp;
                        </h4>
                        <form action="{{ route('reportes.index') }}" class="form-inline" method="GET">
                            @csrf
                            <input class="form-control" id="fechaInicio" max="{{ $valFF }}" min="2017-01-01" name="rptDiaInicio" onsubmit="ValidarFechas();" required="" type="date" value="{{ $valFF }}">
                                &nbsp;<h4>
                                    hasta:&nbsp; 
                                </h4>
                                <input class="form-control" id="fechaFin" max="{{ $valFF }}" min="2017-01-01" name="rptDiaFin" onsubmit="ValidarFechas();" required="" type="date" value="{{ $valFF }}">
                                    &nbsp;&nbsp;<button class="btn btn-lg btn-dark" data-placement="right" data-toggle="tooltip" title="Consultar" onsubmit="ValidarFechas();" type="submit">
                                        <i class="pe-7s-search">
                                        </i>
                                    </button>
                                </input>
                            </input>
                        </form>
                    </div>
                    <a class="btn btn-lg btn-dark" data-placement="left" data-toggle="tooltip" title="Exportar PDF" href="{{url('reporteDH',['finicio' => $fechaInicio, 'ffin' => $fechaFin])}}">
                        <i class="pe-7s-file">
                        </i>
                    </a>
                </div>
                <table class="table">
                    <thead align="center" class="thead-light">
                        <tr>
                            <th scope="col">
                                #
                            </th>
                            <th scope="col">
                                Fecha/Hora
                            </th>
                            <th scope="col">
                                Cantidad
                            </th>
                            <th scope="col">
                                Productos
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
                        <?php
                            $i = 0;
                            ?>
                        @foreach ($rptAll as $item)
                        <?php
                                    $i++;
                                    ?>
                        <tr>
                            <th scope="row">
                                {{ $i }}
                            </th>
                            <td>
                                {{ $item->fecha }}
                            </td>
                            <td>
                                {{ $item->cantidad }}
                            </td>
                            <td>
                                {{ $item->nombre }}
                            </td>
                            <td>
                                $ {{ $item->valor }}
                            </td>
                            <td>
                                $ {{ $item->total }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- fin card body --}}
            </div>
            <div class="card-footer">
                <h3 align="right" style="color: red; text-transform: uppercase;">
                    <strong>
                        Total: ${{ $total->total }}
                    </strong>
                </h3>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.3.1.js">
</script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js">
</script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js">
</script>
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });

        function ValidarFechas(){
            var fechainicial = document.getElementById("fechaInicio").value;
            var fechafinal = document.getElementById("fechaFin").value;
            if(Date.parse(fechafinal) < Date.parse(fechainicial)) {
                alert("La fecha final debe ser mayor a la fecha inicial");
            }
        };
</script>
