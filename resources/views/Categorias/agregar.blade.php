@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3>
                        AGREGAR CATEGORÍA
                        <i class="pe-7s-plus">
                        </i>
                    </h3>
                    <a class="btn btn-dark btn-lg" data-toggle="tooltip" href="{{ route('categorias.index') }}" title="
                    Volver">
                        <i class="pe-7s-back">
                        </i>
                    </a>
                </div>
                <div class="card-body">
                    @if ( session('mensaje') )
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        {{ session('mensaje') }}
                    </div>
                    @endif
                    <form action="{{ route('categorias.store') }}" method="POST">
                        @csrf
                        @error('nombre')
                        <div class="alert alert-danger">
                            El nombre de la categoría es obligatorio
                        </div>
                        @enderror

                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    Nombre
                                </span>
                            </div>
                            <input class="form-control" onkeypress="return soloLetras(event)" style="text-transform:uppercase;" type="text" name="nombre" placeholder="Nombre categoría" type="text" />
                        </div>
                        <div align="right" class="card-footer">
                            <button class="btn btn-lg btn-dark" data-placement="bottom" data-toggle="tooltip" title="Agregar categoría" type="submit">
                                <i class="pe-7s-plus">
                                </i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="jquery.js"></script>
<script type="text/javascript">
    function soloLetras(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyz-";
    especiales = [8, 37, 39, 46];

    tecla_especial = false
    for(var i in especiales) {
        if(key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if(letras.indexOf(tecla) == -1 && !tecla_especial)
        return false;
    }
</script>
@endsection