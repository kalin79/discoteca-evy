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
    @forelse($evento_zonas as $data)
        <tr>
            <td>{{$data['evento']}}</td>
            <td>{{$data['zona']}}</td>
            <td>{{$data['promotor']}}</td>
            <td>{{$data['cantidad_codigos']}}</td>
            <td>{{$data['cantidad_codigos_registrados']}}</td>
            <td>{{$data['cantidad_codigos_ingreso']}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
