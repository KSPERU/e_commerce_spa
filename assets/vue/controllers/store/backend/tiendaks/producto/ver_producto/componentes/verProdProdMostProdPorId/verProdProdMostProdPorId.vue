<template>
    <div class="container mt-5">
        <div v-if="mostrar_producto_por_id.length > 0" class="card">
            <div class="row g-0">
            <div class="col-md-4">
                <img :src="mostrar_producto_por_id[0].pr_imagenes[0]" class="img-fluid img-thumbnail" alt="Product Image">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                    <div v-for="(producto, index) in mostrar_producto_por_id" :key="index" class="carousel-item" :class="{ 'active': index === 0 }">
                        <h5 class="card-title">{{ producto.pr_nombre }}</h5>
                        <p class="card-text">{{ producto.pr_descripcion }}</p>
                        <p class="card-text">Categoría: {{ producto.pr_categoria }}</p>
                        <p class="card-text">Precio: S/.{{ producto.pr_preciofinal }}</p>
                        <div class="valoracion">
                        <p class="card-text">
                            Valoración: {{ Math.round(producto.valoracion) }}/5 ({{ producto.cantidadvaloracion }} valoración(es))
                        </p>
                        <div class="barras-valoracion">
                            <div v-for="n in 5" :key="n" class="barra" :class="{ 'rellena': n <= Math.round(producto.valoracion) }"></div>
                        </div>
                        </div>
                        <input v-model="cantidad[producto.id]"  type="number" placeholder="Cantidad" pattern="[0-9]+" />
                    <td><button @click="agregarProducto(producto.id)">Agregar al Carrito</button></td>
                    </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Siguiente</span>
                    </button>
                   
                </div>
                </div>
            </div>
            </div>
        </div>
        <div v-else>
            <p>No hay productos disponibles.</p>
        </div>
    </div>
    <div class="mt-3">
        <verProdProdListarProdPorCat />
    </div>
    <div>
        <mostrarVistaCarrito />
    </div>
</template>
<style>
    .valoracion {
      margin-top: 10px;
    }
  
    .barras-valoracion {
      display: flex;
      margin-bottom: 10px;
    }
  
    .barra {
      width: 20px;
      height: 5px;
      background-color: gold;
      margin-right: 5px;
    }
  
    .barra.rellena {
      background-color: gold;
      width: 100%;
    }
</style>
<script setup>
    import verProdProdListarProdPorCat from '../verProdProdListarProdPorCat/verProdProdListarProdPorCat';
    import mostrarVistaCarrito from '../../../../carrito/mostrarVistaCarrito';
    import { onMounted, computed } from "vue";
    import { useVerProductoContenedor } from '../../../ver_producto/verProductoContenedor';
    import { ref } from 'vue';
    import { carritoStore  } from "../../../../carrito/carritoContenedor" 

    const producto_id = ref('');

    const verProductoContenedor = useVerProductoContenedor();
    const cantidad = ref({});
    const carrito = carritoStore();
    const agregarProducto = async (id) => {
        await carrito.agregarProducto({
            id_producto: id,
            cantidad: cantidad.value[id],
        })
    };
    const mostrar_producto_por_id = computed(() => {
        return verProductoContenedor.MOSTRARPRODUCTOPORID
    });
    
    onMounted(() => {
        producto_id.value = document.getElementById('ver_producto_producto_mostar_producto_por_id').getAttribute('data-producto-id');
        verProductoContenedor.getMostrarProductoPorId({
            "paramsProdList": {
                "id": producto_id.value,
            }
        });
    });
</script>