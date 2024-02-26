<template>
    <div class="card card-perfil-usuario my-1 my-md-2 my-lg-3 text-center py-2 py-lg-4 d-flex flex-row flex-lg-column px-2 align-items-center">
        <figure class="m-0">
            <img src="../../img/usuario-ejemplo.png" class="avatar-perfil-usuario"
                alt="avatar-perfil-usuario" />
        </figure>
        <div class="px-2 px-sm-3 px-md-4 px-lg-1 px-xl-3 px-xxl-5">
            <div class="my-0 my-lg-2 ">
                <h6 class="text-start text-md-center size-22">
                    {{ usuario.u_nombres }}
                    {{ usuario.u_apepat }} {{ usuario.u_apemat }}
                </h6>
            </div>
            <div class="text-start">
                <div class="m-0 text-truncate email-phone-width-truncate d-flex align-items-center my-1">
                    <font-awesome-icon icon="envelope" />
                    <span class="mx-2 size-14 ">{{ usuario.u_correo }}</span>
                </div>
                <div class="m-0 text-truncate email-phone-width-truncate d-flex align-items-center my-1">
                    <font-awesome-icon icon="square-phone" />
                    <span class="mx-2 size-14 ">{{ usuario.u_telefono }}</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { ref, onMounted } from 'vue'
    import axios from 'axios'
    const usuario = ref({})
    onMounted(() => {
        const currentURL = window.location.href
        const segments = currentURL.split("/")
        const idusuario = parseInt(segments[segments.length - 1])
        obtenerPerfilUsuario(idusuario)
    })
    async function obtenerPerfilUsuario(idusuario) {
        try {
            console.log(idusuario)
            const response = await axios.post('/api/carrito/listar/usuario', { id_usuario: idusuario })
            usuario.value = response.data[0]
        } catch (error) {
            console.log(error)
        }
    }
</script>

<style scoped>
.card-perfil-usuario{
    background-color: var(--color-azul-oscuro);
    color: #fff;
}
.avatar-perfil-usuario{
    width: auto;
}

.email-phone-width-truncate{
    width: auto;
    max-width: 210px;
}

@media (max-width: 575.98px) { 
    .avatar-perfil-usuario{
        width: 50px;
    }

    .email-phone-width-truncate{
        width: 200px;
    }
}

@media (max-width: 767.98px) { 
}

@media (max-width: 991.98px) { 
    .avatar-perfil-usuario{
        width: 80px;
    }
 }

@media (max-width: 1199.98px) {  }

@media (max-width: 1399.98px) {  }
</style>