<template></template>
<script setup>
    import { ref, watch, onMounted, computed } from "vue";
    import { useArticuloContenedor } from '../../articulo/articuloContenedor';

    const verArticuloContenedor = useArticuloContenedor();
</script>