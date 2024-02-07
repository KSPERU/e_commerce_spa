<template>
    <div class="container">
        <h2 class="mb-4">Categorías populares</h2>
        <div class="d-flex flex-wrap">
            <div v-for="(categoria, index) in categorias_mas_valoradas" :key="index" class="col-md-4 mb-0 mr-2">
                <div class="card text-center m-0 p-0">
                    <div class="card-body">
                        <h5 class="card-title">{{ categoria.ct_nombre }}</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div>
        <mostrarVistaCarrito />
    </div>
</template>

<script setup>
    import { onMounted, computed } from "vue";
    import { useInicioContenedor } from '../../../inicio/inicioContenedor';
    import mostrarVistaCarrito from '../../../../carrito/mostrarVistaCarrito';
    const inicioContenedor = useInicioContenedor();

    const categorias_mas_valoradas = computed(() => {
        return inicioContenedor.CATEGORIASMASVALORADAS
    })
    
    onMounted(() => {
        inicioContenedor.getListarProductoListarCategoriaMasValorada(
            {
                "optionsOrdenCatList": {
                    "posicion_inicial": 1,
                    "cantidad_categorias": 14,
                    "valoracion": {
                        "direccion": "descendente"
                    }
                }
            }
        )
    })
</script>