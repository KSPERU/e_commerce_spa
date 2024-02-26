<template>
    <div id="carouselProductos" class="carousel slide">
        <div class="carousel-inner d-flex">
            <div class="carousel-item active">
                <div class="row row-cols-lg-4 row-cols-md-2 row-cols-sm-2 g-4">
                    <div v-for="producto in productos.slice(0, 4)" :key="producto.id" class="col d-lg-block d-md-block d-sm-block">
                        <generalVerProductoTarjeta :producto="producto"/>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="row row-cols-1 row-cols-md-4 g-4">
                    <div v-for="producto in productos.slice(4, 8)" :key="producto.id" class="col">
                        <generalVerProductoTarjeta :producto="producto"/>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselProductos" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselProductos" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</template>
<style scoped>
    .carousel-control-prev,
    .carousel-control-next {
        width: 5%;
    }
</style>
<script setup>
    import { onMounted, computed } from 'vue';
    import { useInicioContenedor } from '../../inicio/inicioContenedor';
    import generalVerProductoTarjeta from '../../general/componentes/generalVerProductoTarjeta';

    const inicioContenedor = useInicioContenedor();

    const productos = computed(() => {
        return inicioContenedor.PRODUCTOS
    })

    onMounted(() => {
        inicioContenedor.getVerProductoListado(
            {
                "optionsOrdenProdList": {
                    "stock": "si"
                }
            }
        )
    })
</script>