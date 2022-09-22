
<div class="row">
    <div class="col-sm">
        <div class="table-wrap">
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead >
                    <tr>
                        <th >Nombre</th>
                        <th >Cant Código</th>
                        <th >Promotores</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($eventos as $evento)
                        <tr>
                            <td>{{ $evento->nombre }}</td>
                            <td>{{ $evento->cantidad_codigo }}</td>
                            <td>
                                <a title="Complementos" href="{{ route('evento.promotor.index', $evento->id) }}"
                                   class="btn btn-outline-primary btn-sm">
                                    {{ $evento->evento_promotores_count }}
                                </a>
                            </td>
                            <td>

                                <a title="Editar" data-name="{{$evento->nombre}}"  href="{{ route('evento.edit', $evento->id) }}" class="btn btn-outline-info btn-sm edit-entity" >
                                    <i class="fa fa-pen"></i>
                                </a> &nbsp;

                                <button  onclick="eliminar({{ $evento->id }},'{{route("evento.delete",$evento->id)}}')" title="Eliminar" class="btn btn-outline-danger btn-sm" data-id="{{ $evento->id }}">
                                    <i class="fa fa-trash"></i>
                                </button> &nbsp;



                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr >
                        <td colspan="1">{{ $eventos->links() }}</td>
                        <td><span>Total: </span> <b>{{ $eventos->total() }}</b></td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
