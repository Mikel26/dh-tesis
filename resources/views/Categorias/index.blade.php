@extends('layouts.app')
@section('content')
<div class="container ">
    <div class="row justify-content-center">
        <div class="col-md-10 ">
            <div class="card justify-content-center">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3>
                        LISTA DE CATEGORÍAS&nbsp;
                        <i class="pe-7s-note2">
                        </i>
                    </h3>
                    <form class="d-inline"><a class="btn btn-lg btn-dark" data-toggle="tooltip" title="
                    Agregar una nueva categoría" href="{{ route('categorias.create') }}">
                        <i class="pe-7s-plus">
                        </i>
                    </a>
                    <a class="btn btn-dark btn-lg" data-toggle="tooltip" title="
                    Volver al inicio" href="/">
                        <i class="pe-7s-back">
                        </i>
                    </a>
                </form>
                </div>
                <div class="card-body justify-content-between align-items-center">
                    <table class="table" id="tablaProductos">
                        <thead align="center" class="thead-light">
                            <tr>
                                <th scope="col">
                                    #
                                </th>
                                <th scope="col">
                                    Nombre
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
                            @foreach ($categorias as $item)
                            <?php $i++; ?>
                            <tr>
                                <th scope="row">
                                    {{ $i }}
                                </th>
                                <td style="text-transform: capitalize;">
                                    {{ $item->nombre }}
                                </td>
                                <td>
                                    @if($item->estado == 1)
                                    Habilitado
                                    @else
                                    Deshabilitado
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-warning" data-toggle="tooltip" title="Editar categoría" href="{{ route('categorias.edit',$item) }}">
                                        <i class="pe-7s-pen">
                                        </i>
                                    </a>

                                    @if(Auth::user()->id_tipo_usuario == 1)
                                    <form action="{{ route('categorias.destroy',$item) }}" class="d-inline" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" style="display: none;"></button>
                                        <span class="btn btn-danger btn-sm" onclick="comprobarBorrado(this)" data-toggle="tooltip" title="Eliminar categoría" >
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
                    {{-- fin card body --}}
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function comprobarBorrado(btn) {
        Swal.fire({
        title: '¿Desea eliminar esta categoría?',
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
      'Categoría Eliminada!',
      'La categoría ha sido eliminado correctamente',
      'success'
    )
  }
});
}
</script>
@endsection