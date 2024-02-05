<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">TiendaKS</a>

            <div class="collapse navbar-collapse d-flex justify-content-between" id="navbarNav">
                <ul class="navbar-nav d-flex flex-fill">
                    <li class="nav-item flex-fill" v-for="categoria in categorias" :key="categoria">
                        <a class="nav-link text-center" href="#">{{ categoria.ct_nombre }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script setup>
    import { onMounted, computed } from "vue";
    import { useInicioContenedor } from '../../../inicio/inicioContenedor';

    const inicioContenedor = useInicioContenedor();

    const categorias = computed(() => {
        return inicioContenedor.CATEGORIAS
    })
    
    onMounted(() => {
        inicioContenedor.getListarProductoListarCategoria()
    })
</script>