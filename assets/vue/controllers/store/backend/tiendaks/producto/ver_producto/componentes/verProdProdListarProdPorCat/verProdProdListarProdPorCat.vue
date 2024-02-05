<template>
    <div class="container">
        <h2 class="mb-4">Otros productos asociados</h2>
        <div class="row">
            <div v-for="producto in listar_producto_por_categoria" :key="producto.id" class="col-md-3 mb-4">
                <div class="card h-100">
                    <img :src="producto.pr_imagenes[0]" class="card-img-top img-fluid" alt="Product Image" style="max-height: 125px;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ producto.pr_nombre }}</h5>
                        <p class="card-text">{{ producto.pr_descripcion }}</p>
                        <p class="card-text">Precio: S/. {{ producto.pr_precio.toFixed(2) }}</p>
                        <p v-if="producto.pr_descuento > 0" class="card-text">Ahorras: S/. {{ (producto.pr_precio * producto.pr_descuento).toFixed(2) }}</p>
                        <p v-if="producto.pr_descuento > 0" class="card-text">Precio Final: S/. {{ producto.pr_preciofinal.toFixed(2) }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
    import { onMounted, computed } from "vue";
    import { useVerProductoContenedor } from '../../../ver_producto/verProductoContenedor';
    import { ref, watch } from 'vue';

    const verProductoContenedor = useVerProductoContenedor();

    const listar_producto_por_categoria = computed(() => {
        return verProductoContenedor.LISTARPRODUCTOPORCATEGORIA
    })

    const mostrar_producto_por_id = computed(() => {
        return verProductoContenedor.MOSTRARPRODUCTOPORID[0]
    });
    
    onMounted(() => { })

    watch(mostrar_producto_por_id, (nuevoValor) => {
        if (nuevoValor) {
            verProductoContenedor.getListarProductosPorCategoria({
                "optionsOrdenProdList": {
                    "categorias": [nuevoValor?.pr_categoria],
                    "stock": "si",
                    "pagina": 1,
                    "cantidad_productos": 4
                }
            });
        }
    });
    </script>