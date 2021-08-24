@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3>
                        EDITAR CATEGORÍA
                        <i class="pe-7s-pen">
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
                        {{ session('mensaje') }}
                    </div>
                    @endif
                    <form action="{{ route('categorias.update', $EditarCategoria->id) }}" method="POST">
                        @method('PUT')
                        @csrf
                        @error('nombre')
                        <div class="alert alert-danger">
                            El nombre es obligatorio
                        </div>
                        @enderror

                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    Nombre
                                </span>
                            </div>
                            <input class="form-control" name="nombre" placeholder="Nombre" type="text" value="{{ $EditarCategoria->nombre }}"/>
                        </div>
                        <div align="right" class="card-footer">
                            <button class="btn btn-lg btn-dark" data-placement="bottom" data-toggle="tooltip" title="Editar categoría" type="submit">
                                <i class="pe-7s-pen">
                                </i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection