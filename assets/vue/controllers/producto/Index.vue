<template>
    <CrearComponent @producto-creado="actualizarListado"/>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Categoria</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Precio</th>
                <th scope="col">Botones</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="dato in datos">
                <th>{{ dato.id }}</th>
                <td>{{ dato.nombre }}</td>
                <td>{{ dato.categoria }}</td>
                <td>{{ dato.cantidad }}</td>
                <td>{{ dato.precio }}</td>
                <td>
                    <button @click="editarProducto(dato)">Editar</button>
                    <button @click="confirmarEliminacion(dato)">Eliminar</button>
                </td>
            </tr>
        </tbody>
    </table>

    <EditarComponent :mostrarFormularioEdicion="mostrarFormularioEdicion" :datos="datos" :producto="productoEnEdicion" />

</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';
import CrearComponent from "./Crear.vue";
import EditarComponent from "./Editar.vue";

const mostrarFormularioEdicion = ref(false);
const productoEnEdicion = ref(null);
// const nombreEdicion = ref('');
// const categoriaEdicion = ref('');
// const cantidadEdicion = ref(0);
// const precioEdicion = ref(0);

const url = '/prueba-list';

const datos = ref([]);

// axios.get(url)
//     .then(response => {
//         console.log(response.data);
//         datos.value = response.data;
//     });

const actualizarListado = () => {
  // Actualizar el listado después de crear un nuevo producto
  axios.get('/prueba-list')
    .then(response => {
      datos.value = response.data;
    });
};
actualizarListado();

// Función para editar un producto
const editarProducto = (producto) => {
    productoEnEdicion.value = { ...producto };
    mostrarFormularioEdicion.value = true;

   

    // productoEnEdicion.value = producto;
    console.log('prueba: ', producto)
// console.log('prueba: ', nombreEdicion.value)
    // // Llenar los campos del formulario con los datos del producto seleccionado
    // nombreEdicion.value = producto.nombre;
    // categoriaEdicion.value = producto.categoria;
    // cantidadEdicion.value = producto.cantidad;
    // precioEdicion.value = producto.precio;
};

</script>
