@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3>
                        AGREGAR PRODUCTO
                        <i class="pe-7s-next-2">
                        </i>
                    </h3>
                    <a class="btn btn-dark btn-lg" data-toggle="tooltip" href="/productos" title="
                    Volver">
                        <i class="pe-7s-back">
                        </i>
                    </a>
                </div>
                <div class="card-body">
                    @if ( session('mensaje') )
                    <div class="alert alert-success">
                        <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                            <span aria-hidden="true">
                                ×
                            </span>
                        </button>
                        {{ session('mensaje') }}
                    </div>
                    @endif
                    <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    Código de Producto
                                </span>
                            </div>
                            <input class="form-control" id="CodigoProducto" maxlength="7" minlength="5" name="codigo" onblur="limpiaCP()" onkeypress="return soloLetras(event)" style="text-transform:uppercase;" type="text" value="{{ old('codigo') }}"/>
                        </div>
                        @error('codigo')
                        <div class="alert alert-danger">
                            <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                <span aria-hidden="true">
                                    ×
                                </span>
                            </button>
                            El código del producto es obligatorio
                        </div>
                        @enderror
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    Nombre de Producto
                                </span>
                            </div>
                            <input class="form-control" id="NombreProducto" name="nombre" onkeypress="return soloLetras(event)" style="text-transform:uppercase;" type="text" value="{{ old('nombre') }}"/>
                        </div>
                        @error('nombre')
                        <div class="alert alert-danger">
                            <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                <span aria-hidden="true">
                                    ×
                                </span>
                            </button>
                            El nombre del producto es obligatorio
                        </div>
                        @enderror
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    Precio ($)
                                </span>
                            </div>
                            <input class="form-control" name="valor" onkeypress=" return filterFloat(event,this);" style="text-transform:uppercase;" type="text" value="{{ old('valor') }}"/>
                        </div>
                        @error('precio')
                        <div class="alert alert-danger">
                            <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                                <span aria-hidden="true">
                                    ×
                                </span>
                            </button>
                            El precio es obligatorio
                        </div>
                        @enderror
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="GroupSelectCategoria">
                                    Categoría
                                </label>
                            </div>
                            <select class="form-control" name="categoriaProducto" id="GroupSelectCategoria">
                                <option value="">
                                    --- Seleccione una categoría de producto ---
                                </option>
                                @foreach($Categoria as $item)
                                <option value="{{ $item->id}}">
                                    {{ $item->id.' - '.$item->nombre }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupFileAddon01">
                                    Imagen del producto*
                                </span>
                            </div>
                            <div class="custom-file">
                                <input accept=".jpg,.png,.jpeg" aria-describedby="inputGroupFileAddon01" class="custom-file-input" name="imagen_producto" id="imagen_producto" type="file" >
                                    <label class="custom-file-label" for="imagen_producto">
                                        Escoger archivo...
                                    </label>
                            </div>
                        </div>
                        <small class="form-text text-muted">
                            *Opcional
                        </small>
                        <div align="right" class="card-footer">
                            <button class="btn btn-lg btn-dark" data-toggle="tooltip" title="Agregar producto" type="submit">
                                <i class="pe-7s-next-2">
                                </i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.js">
</script>
<script>
    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });

    $(document).on('change','.custom-file-input :file',function(){
        var input = $(this);
        var numFiles = input.get(0).files ? input.get(0).files.length : 1;
        var label = input.val().replace(/\\/g,'/').replace(/.*\//,'');
        input.trigger('fileselect',[numFiles,label]);
    });
    $(document).ready(function(){
        $('.custom-file-input :file').on('fileselect',function(event,numFiles,label){
            var input = $(this).parents('.input-group').find(':text');
            var log = numFiles > 1 ? numFiles + ' files selected' : label;
            if(input.length){ input.val(log); }else{ if (log) alert(log); }
        });
    });
</script>
<script type="text/javascript">
    <!--
function filterFloat(evt,input){
    // Backspace = 8, Enter = 13, ‘0′ = 48, ‘9′ = 57, ‘.’ = 46, ‘-’ = 43
    var key = window.Event ? evt.which : evt.keyCode;    
    var chark = String.fromCharCode(key);
    var tempValue = input.value+chark;
    if(key >= 48 && key <= 57){
        if(filter(tempValue)=== false){
            return false;
        }else{       
            return true;
        }
    }else{
          if(key == 8 || key == 13 || key == 0) {     
              return true;              
          }else if(key == 46){
                if(filter(tempValue)=== false){
                    return false;
                }else{       
                    return true;
                }
          }else{
              return false;
          }
    }
}
function filter(__val__){
    var preg = /^([0-9]+\.?[0-9]{0,2})$/; 
    if(preg.test(__val__) === true){
        return true;
    }else{
       return false;
    }
    
}
-->

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

function limpiaNP() {
    var val = document.getElementById("NombreProducto").value;
    var tam = val.length;
    for(i = 0; i < tam; i++) {
        if(!isNaN(val[i]))
            document.getElementById("NombreProducto").value = '';
    }
}

function limpiaCP() {
    var val = document.getElementById("CodigoProducto").value;
    var tam = val.length;
    for(i = 0; i < tam; i++) {
        if(!isNaN(val[i]))
            document.getElementById("CodigoProducto").value = '';
    }
}
</script>
@endsection
