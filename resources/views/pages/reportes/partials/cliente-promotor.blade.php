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
        @empty
            <tr>
                <td colspan="4" class="text-center text-muted"><span>No se encontraron resultados</span></td>
            </tr>
        @endforelse
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3">{{ $clientes->links() }}</td>
            <td><span>Total: </span> <b>{{ $clientes->total() }}</b></td>
        </tr>
    </tfoot>
</table>
