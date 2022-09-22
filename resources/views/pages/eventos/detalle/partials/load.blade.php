
<div class="row">
    <div class="col-sm">
        <div class="table-wrap">
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead >
                    <tr>

                        <th >Promotor</th>
                        <th >Zona</th>
                        <th >Cant. Código</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($evento_promotores as $evento_promotor)
                        <tr>
                            <td>{{ $evento_promotor->promotor?$evento_promotor->promotor->nombre :''}}</td>
                            <td>{{ $evento_promotor->zona?$evento_promotor->zona->nombre :''}}</td>
                            <td>
                                {{$evento_promotor->cantidad_codigos}}
                            </td>
                            <td>

                                <a title="Exportar Códigos"   href="{{ route('evento.promotor.exportCodigos', $evento_promotor->id) }}" class="btn btn-outline-success btn-sm " >
                                    <i class="fa fa-download"></i>
                                </a>

                                <button  onclick="eliminar({{ $evento_promotor->id }},'{{route("evento.promotor.delete",$evento_promotor->id)}}')" title="Eliminar" class="btn btn-outline-danger btn-sm" data-id="{{ $evento_promotor->id }}">
                                    <i class="fa fa-trash"></i>
                                </button> &nbsp;



                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr >
                        <td colspan="3">{{ $evento_promotores->links() }}</td>
                        <td><span>Total: </span> <b>{{ $evento_promotores->total() }}</b></td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
