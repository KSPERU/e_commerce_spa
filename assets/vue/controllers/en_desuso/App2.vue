<template>
    <div class="container mt-3">
      <p class="text-secondary">¿Funciona?: {{ datosEnPadre }}</p>
    </div>
    <listados />
    
    <p class="fs-2 fw-bold text-uppercase">APIS en VUE</p>
    <listarProductos />
    <listarProductosPaginados />
    <listarProductosCategorizados />
    <listarProductosPrecios />
    <listarProductosOrdenado />
    <verProducto />
    <buscarProducto />
    <clasificacionProducto />
    <listadoPorUsuario />
</template>
  
<script setup>
    import { onMounted, computed } from "vue"; 
    import { useProductoModulo } from '../store/backend/tiendaks/producto/en_desuso/productoModulo';
    import listados from '../store/backend/tiendaks/producto/en_desuso/listados';
    import listarProductos from '../store/backend/tiendaks/producto/en_desuso/listarProductos';
    import listarProductosPaginados from '../store/backend/tiendaks/producto/en_desuso/listarProductosPaginados';
    import listarProductosCategorizados from '../store/backend/tiendaks/producto/en_desuso/listarProductosCategorizados';
    import listarProductosPrecios from '../store/backend/tiendaks/producto/en_desuso/listarProductosPrecios';
    import listarProductosOrdenado from '../store/backend/tiendaks/producto/en_desuso/listarProductosOrdenado';
    import verProducto from '../store/backend/tiendaks/producto/en_desuso/verProducto';
    import buscarProducto from '../store/backend/tiendaks/producto/en_desuso/buscarProducto';
    import clasificacionProducto from '../store/backend/tiendaks/producto/en_desuso/clasificacionProducto';
    import listadoPorUsuario from '../store/backend/tiendaks/producto/en_desuso/listadoPorUsuario';
    const productoModulo = useProductoModulo();
    //const datosEnPadre = productoModulo.DATOS;

    const datosEnPadre = computed(() => {
        return productoModulo.DATOS
    })
    
    onMounted(() => {
        productoModulo.actualizarDatos()
    }) 
</script>