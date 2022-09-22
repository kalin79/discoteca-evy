<div class="row row-alert" ></div>

<form action="{{ route('promotor.store') }}" method="POST" id="form-promotor-create" class="form-horizontal needs-validation">
    @csrf
    <div class="modal-body admin-form">
        <div class="form-group row">
            <label for="nombre" class="col-sm-3 control-label">Nombre</label>
            <div class="col-sm-9">
                <label class="field">
                    <input type="text" name="nombre" id="nombre" class="form-control gui-input" required  placeholder="Nombre" >
                </label>
            </div>
        </div>
        <div class="form-group row">
            <label for="email" class="col-sm-3 control-label">Email</label>
            <div class="col-sm-9">
                <label class="field">
                    <input type="text" name="email" id="email" class="form-control gui-input" required  placeholder="Email" >
                </label>
            </div>
        </div>

        <div class="form-group row">
            <label for="dni" class="col-sm-3 control-label">DNI</label>
            <div class="col-sm-9">
                <label class="field">
                    <input type="text" name="dni" id="dni" class="form-control gui-input only_number" placeholder="DNI..." >
                </label>

            </div>
        </div>
        <div class="form-group row">
            <label for="edad" class="col-sm-3 control-label">Edad</label>
            <div class="col-sm-9">
                <label class="field">
                    <input type="text" name="edad" id="edad" class="form-control gui-input only_number"   placeholder="Edad" >
                </label>
            </div>
        </div>

        <div class="form-group row">
            <label for="sexo" class="col-sm-3 control-label">Sexo</label>
            <div class="col-sm-9">
                <label class="field">
                    <input type="text" name="sexo" id="sexo" class="form-control gui-input " placeholder="Sexo..." >
                </label>

            </div>
        </div>
    </div>
</form>

