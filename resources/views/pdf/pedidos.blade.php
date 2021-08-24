<!DOCTYPE html>
<html lang="en">
    <head>
        <link crossorigin="anonymous" href="https://cdnjs.cloudflare.com/ajax/libs/css-loader/3.3.3/css-loader.css" integrity="sha256-APor1ffEkcCbfSB7MMvBCj6+itRX/blZ5h4p/gbnRgk=" rel="stylesheet"/>
        <link href="style.css" rel="stylesheet" type="text/css">
        <meta charset="utf-8">
        <style>
            table{
                border-collapse:collapse;
                border-radius: 20px;
                width:100%;
                border: 2px solid;
                text-align: center;
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
            <h2 align="center" style="text-transform: uppercase;">DAVID'S HAMBURGERS</h2>
            <h3 align="center" style="text-transform: uppercase;">Calle 18 y Avenida 6</h3>
            <h3 align="center" style="text-transform: uppercase;">RUC: 1303090391001</h3>
            <h3 align="center" style="text-transform: uppercase;">Tlf.: 099 765 9228</h3>
            <h4>Pedido # {{ $id }}</h4>
            {{-- <h4>Cliente: {{ $cliente }}</h4> --}}
        </header>
        <table align="center" style="width: 100%; border: hidden;">
            <thead align="center" class="thead-light">
                <tr>
                    <th scope="col">
                        Cantidad
                    </th>
                    <th scope="col">
                        Descripción
                    </th>
                    <th scope="col">
                        P. Unitario
                    </th>
                    <th scope="col">
                        Total
                    </th>
                </tr>
            </thead>
            <tbody align="left">
                @foreach($pedidos as $item)
                <tr>
                    <td style="border: hidden;" align="center">{{ $item->cantidad }}</td>
                    <td style="border: hidden;">{{ $item->nombre }}</td>
                    <td style="border: hidden;" align="center">{{ $item->valor }}</td>
                    <td style="border: hidden;" align="center">{{ $item->total }}</td>
                </tr>
                @endforeach 
            </tbody>
        </table>
        <h3 align="right" style="text-transform: uppercase;">
            Total: $ {{ $total_final }}
        </h3>
    </body>
</html>