@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3>
                        AGREGAR CLIENTE
                        <i class="pe-7s-add-user">
                        </i>
                    </h3>
                    <a class="btn btn-dark btn-lg" data-toggle="tooltip" title="
                    Volver" href="/clientes">
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
                    <form action="{{ route('clientes.store') }}" method="POST" onsubmit="return validaCedula()">
                        @csrf
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    Número de Identificación
                                </span>
                            </div>
                            <input class="form-control" id="cedula" style="text-transform:uppercase;" maxlength="13" min="10" name="cedula" pattern="[0-9]{10}" type="text" value="{{ old('cedula') }}"/>
                            {{-- <div class="input-group-append dropright">
                                <button aria-expanded="true" id="btnTipoDoc" aria-haspopup="true" class="btn btn-default dropdown-toggle" data-toggle="dropdown" type="button">
                                    Tipo de Documento
                                </button>
                                <div class="dropdown-menu" id="tiposDoc">
                                    <a class="dropdown-item" href="#" name="cedula">
                                        Cédula
                                    </a>
                                    <a class="dropdown-item" href="#" name="RUC_PN">
                                        RUC - Persona Natural
                                    </a>
                                    <a class="dropdown-item" href="#" name="RUC_SPu">
                                        RUC - Sociedad Publica
                                    </a>
                                    <a class="dropdown-item" href="#" name="RUC_SPr">
                                        RUC - Sociedad Privada
                                    </a>
                                </div>
                            </div> --}}
                        </div>
                        @error('cedula')
                        <div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            El número de identificación es obligatorio
                        </div>
                        @enderror
                        
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Nombre y Apellido</span>
                            </div>
                            <input class="form-control" name="nombre" onkeypress="return soloLetras(event)" style="text-transform:uppercase;" type="text" value="{{ old('nombre') }}"/>
                            <input class="form-control" name="apellido" onkeypress="return soloLetras(event)" style="text-transform:uppercase;" type="text" value="{{ old('apellido') }}"/>
                        </div>
                        
                        @error('nombre')
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            El nombre es obligatorio
                        </div>
                        @enderror
                        
                        
                        @error('apellido')
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            El apellido es obligatorio
                        </div>
                        @enderror

                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Correo Electrónico</span>
                            </div>
                            <input class="form-control" name="correo" style="text-transform:uppercase;" type="email" value="{{ old('correo') }}"/>
                        </div>
                        
                        
                        @error('correo')
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            El correo es obligatorio
                        </div>
                        @enderror

                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Dirección</span>
                            </div>
                            <input class="form-control" name="direccion" style="text-transform:uppercase;" type="text" value="{{ old('direccion') }}"/>
                        </div>
                        
                        
                        @error('direccion')
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            La dirección es obligatorio
                        </div>
                        @enderror

                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Teléfono</span>
                            </div>
                            <input class="form-control" id="telefono" maxlength="10" name="telefono" style="text-transform:uppercase;" type="text" value="{{ old('telefono') }}"/>
                        </div>
                        
                        
                        @error('telefono')
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            El teléfono es obligatorio
                        </div>
                        @enderror
                        
                        <div align="right" class="card-footer">
                            <button class="btn btn-lg btn-dark" data-placement="bottom" data-toggle="tooltip" title="Agregar cliente" type="submit">
                                <i class="pe-7s-add-user">
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
<script src='{{ asset('dist/ruc_jquery_validator.min.js') }}'>$(#cedula).validarCedulaEC();</script>
<script>

    $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
    });
    
    $(function(){
    $('[id="telefono"]').keydown(function(event){
        //alert(event.keyCode);
        if((event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105) && event.keyCode !==190  && event.keyCode !==110 && event.keyCode !==8 && event.keyCode !==9  ){
            return false;
        }
    });
});
</script>


@endsection

<script type="text/javascript">

    function validaCedula(){
        var cad = document.getElementById("cedula").value.trim();
        var total = 0;
        var longitud = cad.length;
        var longcheck = longitud - 1;

        if (cad !== "" && longitud === 10){
          for(i = 0; i < longcheck; i++){
            if (i%2 === 0) {
              var aux = cad.charAt(i) * 2;
              if (aux > 9) aux -= 9;
              total += aux;
            } else {
              total += parseInt(cad.charAt(i)); // parseInt o concatenará en lugar de sumar
            }
          }

          total = total % 10 ? 10 - total % 10 : 0;

          if (cad.charAt(longitud-1) == total) {
            return true;
          }else{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Hubo un error con la cédula'
            })
            return false;
          }
        }

    }



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