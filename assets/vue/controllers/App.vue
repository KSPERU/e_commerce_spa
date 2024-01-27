<template>
    <div>
        <h3>Mi carrito</h3>
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
                        <input v-model="cantidad"  type="number" placeholder="Cantidad" />
                        <button @click="modificarProducto(dato.id, cantidad, dato.prStock)">Guardar</button>
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

        <h3>Lista de productos en tienda</h3>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Categoria</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Agregar</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="dato in productos">
                    <th scope="row">{{ dato.id }}</th>
                    <td>{{ dato.pr_nombre }}</td>
                    <td>{{ dato.pr_descripcion }}</td>
                    <td>{{ dato.pr_categoria }}</td>
                    <td>{{ dato.pr_precio }}</td>
                    <td><button @click="agregarProducto(dato.id, 1)">Agregar al Carrito</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script setup>
    import { onMounted, computed, ref } from "vue";
    import { carritoStore  } from "./prodStore" 

    
    const carrito = carritoStore();
    const carritoAdvertencia = ref('');
    const cantidad = ref('');
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
    const modificarProducto = async (id_modificar, cantidad, prStock) => {
        const mensaje = await carrito.modificarProducto({
            id_detalle_carrito: id_modificar,
            cantidad: cantidad,
        })
        if (mensaje) {
            carritoAdvertencia.value = `${mensaje.error} Stock actual: ${prStock}`;
        } else {
            carritoAdvertencia.value = "";
        }
    };
    const detallesCarrito = computed(() => {
        return carrito.DETALLESCARRITOS
    })

    const productos = computed(() => {
        return carrito.PRODUCTOS
    })

    const carritos = computed(() => {
        return carrito.CARRITOS
    })

    onMounted(() => {
        carrito.visualizarCarrito();
        carrito.ListarProducto();
    })

    // const productoModulo = useProductoModulo();
    // //const datosEnPadre = productoModulo.DATOS;

    // const datosEnPadre = computed(() => {
    //     return productoModulo.DATOS
    // })
    // onMounted(() => {
    //     productoModulo.actualizarDatos()
    // }) 
</script>
