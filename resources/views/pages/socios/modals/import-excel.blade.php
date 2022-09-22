<div class="row row-alert"></div>

<form action="{{ route('socio.import-save') }}" method="POST" id="form-import-excel"
      class="form-horizontal " enctype="multipart/form-data">
    @csrf
    <div class="modal-body admin-form">
        {{-- <div class=" row">

            <div class="form-group col-sm-9">
                <label  for="roles">Evento</label>
                <label class="field select">
                    <select name="evento_id" id="cmb_evento" class="form-control  gui-input" placeholder="Seleccione evento" style="width: 100%">
                        <option ></option>
                        @foreach($eventos as $evento)
                            <option value="{{$evento->id}}" >{{$evento->nombre}}</option>
                        @endforeach
                    </select>
                </label>
            </div>
        </div> --}}
        <div class="row">
            <div class="form-group col-sm-12">
                <label for="price_partner">Selecionar archivo:</label>
                <label class="field">
                    <input type="file" id="fileExcel" ref="fileExcel"  name="file_excel"   class="form-control">
                </label>

            </div>
        </div>
    </div>
</form>
