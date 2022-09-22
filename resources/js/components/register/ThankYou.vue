<template>
     <div class="pageThank" v-if="getUser">
          <div class="container">
               <div class="d-flex justify-content-start align-items-center flex-column">
                    <div class="boxLogoIco">
                         <img src="/frontend/logo2.png" alt="">
                    </div>
                    <!-- <div class="boxLogo">
                         <img src="/frontend/logo.svg" >
                    </div> -->
                    <div class="boxThank">
                         <h1 class="txtCenter mt-4">¡Gracias por registrarte!</h1>
                         <p class="txtCenter mt-2">
                              No olvides verificar si te llegó <br>
                              la invitacion al mail1
                         </p>
                    </div>
                    <div class="boxQr">
                         <img :src="`/storage/cliente/${getUser.data.id}/qrcodes/${getUser.data.imagen_qr}`" >
                    </div>
                    <div class="boxDatos">
                         <div class="boxCliente">
                              <p>{{ getUser.data.nombres }} {{ getUser.data.apellidos }}</p>
                         </div>
                         <div class="boxZona">
                              <p>{{ getUser.evento.nombre }}</p>
                         </div>
                         <div class="boxZona">
                              <p>{{ getUser.zona.nombre }}</p>
                         </div>
                         
                         <div class="boxPromotor mt-4">
                              <p>{{ getUser.promotor.nombre }}</p>
                         </div>
                    </div>
               </div>
          </div>
          <div class="footerThank">
               <div class="container">
                    <div class="d-flex justify-content-between align-items-start">
                         <div>
                              <h2 class="bold">DRESSCODE</h2>
                              <p>NIGHTLIFE FASHION</p>
                         </div>
                         <div>
                              <h2 class="txtRight bold">INGREO VÁLIDO</h2>
                              <p class="txtRight">HASTA LAS 12:30 A.M.</p>
                              <p class="mt-2 txtRight bold">& MAYORES DE 27</p>
                         </div>
                    </div>

                    <div class="boxFecha d-flex justify-content-between align-items-start">
                         <div class="f1">
                              <img src="/frontend/fecha.png" alt="">
                         </div>
                         <div class="f2">
                              <img src="/frontend/fecha2.png" alt="">
                         </div>
                    </div>
               </div>
          </div>
     </div>
</template>
<script>
import { mapActions, mapState, mapGetters, mapMutations } from 'vuex'
export default {
     computed: {
          ...mapGetters({
               getUser: 'user/getUser',
          })
     },
}
</script>