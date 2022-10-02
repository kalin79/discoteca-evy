<table class="mb-0 table table-striped">
    <thead>
    <tr>
        <th>Evento</th>
        <th>Promotor</th>
        <th>Cliente</th>
        <th>Código</th>
        <th>Hora Ingreso </th>
    </tr>
    </thead>
    <tbody>
    @forelse($clientes as $cliente)
        <tr>
            <td>{{$cliente->evento->nombre}}</td>
            <td>{{$cliente->promotor->nombre}}</td>
            <td>{{$cliente->nombres}} {{$cliente->apellidos}}</td>
            <td>{{$cliente->codigo}}</td>
            <td>{{$cliente->fecha_ingreso}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
