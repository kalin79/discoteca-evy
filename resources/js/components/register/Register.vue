<template>
     <div class="pageRegister">
          <header-main></header-main>
          <form class="boxFormRegister" autocomplete="off" id="form-register">
               <div class="row">
                    <div class="col-12 mb-4">
                         <input type="text" class="form-control" autocomplete="nope" placeholder="NOMBRE"  v-model="form.name"/>
                    </div>
                    <div class="col-12 mb-4">
                         <input type="text" class="form-control" autocomplete="nope" placeholder="APELLIDO" v-model="form.lastname"/>
                    </div>
                    <div class="col-12 mb-4">
                         <input type="text" class="form-control" autocomplete="nope" placeholder="E-MAIL" v-model="form.email"/>
                    </div>
                    <div class="col-12 mb-4">
                         <input type="text" class="form-control" autocomplete="nope" maxlength="8" placeholder="DNI" v-model="form.dni"/>
                    </div>
                    <div class="col-12 mb-4">
                         <input type="text" class="form-control" autocomplete="nope" placeholder="DIRECCI&Oacute;N" v-model="form.address"/>
                    </div>
                    <!-- <div class="col-12 mb-4">
                         <select name="district" id="district" class="form-select" v-model="DistrictSelect">
                              <option value="">Selecciona</option>
                              <option v-for="(item, index) in objDistrict " :key="index" :value="item.id">{{ item.name }}</option>
                         </select>
                    </div> -->
                    <div class="col-12 mb-4">
                         <input type="text" class="form-control" autocomplete="nope" placeholder="DISTRITO" v-model="form.district"/>
                    </div>
                    <div class="col-4 mb-4">
                         <select class="form-select" v-model="DaySelect">
                              <option value="">D&iacute;a</option>
                              <option v-for="(item, index) in objDays " :key="index" :value="item.id">{{ item.name }}</option>
                         </select>
                    </div>
                    <div class="col-4 mb-4">
                         <select class="form-select" v-model="MonthSelect">
                              <option value="">Mes</option>
                              <option v-for="(item, index) in objMonths " :key="index" :value="item.id">{{ item.name }}</option>
                         </select>
                    </div>
                    <div class="col-4 mb-4">
                         <select class="form-select" v-model="YearSelect">
                              <option value="">A&ntilde;o</option>
                              <option v-for="(item, index) in objYears " :key="index" :value="item.id">{{ item.name }}</option>
                         </select>
                    </div>
                    <div class="col-12">
                         <div class="buttonSeparate d-flex justify-content-center align-items-center flex-column">
                              <button type="button" class="bgBtnGreen" v-on:click="SendForm" v-if="!boolSend">ENVIAR</button>
                              <div class="spinner-border text-light" role="status"  v-if="boolSend">
                                   <span class="visually-hidden">Loading...</span>
                              </div>
                         </div>
                         <div class="mt-3 d-flex justify-content-center align-items-center">
                              <label class="error txtCenter" id="errorMsn"></label>
                         </div>
                    </div>
               </div>
          </form>
     </div>
</template>
<script>
import { mapActions, mapState, mapGetters, mapMutations } from 'vuex'
export default {
     data() {
          return {
               boolSend: false,
               form: {
                    code: '',
                    name: '',
                    lastname: '',
                    email: '',
                    dni: '',
                    address: '',
                    district: '',
               },
               objYears: [],
               objMonths: [],
               objDays: [],
               objDistrict: [],
               DaySelect: '',
               MonthSelect: '',
               YearSelect: '',
               DistrictSelect: '',
          }
     },
     computed: {
          ...mapGetters({
               getCode: 'user/getCode',
          })
     },
     mounted(){
          this.loadObjectsDays()
          this.loadObjectsMonths()
          this.loadObjectsYears()
          this.loadExpresiones()
     },
     methods: {
          loadExpresiones: function(){
               this.expresiones = {
                    alphanumerico: /^[a-zA-Z0-9]{8,12}$/,
                    vacio: /^\s*$/,
                    email: /^\w+([\.\+\-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/,
                    numeros: /^[0-9]{8}$/,
               }
          },
          loadObjectsYears: function(){
               var _val
               var item
               var objDay = new Date()
               var _m = objDay.getMonth() + 1
               var _d = objDay.getDate()
               var _y = objDay.getFullYear()
               var restricYear = _y - 18
               // console.log(restricYear)

               for (var i=1970; i<=restricYear; i++){
                    if (i > 9)
                         _val = i
                    else
                         _val = `0${i}`
                    item = {
                         "id": i,
                         "name": _val
                    }
                    this.objYears.push(item)
               }
          },
          loadObjectsMonths: function(){
               var _val
               var item
               for (var i=1; i<=12; i++){
                    if (i > 9)
                         _val = i
                    else
                         _val = `0${i}`
                    item = {
                         "id": i,
                         "name": _val
                    }
                    this.objMonths.push(item)
               }
          },
          loadObjectsDays: function(){
               var _val
               var item
               for (var i=1; i<=31; i++){
                    if (i > 9)
                         _val = i
                    else
                         _val = `0${i}`
                    item = {
                         "id": i,
                         "name": _val
                    }
                    this.objDays.push(item)
               }
          },
          errorMessage: function(errors){
               let _this = this
               $.each(errors, function(key, value) {
                    // console.log(key, value)
                    _this.messageError(value)
               })
               this.boolSend = false
          },
          messageError: function(msn){
               $('#form-register .error').addClass('active')
               $('#form-register .error').html(msn)
               this.boolSend = false
          },
          async processData (){
               try{
                    let fecha_nacimiento =`${this.YearSelect}-${this.MonthSelect}-${this.DaySelect}`
                    let formData = new FormData();
                    formData.append('nombres', this.form.name)
                    formData.append('email', this.form.email)
                    formData.append('dni', this.form.dni)
                    formData.append('apellidos', this.form.lastname)
                    formData.append('direccion', this.form.address)
                    formData.append('fecha_nacimiento', fecha_nacimiento)
                    formData.append('ciudad', 'Lima')
                    formData.append('distrito', this.form.district)
                    formData.append('codigo', this.getCode.toUpperCase())
                    formData.append('tyc', 1)
                    formData.append('tyc_publicidad', 0)
                    
                    
                    const headers = { 
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                         'Content-Type': 'application/json'
                    }

                    let sendSolicitud = await axios.post('/cliente/save/', formData ,{ headers })
          
                    if (sendSolicitud.data.code === 201) {
                         this.$store.commit('user/setUser', sendSolicitud.data.data)
                         setTimeout(function(){
                              top.location.href = '/gracias'
                         }, 1000)
                         
                    }else{
                         this.messageError('No se ha podido registrar, intentelo mas tarde.!')
                         return false
                    }
                    
               } catch (error) {
                    console.log(error);
                    if (error.response.data.code === 404){
                         this.errorMessage(error.response.data.data)
                    }
               } finally{
                    this.boolSend = false
               }
          },
          SendForm(){
               this.boolSend = true
               if ($('#form-register .error').hasClass('active'))
                    $('#form-register .error').removeClass('active')
               if (this.expresiones.vacio.test(this.form.name)){
                    this.messageError('El campo nombre es obligatorio')
                    return false
               }else{
                    if (this.expresiones.vacio.test(this.form.lastname)){
                         this.messageError('El campo apellido es obligatorio')
                         return false
                    }else{
                         if (!this.expresiones.email.test(this.form.email)){
                              this.messageError('No es un correo válido')
                              return false
                         }else{
                              if (this.form.dni.match(this.expresiones.numeros) == null ){
                                   this.messageError('El campo DNI es numerico y de 8 digitos')
                                   return false
                              }else{
                                   if (this.expresiones.vacio.test(this.form.address)){
                                        this.messageError('El campo dirección es obligatorio')
                                        return false
                                   }else{
                                        if (this.expresiones.vacio.test(this.form.district)){
                                             this.messageError('El campo Distrito es obligatorio')
                                             return false
                                        }else{
                                             if (this.expresiones.vacio.test(this.DaySelect)){
                                                  this.messageError('El campo Día es obligatorio')
                                                  return false
                                             }else{
                                                  if (this.expresiones.vacio.test(this.MonthSelect)){
                                                       this.messageError('El campo Mes es obligatorio')
                                                       return false
                                                  }else{
                                                       if (this.expresiones.vacio.test(this.YearSelect)){
                                                            this.messageError('El campo Año es obligatorio')
                                                            return false
                                                       }else{
                                                            this.processData()
                                                       }
                                                  }
                                             }
                                        }
                                   }
                              }
                         }
                    }
               }
          }
     }
}
</script>