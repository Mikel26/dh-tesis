@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3>
                        LISTA DE CLIENTES&nbsp;
                        <i class="pe-7s-users">
                        </i>
                    </h3>  
                    <form class="d-inline"><a class="btn btn-lg btn-dark" data-toggle="tooltip" title="
                    Agregar un nuevo cliente" href="{{ route('clientes.create') }}">
                        <i class="pe-7s-add-user">
                        </i>
                    </a>
                    <a class="btn btn-dark btn-lg" data-toggle="tooltip" title="
                    Volver al inicio" href="/">
                        <i class="pe-7s-back">
                        </i>
                    </a>
                </form>                  
                    
                </div>
                <div class="card-body table-responsive d-flex justify-content-between align-items-center">
                    <table class="table table-responsive" id="tablaClientes">
                        <thead align="center" class="thead-light">
                            <tr>
                                <th scope="col">
                                    #
                                </th>
                                <th scope="col">
                                    Cédula
                                </th>
                                <th scope="col">
                                    Nombres
                                </th>
                                <th scope="col">
                                    Apellidos
                                </th>
                                <th scope="col">
                                    Correo Electrónico
                                </th>
                                <th scope="col">
                                    Dirección
                                </th>
                                <th scope="col">
                                    Teléfono
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
                            @foreach ($clientes as $item)
                            <?php $i++; ?>
                            <tr>
                                <th scope="row">
                                    {{ $i }}
                                </th>
                                <td>
                                    {{ $item->cedula }}
                                </td>
                                <td>
                                    {{ $item->nombre }}
                                </td>
                                <td>
                                    {{ $item->apellido }}
                                </td>
                                <td>
                                    {{ $item->correo }}
                                </td>
                                <td>
                                    {{ $item->direccion }}
                                </td>
                                <td>
                                    {{ $item->telefono }}
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-warning" data-toggle="tooltip" title="Editar cliente" href="{{ route('clientes.edit',$item) }}">
                                        <i class="pe-7s-pen">
                                        </i>
                                    </a>
                                    @if(Auth::user()->id_tipo_usuario == 1)
                                    <form action="{{ route('clientes.destroy', $item) }}"  class="d-inline" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" style="display: none;"></button>
                                        <span class="btn btn-danger btn-sm" onclick="comprobarBorrado(this)" data-toggle="tooltip" title="Eliminar cliente" >
                                            <i class="pe-7s-trash">
                                            </i>
                                        </span>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- fin card body --}}

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
{{-- Codigo para DataTable y su personalizacion --}}
<script>
    function comprobarBorrado(btn) {
        Swal.fire({
        title: '¿Desea eliminar este cliente?',
        text: "Este cambio no se puede revertir",
        icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  cancelButtonText: 'Cancelar',
  confirmButtonText: 'Si'
}).then((result) => {
  if (result.value) {
    $(btn).siblings('button').click();
    Swal.fire(
      'Cliente Eliminado!',
      'El cliente ha sido eliminado correctamente',
      'success'
    )
  }
});
    }
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
    $(document).ready(function() {
        $.noConflict();
        var table = $('#tablaClientes').DataTable({
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
