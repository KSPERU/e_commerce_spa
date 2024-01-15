<template>
    <div>
        <h3>Mi carrito</h3>
        <tr v-for="dato in detallesCarrito">
            <td>{{ dato.id }}</td>
            <td>{{ dato.prNombre }}</td>
            <td>{{ dato.dcImporte }}</td>
            <td>{{ dato.dcCantidad }}</td>
            <td>
                <input v-model="dcCantidad"  type="number" placeholder="Cantidad" />
            </td>
            <button @click="modificarProducto(dato.id, dcCantidad)">Modificar Producto</button>
            <button @click="eliminarProducto(dato.id)">Eliminar Producto</button>
        </tr>
        <hr>
        <h3>Lista de productos en tienda</h3>
        <tr v-for="dato in productos">
            <td>{{ dato.id }}</td>
            <td>{{ dato.prNombre }}</td>
            <button @click="agregarProducto(dato.id, cantidad)">Agregar Producto</button>
            <td>
                <input v-model="cantidad" type="number" placeholder="Cantidad" />
            </td>
        </tr>
    </div>
</template>

<script setup>
    import { onMounted, computed } from "vue";
    import { carritoStore  } from "./prodStore" 

    
    const carrito = carritoStore();
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
    const modificarProducto = async (id_modificar, cantidad) => {
        await carrito.modificarProducto({
            id_detalle_carrito: id_modificar,
            cantidad: cantidad,
        })
    };
    const detallesCarrito = computed(() => {
        return carrito.DETALLESCARRITOS
    })

    const productos = computed(() => {
        return carrito.PRODUCTOS
    })
    onMounted(() => {
        carrito.visualizarCarrito();
        carrito.ListarProducto();
    })

</script>