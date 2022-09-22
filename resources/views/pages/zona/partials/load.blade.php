
<div class="row">
    <div class="col-sm">
        <div class="table-wrap">
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead >
                    <tr>
                        <th >Nombre</th>

                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($zonas as $zona)
                        <tr>
                            <td>{{ $zona->nombre }}</td>



                            <td>

                                <a title="Editar" data-name="{{$zona->nombre}}"  href="{{ route('zona.edit', $zona->id) }}" class="btn btn-outline-info btn-sm edit-entity" >
                                    <i class="fa fa-pen"></i>
                                </a> &nbsp;

                                <button  onclick="eliminar({{ $zona->id }},'{{route("zona.delete",$zona->id)}}')" title="Eliminar" class="btn btn-outline-danger btn-sm" data-id="{{ $zona->id }}">
                                    <i class="fa fa-trash"></i>
                                </button> &nbsp;



                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr >
                        <td >{{ $zonas->links() }}</td>
                        <td><span>Total: </span> <b>{{ $zonas->total() }}</b></td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
