@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                  <h3>EDITAR PRODUCTO&nbsp; <i class="pe-7s-pen"></i></h3>
                    <a class="btn btn-dark btn-lg" data-toggle="tooltip" title="
                    Volver" href="/productos">
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

                  <form method="POST" action="{{ route('productos.update', $EditarProducto->id) }}">
                    @method('PUT')
                    @csrf

                    <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Código de Producto</span>
                            </div>
                            <input class="form-control" id="CodigoProducto" name="codigo" onkeypress="return soloLetras(event)" onblur="limpiaCP()" maxlength="7" minlength="5" style="text-transform:uppercase;" placeholder="Código" type="text" value="{{ $EditarProducto->codigo }}"/>
                    </div>
                    

                        @error('codigo')
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            El código del producto es obligatorio
                        </div>
                        @enderror

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Nombre de Producto</span>
                            </div>
                            <input class="form-control" onkeypress="return soloLetras(event)" id="NombreProducto" style="text-transform: uppercase;" name="nombre" placeholder="Nombre del Producto"  value="{{ $EditarProducto->nombre }}"/>
                            
                        </div>

                        @error('nombreProducto')
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            El nombre del producto es obligatorio
                        </div>
                        @enderror

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Precio ($)</span>
                            </div>
                            <input class="form-control" onkeypress="return filterFloat(event,this);" style="text-transform:capitalize;" name="valor" placeholder="Precio" type="text" value="{{ $EditarProducto->valor }}"/>
                        </div>
                        
                        @error('precio')
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            El valor del producto es obligatorio
                        </div>
                        @enderror

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="GroupSelectCategoria">Categoría</label>
                            </div>
                            <select name="categoriaProducto" autofocus="2" class="form-control">
                                <option value="">
                                    --- Seleccione una categoría de producto ---
                                </option>
                                @foreach($Categoria as $item)
                                @if($item->id == $EditarProducto->id_categoria )
                                <option value="{{ $item->id}}" selected="">{{ $item->id.' - '.$item->nombre }}</option>
                                @else
                                <option value="{{ $item->id}}">{{ $item->id.' - '.$item->nombre }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupFileAddon01">Imagen del producto*</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" accept=".jpg,.png,.jpeg" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                <label class="custom-file-label" for="inputGroupFile01">Escoger archivo...</label>
                            </div>
                        </div>
                        <small class="form-text text-muted">
                            *Opcional
                        </small>
                        <div align="right" class="card-footer">
                            <button class="btn btn-lg btn-dark" data-placement="left" data-toggle="tooltip" title="Editar producto" type="submit">
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

<script type="text/javascript">
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

function soloLetras(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
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

// function limpiaNP() {
//     var val = document.getElementById("NombreProducto").value;
//     var tam = val.length;
//     for(i = 0; i < tam; i++) {
//         if(!isNaN(val[i]))
//             document.getElementById("NombreProducto").value = '';
//     }
// }

// function limpiaCP() {
//     var val = document.getElementById("CodigoProducto").value;
//     var tam = val.length;
//     for(i = 0; i < tam; i++) {
//         if(!isNaN(val[i]))
//             document.getElementById("CodigoProducto").value = '';
//     }
// }
</script>
@endsection