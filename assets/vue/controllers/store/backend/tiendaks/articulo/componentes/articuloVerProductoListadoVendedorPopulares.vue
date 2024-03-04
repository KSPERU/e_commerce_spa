<template>
        <div id="carouselProductosVendedor" class="carousel slide">
        <div class="carousel-inner d-flex">
            <div class="carousel-item active">
                <div class="row row-cols-lg-4 row-cols-md-2 row-cols-sm-2 g-4">
                    <div v-for="producto in productos_vendedor.slice(0, 4)" :key="producto.id" class="col d-lg-block d-md-block d-sm-block">
                        <generalVerProductoTarjeta :producto="producto"/>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="row row-cols-1 row-cols-md-4 g-4">
                    <div v-for="producto in productos_vendedor.slice(4, 8)" :key="producto.id" class="col">
                        <generalVerProductoTarjeta :producto="producto"/>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselProductosVendedor" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselProductosVendedor" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</template>
<script setup>
    import { watch, computed } from "vue";
    import { useArticuloContenedor } from '../../articulo/articuloContenedor';
    import generalVerProductoTarjeta from '../../general/componentes/generalVerProductoTarjeta';

    const verArticuloContenedor = useArticuloContenedor();

    const productos_vendedor = computed(() => {
        return verArticuloContenedor.PRODUCTOSVENDEDOR
    });

    const producto = computed(() => {
        return verArticuloContenedor.PRODUCTO[0]
    });

    watch(producto, (nuevoValor) => {
        if (nuevoValor) {
            verArticuloContenedor.getVerProductoListadoVendedorPopulares({
                "paramsProdList": {
                    "usuario_id": nuevoValor?.pr_usuario.usu_id
                },
                "optionsOrdenProdList": {
                    "stock": "si",
                    "descuento": {
                        "direccion": "ascendente"
                    },
                    "valoracion": {
                        "direccion": "descendente"
                    }
                }
            });
        }
    });
</script>