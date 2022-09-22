<table class="mb-0 table table-striped">
    <thead>
    <tr>
        <th>Evento</th>
        <th>Zona</th>
        <th>Cantidad de códigos</th>
        <th>Cantidad registrados</th>
        <th>Cantidad ingreso</th>
    </tr>
    </thead>
    <tbody>
    @forelse($datos as $data)
        <tr>
            <td>{{$data['evento']}}</td>
            <td>{{$data['zona']}}</td>
            <td>{{$data['cantidad_codigos']}}</td>
            <td>{{$data['cantidad_codigos_registrados']}}</td>
            <td>{{$data['cantidad_codigos_ingreso']}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
