
<table>
    <thead >
    <tr>
        <th>Nombres</th>
        <th>Evento</th>
        <th>Promotor</th>
        <th>Tipo de Ubiacion</th>

        <th>Ingreso </th>
        <th>Link QR</th>

    </tr>
    </thead>
    <tbody>
    @forelse ($socios as $cliente)
        <tr>
            <td>{{ $cliente->nombres }} {{ $cliente->apellidos }}</td>
            <td>{{ $cliente->evento?$cliente->evento->nombre:''}} </td>
            <td>{{ $cliente->promotor?$cliente->promotor->nombre:''}} </td>
            <td>{{$cliente->tipoUbicacion?$cliente->tipoUbicacion->nombre:''}}</td>
            <td  style="{{ $cliente->ingreso ? 'color:green' : 'color:red' }}">{{ $cliente->ingreso ? 'SI' : 'NO' }}</td>
            <td><a href="{{asset('/storage/socios/'.$cliente->id ."/qrcodes/".$cliente->imagen_qr  ) }}"></a>{{asset('/storage/socios/'.$cliente->id ."/qrcodes/".$cliente->imagen_qr  ) }} </td>


        </tr>
    @empty
        <tr>
            <td colspan="5" class="text-center text-muted"><span>No se encontraron resultados</span></td>
        </tr>
    @endforelse

    </tbody>

</table>
