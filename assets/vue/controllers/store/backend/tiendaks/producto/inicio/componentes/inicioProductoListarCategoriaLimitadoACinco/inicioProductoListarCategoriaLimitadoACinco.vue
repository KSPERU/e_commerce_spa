<template>
    <div class="container">
        <h2 class="mb-4">Consiguelo aqui</h2>
        <div class="row no-gutters">
            <div v-for="(categoria, index) in categorias_limitado_a_cinco" :key="index" :style="{ 'width': index < 2 ? '50%' : '25%' }" class="mb-0 p-0">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">{{ categoria.ct_nombre }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { onMounted, computed } from "vue";
    import { useInicioContenedor } from '../../../inicio/inicioContenedor';

    const inicioContenedor = useInicioContenedor();

    const categorias_limitado_a_cinco = computed(() => {
        return inicioContenedor.CATEGORIASLIMITADOACINCO
    })
    
    onMounted(() => {
        inicioContenedor.getListarProductoListarCategoriaLimitadoACinco(
            {
                "optionsOrdenCatList": {
                    "posicion_inicial": 1,
                    "cantidad_categorias": 5
                }
            }
        )
    })
</script>