<div class="row row-alert" ></div>

<form action="{{ route('evento.promotor.update',$zona->id) }}" method="POST" id="form-evento-promotor-edit" class="form-horizontal needs-validation">
    @csrf
    <div class="modal-body admin-form">
        <div class="form-group row">
            <label for="nombre" class="col-sm-3 control-label">Nombre</label>
            <div class="col-sm-9">
                <label class="field">
                    <input type="text" name="nombre" id="nombre" value="{{$zona->nombre}}" class="form-control gui-input" required  placeholder="Nombre" >
                </label>
            </div>
        </div>

        <div class="form-group row">
            <label for="email" class="col-sm-3 control-label">Cantidad</label>
            <div class="col-sm-9">
                <label class="field">
                    <input type="text" name="cantidad_codigos" id="cantidad_codigos" value="{{$zona->cantidad_codigos}}" class="form-control gui-input only_number" placeholder="Cantidad Códigos..." >
                </label>

            </div>
        </div>
    </div>
</form>

