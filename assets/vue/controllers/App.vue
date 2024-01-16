<template>
<<<<<<< HEAD
    <div class="container mt-3">
      <p class="text-secondary">¿Funciona?: {{ datosEnPadre }}</p>
    </div>
    <listados />
    
    <p class="fs-2 fw-bold text-uppercase">APIS en VUE</p>
    <listarProductos />
    <listarProductosPaginados />
    <listarProductosCategorizados />
    <listarProductosPrecios />
    <listarProductosOrdenado />
    <verProducto />
    <buscarProducto />
    <clasificacionProducto />
    <listadoPorUsuario />
</template>
  
<script setup>
    import { onMounted, computed } from "vue"; 
    import { useProductoModulo } from '../controllers/store/backend/tiendaks/producto/productoModulo';
    import listados from './store/backend/tiendaks/producto/listados';
    import listarProductos from './store/backend/tiendaks/producto/listarProductos';
    import listarProductosPaginados from './store/backend/tiendaks/producto/listarProductosPaginados';
    import listarProductosCategorizados from './store/backend/tiendaks/producto/listarProductosCategorizados';
    import listarProductosPrecios from './store/backend/tiendaks/producto/listarProductosPrecios';
    import listarProductosOrdenado from './store/backend/tiendaks/producto/listarProductosOrdenado';
    import verProducto from './store/backend/tiendaks/producto/verProducto';
    import buscarProducto from './store/backend/tiendaks/producto/buscarProducto';
    import clasificacionProducto from './store/backend/tiendaks/producto/clasificacionProducto';
    import listadoPorUsuario from './store/backend/tiendaks/producto/listadoPorUsuario';
=======
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
>>>>>>> bke_carrito_compra_it1

    const productoModulo = useProductoModulo();
    //const datosEnPadre = productoModulo.DATOS;

    const datosEnPadre = computed(() => {
        return productoModulo.DATOS
    })
    onMounted(() => {
        productoModulo.actualizarDatos()
    }) 
</script>