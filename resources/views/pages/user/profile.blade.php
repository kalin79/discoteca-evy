@extends('layouts.app')
@section('content')

    <div>
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="metismenu-icon pe-7s-id">
                    </i>
                </div>
                <div>Perfil Usuario
                </div>
            </div>
            <div class="page-title-actions">

            </div>
        </div>
    </div>

    <div class="mb-3 card">
        <div class="card-header">
            <ul class="nav nav-justified">
                <li class="nav-item"><a data-toggle="tab" href="#tab-eg7-0" class="nav-link show" :class="tabForm === 'edit-image' ? 'active' : ''" @click.prevent="tabForm = 'edit-image'">Editar Perfil</a></li>
                <li class="nav-item"><a data-toggle="tab" href="#tab-eg7-1" class="nav-link show" :class="tabForm === 'change-password' ? 'active' : ''" @click.prevent="tabForm = 'change-password'" >Cambiar Contraseña</a></li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content">

                <div class="tab-pane active" id="tab-eg7-0" role="tabpanel" v-if="tabForm === 'edit-image'">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="main-card mb-3 card">
                                <div class="card-body">
                                    <!--                        <h5 class="card-title">Contraseña</h5>-->
                                    <form method="post" @submit.prevent="submitFormAvatar">
                                        <bootstrap-alert/>

                                        <div class="box-body">
                                            <div class="row">
                                                <div class="form-group col-sm-12">
                                                    <label for="name">Nombre (*)</label>
                                                    <input autocomplete="off" type="text" id="name" required class="form-control"
                                                           name="name"
                                                           placeholder="Ingresar nombre"
                                                           v-model="item.name">
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="email">Correo (*)</label>
                                                    <input type="email" id="email" required class="form-control" name="email"
                                                           placeholder="Ingrese correo electrónico"
                                                           v-model="item.email">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group col-sm-12">
                                                    <label for="avatar">Avatar</label>
                                                    <div class="custom-file">
                                                        <input accept="image/*" class="custom-file-input" id="avatar"
                                                               lang="es" type="file" v-on:change="updateAvatar">
                                                        <label class="custom-file-label" for="avatar">Seleccionar avatar</label>
                                                    </div>
                                                    <small>* Sólo se aceptan imágenes JPG y PNG, Máximo de 200kb</small>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="avatar-icon-wrapper mr-2 avatar-icon-xl">
                                                        <div class="avatar-icon">
                                                            <img  class="rounded-circle img-custom"
                                                                  id='img-upload' :src="item.avatar_url+item.avatar"
                                                                  width="100"/>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>

                                        <div class="box-footer">
                                            <button type="submit" :disabled="sendingForm" class="btn btn-primary">
                                                <i v-if="!sendingForm" class="fa fa-save"></i>
                                                <i v-if="sendingForm" class="fa fa-spinner fa-pulse fa-fw" role="status"
                                                   aria-hidden="true"></i>
                                                Guardar
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <change-password v-if="tabForm === 'change-password'"></change-password>
            </div>
        </div>
    </div>
</div>
@endsection
