<div class="row row-alert" ></div>

<form action="{{ route('socio.update',$socio->id) }}" method="POST" id="form-socio-edit" class="form-horizontal needs-validation">
    @csrf
    <div class="modal-body admin-form">
        <div class="form-group row">
            <label for="nombre" class="col-sm-3 control-label">Nombre</label>
            <div class="col-sm-9">
                <label class="field">
                    <input type="text" name="nombres" id="nombre" class="form-control gui-input" required  placeholder="Nombre"  value="{{$socio->nombres}}">
                </label>
            </div>
        </div>
        <div class="form-group row">
            <label for="nombre" class="col-sm-3 control-label">Apellido</label>
            <div class="col-sm-9">
                <label class="field">
                    <input type="text" name="apellidos" id="nombre" class="form-control gui-input"   placeholder="Nombre" value="{{$socio->apellidos}}">
                </label>
            </div>
        </div>

        {{--<div class="form-group row">
            <label for="class" class="col-sm-3 control-label">Evento</label>
            <div class="col-sm-9">
                <label class="field select">
                    <select name="evento_id" id="cmb_evento" class="form-control  gui-input" placeholder="Seleccione evento" style="width: 100%">
                        <option ></option>
                        @foreach($eventos as $evento)
                            <option value="{{$evento->id}}" @if($evento->id== $socio->evento_id) selected @endif>{{$evento->nombre}}</option>
                        @endforeach
                    </select>
                </label>
            </div>
        </div>
        --}}
        <div class="form-group row">
            <label for="cmb_promotor" class="col-sm-3 control-label">Promotor</label>
            <div class="col-sm-9">
                <label class="field select">
                    <select name="promotor_id" id="cmb_promotor" class="form-control  gui-input" placeholder="Seleccione promotor" style="width: 100%">
                        <option ></option>
                        @foreach($promotores as $promotor)
                            <option value="{{$promotor->id}}" @if($promotor->id== $socio->promotor_id) selected @endif >{{$promotor->nombre}}</option>
                        @endforeach
                    </select>
                </label>
            </div>
        </div>
        {{--<div class="form-group row">
            <label for="cmb_ubicacion" class="col-sm-3 control-label">Tipo Ubicacion</label>
            <div class="col-sm-9">
                <label class="field select">
                    <select name="tipo_ubicacion_id" id="cmb_ubicacion" class="form-control  gui-input" placeholder="Seleccione ubicación" style="width: 100%">
                        <option ></option>
                        @foreach($ubicaciones as $ubicacion)
                            <option value="{{$ubicacion->id}}" @if($ubicacion->id== $socio->tipo_ubicacion_id) selected @endif >{{$ubicacion->nombre}}</option>
                        @endforeach
                    </select>
                </label>
            </div>
        </div>--}}


    </div>
</form>

