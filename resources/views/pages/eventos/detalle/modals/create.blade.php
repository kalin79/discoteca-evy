<div class="row row-alert" ></div>

<form action="{{ route('evento.promotor.store') }}" method="POST" id="form-evento-promotor-create" class="form-horizontal needs-validation">
    @csrf
    <input type="hidden" name="evento_id" value="{{$evento->id}}">
    <div class="modal-body admin-form">
        <div class="form-group row">
            <label class="col-sm-3 control-label" for="roles">Promotor</label>
            <div class="col-sm-9">
                <label class="field select">
                    <select name="promotor_id" id="cmb_promotor" class="form-control  gui-input" placeholder="Seleccione promotor" style="width: 100%">
                        <option ></option>
                        @foreach($promotores as $promotor)
                            <option value="{{$promotor->id}}" >{{$promotor->nombre}}</option>
                        @endforeach
                    </select>
                </label>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-sm-3 control-label" for="roles">Zona</label>
            <div class="col-sm-9">
                <label class="field select">
                    <select name="zona_id" id="cmb_zona" class="form-control  gui-input" placeholder="Seleccione zona" style="width: 100%">
                        <option ></option>
                        @foreach($zonas as $zona)
                            <option value="{{$zona->id}}" >{{$zona->nombre}}</option>
                        @endforeach
                    </select>
                </label>
            </div>
        </div>
        <div class="form-group row">
            <label for="email" class="col-sm-3 control-label">Cantidad Códigos</label>
            <div class="col-sm-9">
                <label class="field">
                    <input type="text" name="cantidad_codigos" id="cantidad_codigos" class="form-control gui-input only_number" placeholder="Cantidad Códigos..." >
                </label>

            </div>
        </div>
    </div>
</form>


