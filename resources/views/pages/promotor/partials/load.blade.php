
<div class="row">
    <div class="col-sm">
        <div class="table-wrap">
            <div class="table-responsive">
                <table class="table table-striped mb-0">
                    <thead >
                    <tr>
                        <th >DNI</th>
                        <th >Nombre</th>
                        <th>Edad</th>
                        <th>Sexo</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($promotores as $promotor)
                        <tr>
                            <td>{{ $promotor->dni }}</td>
                            <td>{{ $promotor->nombre }}</td>
                            <td>{{ $promotor->edad }}</td>
                            <td>{{ $promotor->sexo }}</td>



                            <td>

                                <a title="Editar" data-name="{{$promotor->nombre}}"  href="{{ route('promotor.edit', $promotor->id) }}" class="btn btn-outline-info btn-sm edit-entity" >
                                    <i class="fa fa-pen"></i>
                                </a> &nbsp;

                                <button  onclick="eliminar({{ $promotor->id }},'{{route("promotor.delete",$promotor->id)}}')" title="Eliminar" class="btn btn-outline-danger btn-sm" data-id="{{ $promotor->id }}">
                                    <i class="fa fa-trash"></i>
                                </button> &nbsp;



                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr >
                        <td colspan="4">{{ $promotores->links() }}</td>
                        <td><span>Total: </span> <b>{{ $promotores->total() }}</b></td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
