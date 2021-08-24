@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3>
                        EDITAR CLIENTE
                        <i class="pe-7s-pen">
                        </i>
                    </h3>
                    <a class="btn btn-dark btn-lg" data-toggle="tooltip" href="/clientes" title="
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
                    <form action="{{ route('clientes.update', $EditarCliente->id) }}" method="POST">
                        @method('PUT')
                    @csrf

                    @error('cedula')
                        <div class="alert alert-danger">
                            La cédula es obligatoria
                        </div>
                        @enderror

                    @error('nombre')
                        <div class="alert alert-danger">
                            El nombre es obligatorio
                        </div>
                        @enderror

                    @error('apellido')
                        <div class="alert alert-danger">
                            El apellido es obligatorio
                        </div>
                        @enderror

                    @error('correo')
                        <div class="alert alert-danger">
                            El correo es obligatorio
                        </div>
                        @enderror

                    @error('direccion')
                        <div class="alert alert-danger">
                            La dirección es obligatorio
                        </div>
                        @enderror

                    @error('telefono')
                        <div class="alert alert-danger">
                            El teléfono es obligatorio
                        </div>
                        @enderror
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    Doc. de Identificación
                                </span>
                            </div>
                            <input class="form-control" name="cedula" onchange="validarcedula()" style="text-transform:uppercase;" placeholder="Cédula" type="text" value="{{ $EditarCliente->cedula }}"/>
                            {{-- <div class="input-group-append dropright">
                                <button aria-expanded="true" id="btnTipoDoc" aria-haspopup="true" class="btn btn-default dropdown-toggle" data-toggle="dropdown" type="button">
                                    Tipo de Documento
                                </button>
                                <div class="dropdown-menu" id="tiposDoc">
                                    <a class="dropdown-item" href="#">
                                        Cédula
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        RUC - Persona Natural
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        RUC - Sociedad Publica
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        RUC - Sociedad Privada
                                    </a>
                                </div>
                            </div> --}}
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    Nombre y Apellido
                                </span>
                            </div>
                            <input class="form-control" name="nombre" placeholder="Nombre" type="text" value="{{ $EditarCliente->nombre }}"/>
                            <input class="form-control" name="apellido" placeholder="Apellido" type="text" value="{{ $EditarCliente->apellido }}"/>
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    Correo Electrónico
                                </span>
                            </div>
                            <input class="form-control" name="correo" placeholder="Correo electrónico" type="email" value="{{ $EditarCliente->correo }}"/>
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    Dirección
                                </span>
                            </div>
                            <input class="form-control" name="direccion" placeholder="Dirección" type="text" value="{{ $EditarCliente->direccion }}"/>
                        </div>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    Teléfono
                                </span>
                            </div>
                            <input class="form-control" name="telefono" placeholder="Teléfono" type="text" value="{{ $EditarCliente->telefono }}"/>
                        </div>
                        <div align="right" class="card-footer">
                            <button class="btn btn-lg btn-dark" data-placement="bottom" data-toggle="tooltip" title="Editar cliente" type="submit">
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
<script src="https://code.jquery.com/jquery-3.3.1.js">
</script>
<script>
    function validarcedula()
{
 var i;
 var cedula;
 var acumulado;
 cedula=document.getElementById('cedula').value;
 var instancia;
 acumulado=0;
 for (i=1;i<=9;i++)
 {
  if (i%2!=0)
  {
   instancia=cedula.substring(i-1,i)*2;
   if (instancia>9) instancia-=9;
  }
  else instancia=cedula.substring(i-1,i);
  acumulado+=parseInt(instancia);
 }
 while (acumulado>0)
  acumulado-=10;
 if (cedula.substring(9,10)!=(acumulado*-1))
 {
  alert("Cédula no valida!!");
  document.getElementById('cedula').setfocus();
 }
 alert("Cédula valida !!");
}

    $(document).ready(function(){
        $(".dropdown-menu").on('click', 'a', function(){
            $('[id="btnTipoDoc"]').text($(this).text());
            $('[id="btnTipoDoc"]').val($(this).text());
        });
    });


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
<script type="text/javascript">
    function validarcedula(){
        var i;
        var cedula;
        var acumulado;
        cedula=document.getElementById('cedula').value;
        var instancia;
        acumulado=0;
        for (i=1;i<=9;i++){
            if (i%2!=0)
        {
            instancia=cedula.substring(i-1,i)*2;
            if (instancia>9) instancia-=9;
        }else instancia=cedula.substring(i-1,i);
        acumulado+=parseInt(instancia);
        }
        while (acumulado>0)
            acumulado-=10;
        if (cedula.substring(9,10)!=(acumulado*-1)){
            alert("Cédula no valida!!");
            document.getElementById('cedula').setfocus();
        }
        alert("Cédula valida !!");
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