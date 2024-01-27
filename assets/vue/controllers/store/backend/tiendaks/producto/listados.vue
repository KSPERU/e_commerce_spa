<template>
    <button @click="actualizarDatosPinia"  class="btn btn-primary">!Funciona¡</button>
</template>
  
<script setup>
    import { useProductoModulo } from '../producto/productoModulo';
  
    const productoModulo = useProductoModulo();
  
    const actualizarDatosPinia = () => {
        productoModulo.actualizarDatos('Si funciona :).');
    };
</script>