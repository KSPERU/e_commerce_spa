<template>
    <div>
        <button @click="realizarCompra">Continuar compra</button>
        <h3>Mi carrito </h3>
        <div v-if="carritoAdvertencia" class="alert alert-primary">
            {{ carritoAdvertencia }}
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Importe</th>
                    <th scope="col">Stock</th>
                    <th scope="col">Cambiar Cantidad</th>
                    <th scope="col">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="dato in detallesCarrito">
                    <th scope="row">{{ dato.id }}</th>
                    <td>{{ dato.prNombre }}</td>
                    <td>{{ dato.dcCantidad }}</td>
                    <td>{{ dato.dcImporte }}</td>
                    <td>{{ dato.prStock }}</td>
                    <td>
                        <input v-model="cantidad[dato.id]"  type="number" placeholder="Cantidad" pattern="[0-9]+" />
                        <button @click="modificarProducto(dato.id, dato.prStock, dato.dcCantidad)">Guardar</button>
                    </td>
                    <td><button @click="eliminarProducto(dato.id)">X</button></td>
                </tr>
                <tr>
                    <td colspan="7">
                        Importe total: {{ carritos.cImportetotal }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup>
    import { onMounted, computed, ref } from "vue";
    import { carritoStore  } from "../carrito/carritoContenedor" 
    import axios from 'axios';
    
    const carrito = carritoStore();
    const carritoAdvertencia = ref('');
    const cantidad = ref({});
    const agregarProducto = async (id, cantidad) => {
        await carrito.agregarProducto({
            id_producto: id,
            cantidad: cantidad,
        })
    };
    const eliminarProducto = async (id_eliminar) => {
        await carrito.eliminarProducto({
            id_detalle_carrito: id_eliminar,
        })
    };
    const modificarProducto = async (id_modificar, prStock, cantidadaux) => {
        const mensaje = await carrito.modificarProducto({
            id_detalle_carrito: id_modificar,
            cantidad: cantidad.value[id_modificar] !== undefined && cantidad.value[id_modificar] !== "" ? cantidad.value[id_modificar] : cantidadaux,
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