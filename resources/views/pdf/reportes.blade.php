<!DOCTYPE html>
<html lang="en">
    <head>
        <link crossorigin="anonymous" href="https://cdnjs.cloudflare.com/ajax/libs/css-loader/3.3.3/css-loader.css" integrity="sha256-APor1ffEkcCbfSB7MMvBCj6+itRX/blZ5h4p/gbnRgk=" rel="stylesheet"/>
        <link href="style.css" rel="stylesheet" type="text/css">
        <meta charset="utf-8">
        {{--
        <meta content="width=device-width, initial-scale=1" name="viewport">
            --}}
 {{--
            <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css" rel="stylesheet">
                --}}
                
                    <style>
                            /*h1, h2{
                    color: #93905C;

                }
                h3{
                    color: #EA3434;
                }*/

                table{
                    border-collapse:collapse;
                    border-radius: 20px;
                    width:100%;
                    border: 2px solid;
                    text-align: center;
                    
                    /*margin: 0 0 1em 0;*/
                    /*width: 25%;*/
                }

                td, th{
                    color: #000;
                    border-bottom-style:solid;
                    border-width: 0.1px; 
                }
                    </style>
    </head>
    <body>
        <header>
            <table align="center" border="1" class="table" style="width: 100%; text-align: center;">
                <thead>
                    <tr style="border: hidden;">
                        <th rowspan="4" style="border: hidden;">
                            <img src="C:\xampp\htdocs\ProyectoDH\public\images\imagenes\logo-pdf.png">
                        </th>
                        <th colspan="2" style="border: hidden;">
                            DAVID'S HAMBURGERS
                        </th>
                    </tr>
                </thead>
                <tbody style="border: hidden;">
                    <tr style="border: hidden;">
                        <td style="border: hidden;">
                            RUC: 1303090391001
                        </td>
                        <td style="border: hidden;">
                            Calle 18 y Avenida 6
                        </td>
                    </tr>
                    <tr style="border: hidden;">
                        <td style="border: hidden;">
                            Tlf.: 099 765 9228
                        </td>
                        <td style="border: hidden;">
                            Manta - Manabí - Ecuador
                        </td>
                    </tr>
                    <tr style="border: hidden;">
                        <td colspan="2" style="border: hidden;">
                            Correo Electrónico: davidhamburguesasmanta@gmail.com
                        </td>
                    </tr>
                </tbody>
            </table>
        </header>
        @if($fechaInicioL == $fechaFinL)
        <h2 align="center" style="text-transform: uppercase; color: #93905C;">
            REPORTE DE VENTAS DEL DÍA:
            <br>
                {{ $fechaFinL }}
            </br>
        </h2>
        
        @else
        <h2 align="center" style="text-transform: uppercase; color: #93905C;">
            REPORTE DE VENTAS DESDE el día:<br> {{ $fechaInicioL }} <br>HASTA el día: <br>{{ $fechaFinL }}
        </h2>
        @endif
        <table align="center" class="table" style="width: 100%;">
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
            <tbody>
                <?php
                            $i = 0;
                            ?>
                @foreach($reportePDF as $rpt)
                <?php $i++; ?>
                <tr>
                    <th scope="row">
                        {{ $i }}
                    </th>
                    <td>
                        {{ $rpt->fecha }}
                    </td>
                    <td>
                        {{ $rpt->cantidad }}
                    </td>
                    <td>
                        {{ $rpt->nombre }}
                    </td>
                    <td>
                        $ {{ $rpt->valor }}
                    </td>
                    <td>
                        $ {{ $rpt->total }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <h3 align="right" style="text-transform: uppercase;">
            Total: $ {{ $total->total }}
        </h3>
    </body>
</html>