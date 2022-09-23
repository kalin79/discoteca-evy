<table class="mb-0 table table-striped">
    <thead>
    <tr>
        <th>Evento</th>
        <th>Zona</th>
        <th>promotor</th>
        <th>Cantidad de códigos</th>
        <th>Cantidad registrados</th>
        <th>Cantidad ingreso</th>
    </tr>
    </thead>
    <tbody>
        @forelse($evento_zonas as $evento_zona)
            <tr>
                <td>{{$evento_zona->evento->nombre}}</td>
                <td>{{$evento_zona->zona->nombre}}</td>
                <td>{{$evento_zona->promotor->nombre}}</td>
                <td>{{$evento_zona->cantidad_codigos}}</td>
                <td>{{$evento_zona->cantidad_codigos_registrados}}</td>
                <td>{{$evento_zona->cantidad_codigos_ingreso}}</td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center text-muted"><span>No se encontraron resultados</span></td>
            </tr>
        @endforelse
    </tbody>
    <tfoot>
    <tr>
        <td colspan="5">{{ $evento_zonas->links() }}</td>
        <td><span>Total: </span> <b>{{ $evento_zonas->total() }}</b></td>
    </tr>
    </tfoot>
</table>