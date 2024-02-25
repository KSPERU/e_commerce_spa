<template>
    <div>
        <carrito v-if="detallesCarrito.length > 0"/>
        <carrito_vacio v-else v-show="mostrarCarritoVacio" />
    </div>
    
    </template>
    
    <script setup>
        import carrito from './carrito';
        import carrito_vacio from './carrito_vacio';
        import { carritoStore  } from "../components/carritoContenedor" 
        import { onMounted, computed, ref } from "vue";
    
        const carritostore = carritoStore();
        const detallesCarrito = computed(() => {
            return carritostore.DETALLESCARRITOS
        })
        const mostrarCarritoVacio = ref(false);
  
        onMounted(() => {
            carritostore.visualizarCarrito();
            setTimeout(() => {
            mostrarCarritoVacio.value = true;
            }, 100); 
        });
        
    </script>