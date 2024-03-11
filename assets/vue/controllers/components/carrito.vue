<template>
    <section class="mt-5">
        <div class="container">
            <div class="row">
            <!-- CARRITO -->  
            <div class="col-md-8" style="font-size: 16px">
                <h4 class="card-title mb-4" style="font-size: 16px; font-weight: 600; padding-top:10px">TU CARRITO</h4>
                <div class="card border shadow-0">
                <div v-for="producto in detallesCarrito" class="m-4">
                    <div class="row gy-3 mb-4 flex flex-md-row align-items-center text-center">
                    <div class="col-md-7">
                        <div class="me-md-3">
                            <div class="d-flex flex-md-row flex-column align-items-center">
                                <img :src="producto.prImagenes[0]" class="border rounded me-3" style="width: 96px; height: 96px; margin-right: 10px;" />
                                <div class="d-flex flex-md-row flex-column align-items-center">
                                    <div class="flex-grow-1 text-md-left w-100" style="color: #17172B;">
                                        <span class="mb-2">{{producto.prNombre}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="d-flex flex-md-row align-items-center justify-content-md-center">
                            <div class="me-md-3">
                                <input type="number" class="form-control me-2" style="width: 60px; color: #17172B;" :value="producto.dcCantidad" @input="($event) => onInputChange($event, producto.id, producto.prStock)"
                                @change="($event) => onInputChange($event, producto.id, producto.prstock)">
                            </div>
                            <div class="flex-md-row flex-column w-100 text-md-start" style="color: #17172B;">
                                <text class="h6">S/. {{producto.dcImporteFinal}}</text> <br />  
                                <small class="text-muted text-nowrap">S/. {{producto.prPrecio}}</small>
                            </div>  
                            <div class="ms-md-3">
                                <a @click="eliminarProducto(producto.id)" class="btn" style="color: #17172B;"><font-awesome-icon icon="trash" /></a>
                            </div>
                        </div>  
                    </div>
                    </div>
                
                    <hr />
                    
                </div>
                </div>
            </div>
            <!-- FIN CARRITO -->

            <!-- PRECIO -->
            <div class="col-md-4">
                <h4 class="card-title mb-4" style="font-size: 16px; font-weight: 600; padding-top:10px">RESUMEN</h4>
                <div class="card shadow-0 border">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                    <p class="mb-2">Subtotal:</p>
                    <p class="mb-2">S/. {{carritos.cImportetotal}}</p>
                    </div>
                    <div class="d-flex justify-content-between">
                    <p class="mb-2">Descuento total:</p>
                    <p class="mb-2">S/. {{ carritos.cDescuentos }}</p>
                    </div>
                    <hr />
                    <div class="d-flex justify-content-between">
                    <p class="mb-2">Total:</p>
                    <p class="mb-2 fw-bold">S/. {{carritos.cImportetotalFinal}}</p>
                    </div>
                </div>
                </div>

                <div class="mt-3">
                <a @click="realizarCompra" class="btn w-100 shadow-0 mb-2" style="background-color: #17172B; color: white;">Realizar compra</a>
                </div>

            </div>
            <!-- FIN PRECIO  -->
            </div>
        </div>
    </section>
</template>
<script setup>
    import { onMounted, computed, ref } from "vue";
    import { carritoStore  } from "../components/carritoContenedor"
    import axios from 'axios';
    
    const carrito = carritoStore();
    const carritoAdvertencia = ref('');
    const eliminarProducto = async (id_eliminar) => {
        await carrito.eliminarProducto({
            id_detalle_carrito: id_eliminar,
        })
    };
    const modificarProducto = async (id_modificar, prStock, cantidad) => {
        const mensaje = await carrito.modificarProducto({
            id_detalle_carrito: id_modificar,
            cantidad: cantidad,
        })
        
        if (mensaje) {
            carritoAdvertencia.value = `${mensaje.error} Stock actual: ${prStock}`;
        } else {
            if(!cantidad.value[id_modificar]){
            carritoAdvertencia.value = `El campo no debe estar vacío`;
        }else{
            carritoAdvertencia.value = "";
        }
        }
    };

    const onInputChange = async(event, id, prStock) => {
        const cantidad = parseInt(event.target.value);
        await modificarProducto(id, prStock, cantidad);
    
    };
    const fd = new FormData();

    const realizarCompra = async () => {
        try {
        const response = await axios.post('/tiendaks/carrito',fd);
        console.log(response.data);

        // Extraer la URL de la respuesta
        const url = response.data.url;

        // Redirigir a la nueva URL
        window.location.href = url;
        } catch (error) {
        // Manejar errores aquí
        console.error('Error al realizar la compra', error);
        }
    };
    const detallesCarrito = computed(() => {
        return carrito.DETALLESCARRITOS
    })

    const carritos = computed(() => {
        return carrito.CARRITOS
    })

    onMounted(() => {
        carrito.visualizarCarrito();
    })

</script>