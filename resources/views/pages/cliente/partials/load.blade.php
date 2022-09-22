
<div class="row">
    <div class="col-sm">
        <div class="table-wrap">
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead >
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Promotor</th>
                            <th>Evento </th>
                            <th>Zona</th>
                            <th class="text-center">Ingreso</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($clientes as $cliente)
                            <tr>
                                <td>{{ $cliente->nombres }}</td>
                                <td>{{ $cliente->apellidos }}</td>
                                <td>{{ $cliente->promotor?$cliente->promotor->nombre:''}} </td>
                                <td>{{ $cliente->evento ? $cliente->evento->nombre:''}} </td>
                                <td>{{ $cliente->zona ?$cliente->zona->nombre:''}} </td>
                                @if($cliente->ingreso)
                                    <td class="text-center"><span class="badge badge-success">SI</span></td>
                                @else
                                    <td class="text-center"><span class="badge badge-danger">NO</span></td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted"><span>No se encontraron resultados</span></td>
                            </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="5">{{ $clientes->links() }}</td>
                            <td><span>Total: </span> <b>{{ $clientes->total() }}</b></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
