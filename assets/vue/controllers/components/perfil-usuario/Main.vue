<template>
    <div class="container">
        <div class="row mt-3">
            <div class="col-12 col-sm-12 col-md-12 col-lg-3">

                <Info_PerfilUsuario />

                <Btns_Config />

                <Card_FiltrosAvanzados />

            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-9 my-4">   
                <Cards_Perfil_Usuario />
            </div>
        </div>
    </div>
</template>

<script>
import Info_PerfilUsuario from "./Info_PerfilUsuario.vue";
import Btns_Config from "./Btns_Config.vue";
import Card_FiltrosAvanzados from "./Card_FiltrosAvanzados.vue";
import Cards_Perfil_Usuario from "./Cards_Perfil_Usuario.vue";


export default{
    components:{
        Info_PerfilUsuario,
        Btns_Config,
        Card_FiltrosAvanzados,
        Cards_Perfil_Usuario
    }
};
</script>