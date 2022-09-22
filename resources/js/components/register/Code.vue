<template>
     <div class="pageCode d-flex justify-content-center align-items-center flex-column" >
          <header-main></header-main>
          <form class="" id="form-code" onclick="event.preventDefault()">
               <div class="row">
                    <div class="col-12">
                         <div class="d-flex justify-content-center align-items-center">
                              <input type="text" class="form-control" minlength="7" maxlength="12" placeholder="C&Oacute;DIGO DE ACCESO" v-model="form.code" v-on:keypress="onEnter($event)"/>
                         </div>
                         <div class="d-flex justify-content-center align-items-center">
                              <label class="error txtCenter" id="errorCode"></label>
                         </div>
                    </div>
                    <div class="col-12">
                         <div class="buttonSeparate d-flex justify-content-center align-items-center flex-column">
                              <button type="button" class="bgBtnGreen" v-on:click="SendForm" v-if="!boolSend">INGRESAR</button>
                              <div class="spinner-border text-light" role="status"  v-if="boolSend">
                                   <span class="visually-hidden">Loading...</span>
                              </div>
                         </div>
                         
                         
                    </div>
               </div>
          </form>
     </div>
</template>
<script>
export default {
     data() {
          return {
               boolSend: false,
               form: {
                    code: ''
               }
          }
     },
     mounted(){
          this.loadExpresiones()
     },
     methods: {
          onEnter: function(event){
               console.log(event.keyCode)
               if (event.keyCode === 13)
                    event.preventDefault()
               
          },
          errorMessage: function(errors){
               let _this = this
               $.each(errors, function(key, value) {
                    // console.log(key, value)
                    _this.messageError(value)
               })
               this.boolSend = false
          },
          loadExpresiones: function(){
               this.expresiones = {
                    alphanumerico: /^[a-zA-Z0-9]{7,12}$/,
                    vacio: /^\s*$/,
               }
          },
          messageError: function(msn){
               $('#form-code .error').addClass('active')
               $('#form-code .error').html(msn)
               this.boolSend = false
          },
          async processData (){
               try{
                    let formData = new FormData();
                    formData.append('codigo', this.form.code.toUpperCase())
                    
                    const headers = { 
                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                         'Content-Type': 'application/json'
                    }

                    let sendSolicitud = await axios.post('/cliente/validar-codigo', formData ,{ headers })
                    console.log(sendSolicitud.data)

                    if ( sendSolicitud.data.code === 200 ){
                         this.$store.commit('user/setCode', this.form.code)   
                         this.$store.commit('user/setBoolCode', true)   
                    }else{

                    }
                    
               } catch (error) {
                    console.log(error);
                    if (error.response.data.code === 404){
                         this.errorMessage(error.response.data.data)
                    }
               } finally{
                    this.boolSend = false
                    // this.messageError('Hubo problemas intentelo m&aacute;s tarde !')
               }
          },
          deletedLoadMessage(){
               if ($('#form-code .error').hasClass('active')){
                    $('#form-code .error').removeClass('active')
               }
          },
          SendForm(){
               this.boolSend = true
               this.deletedLoadMessage()
               if (this.expresiones.vacio.test(this.form.code)){
                    console.log('mensaje de error')
                    this.messageError('El campo código es obligatorio')
                    
               }else{
                    console.log(this.expresiones.alphanumerico.test(this.form.code))
                    if (this.expresiones.alphanumerico.test(this.form.code)){
                         // console.log('cool')
                         this.processData()
                    }else{
                         console.log('no es numero')
                         this.messageError('Debe contener entre 7 a 12 digitos')
                         
                    }
               }
          }
     }
}
</script>