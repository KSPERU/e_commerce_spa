<template>
    <div class="container">
        <h2 class="mb-4">Productos</h2>
        <div class="row">
            <div v-for="producto in productos_limitado_a_cuatro" :key="producto.id" class="col-md-3 mb-4">
                <div class="card h-100">
                    <img :src="producto.pr_imagenes[0]" class="card-img-top img-fluid" alt="Product Image" style="max-height: 125px;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ producto.pr_nombre }}</h5>
                        <p class="card-text">{{ producto.pr_descripcion }}</p>
                        <p class="card-text">Precio: S/. {{ producto.pr_precio.toFixed(2) }}</p>
                        <p v-if="producto.pr_descuento > 0" class="card-text">Ahorras: S/. {{ (producto.pr_precio * producto.pr_descuento).toFixed(2) }}</p>
                        <p v-if="producto.pr_descuento > 0" class="card-text">Precio Final: S/. {{ producto.pr_preciofinal.toFixed(2) }}</p>
                    </div>
                    <button @click="agregarProducto(producto.id, 1)">Agregar al Carrito</button>
                </div>             
            </div>
        </div>
    </div>
</template>
<script setup>
    import { onMounted, computed } from "vue";
    import { useInicioContenedor } from '../../../inicio/inicioContenedor';

    import { carritoStore  } from "../../../../carrito/carritoContenedor" 
    
    const carrito = carritoStore();
    const agregarProducto = async (id, cantidad) => {
        await carrito.agregarProducto({
            id_producto: id,
            cantidad: cantidad,
        })
    };
    const inicioContenedor = useInicioContenedor();

    const productos_limitado_a_cuatro = computed(() => {
        return inicioContenedor.PRODUCTOSLIMITADOACUATRO
    })
    
    onMounted(() => {
        inicioContenedor.getListarProductoLimitadoACuatro(
            {
                "optionsOrdenProdList": {
                    "stock": "si",
                    "pagina": 1,
                    "cantidad_productos": 4
                }
            }
        )
    })
</script>
