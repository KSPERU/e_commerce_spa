<template>
    <h1 class="modal-title fs-5 fw-semibold size-22 text-center mt-3 mb-2" id="exampleModalLabel">Ingresa a tu cuenta</h1>
    <div v-if="datos_de_acceso && Object.keys(datos_de_acceso).length > 0" class="mb-3 px-3">
        <div class="alert alert-success" role="alert">
            <p class="mb-0">Bienvenido {{ datos_de_acceso.user }}!</p>
        </div>
    </div>
    <div v-else-if="Object.keys(datos_de_acceso).length === 0 && formularioEnviado === true" class="mb-3 px-3">
        <div class="alert alert-danger" role="alert">
            <p class="mb-0">Usuario o contraseña incorrectos.</p>
        </div>
    </div>
    <form @submit.prevent="acceder(formData)">
        <div class="mb-3 px-3">
            <label for="correo" class="form-label size-16">Correo</label>
            <input type="email" class="form-control size-16" id="correo" placeholder="name@example.com" v-model="formData.username">
        </div>
        <div class="mb-3 px-3">
            <label for="password" class="form-label size-16">Contraseña</label>
            <input type="password" class="form-control size-16" id="password" placeholder="*********" v-model="formData.password">
        </div>
        <div class="px-3 pb-2 mt-2">
            <button type="submit" class="btn btn-ingresar w-100">Ingresar</button>
        </div>
    </form>
</template>
<script setup>
    import { onMounted, computed, ref } from "vue";
    import { useGeneralContenedor } from '../../general/generalContenedor';

    const generalContenedor = useGeneralContenedor();

    const formData = ref({
        username: '',
        password: ''
    });

    const datos_de_acceso = computed(() => {
        return generalContenedor.DATOSDEACCESO
    })

    const formularioEnviado = ref(false);

    const acceder = async (formData) => {
        await generalContenedor.getDatosDeAcceso({
                "username": formData.username,
                "password": formData.password
        });
        formularioEnviado.value = true;
        window.location.reload();
    };
</script>