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
            <td>{{$evento_zona->zona->cantidad_codigos}}</td>
            <td>{{$evento_zona->cantidad_codigos_registrados}}</td>
            <td>{{$evento_zona->cantidad_codigos_ingreso}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
