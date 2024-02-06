<template>
<div>
    <mostrarVistaCarrito v-if="mostrarVistaCarrito" />

    <mostrarMetodosPago v-if="metodocompra === ''"/>
</div>

</template>

<script setup>
    import mostrarVistaCarrito from './mostrarVistaCarrito';
    import mostrarMetodosPago from './mostrarMetodosPago';
    import {ref, onMounted} from 'vue';
    const metodocompra = ref('');
    
    onMounted(() => {
        if (document.getElementById('appcarrito')) {
             metodocompra.value = document.getElementById('appcarrito').getAttribute('metodo-compra');
        }
    })
</script>