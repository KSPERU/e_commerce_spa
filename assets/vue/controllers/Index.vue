<template>
    <button @click="abrirFormularioCreacion">Agregar Producto</button>

    <form v-if="mostrarFormulario" @submit.prevent="guardarProducto">
        <input v-model="nombre" placeholder="Nombre" required />
        <input v-model="categoria" placeholder="Categoría" required />
        <input v-model="cantidad" type="number" placeholder="Cantidad" required />
        <input v-model="precio" type="number" placeholder="Precio" required />
        <button type="submit">Guardar</button>
        <button @click="cancelarFormulario">Cancelar</button>
    </form>

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

    <form v-if="mostrarFormularioEdicion" @submit.prevent="guardarEdicion">
        <input v-model="nombreEdicion" placeholder="Nombre" required />
        <input v-model="categoriaEdicion" placeholder="Categoría" required />
        <input v-model="cantidadEdicion" type="number" placeholder="Cantidad" required />
        <input v-model="precioEdicion" type="number" placeholder="Precio" required />

        <button type="submit">Guardar Edición</button>
        <button @click="cancelarEdicion">Cancelar</button>
    </form>

    <div v-if="mostrarConfirmacion">
        <p>¿Estás seguro de que deseas eliminar este producto?</p>
        <button @click="eliminarProducto">Sí, eliminar</button>
        <button @click="cancelarEliminacion">Cancelar</button>
    </div>

    <ul>
        <li v-for="dato in datos">
            {{ dato }}
        </li>
    </ul>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';
const url = '/prueba-list';

const datos = ref([]);

const nombre = ref('');
const categoria = ref('');
const cantidad = ref(0);
const precio = ref(0);

const mostrarFormulario = ref(false);

// Variables adicionales para la edición
const mostrarFormularioEdicion = ref(false);
const productoEnEdicion = ref(null);
const nombreEdicion = ref('');
const categoriaEdicion = ref('');
const cantidadEdicion = ref(0);
const precioEdicion = ref(0);

// Variables adicionales para la eliminación
const mostrarConfirmacion = ref(false);
const productoAEliminar = ref(null);

axios.get(url)
    .then(response => {
        console.log(response.data);
        datos.value = response.data;
    });

const abrirFormularioCreacion = () => {
    mostrarFormulario.value = true;
};

const cancelarFormulario = () => {
    mostrarFormulario.value = false;
    // Limpiar datos del formulario si es necesario
    nombre.value = '';
    categoria.value = '';
    cantidad.value = 0;
    precio.value = 0;
};

const guardarProducto = () => {
    const data = {
        nombre: nombre.value,
        categoria: categoria.value,
        cantidad: cantidad.value,
        precio: precio.value
    };
    console.log('Datos a enviar:', data);
    // Realizar la solicitud POST
    axios.post('/prueba-list/create', data)
        .then(response => {
            // Aquí puedes manejar la respuesta si es necesario
            console.log(response.data);

            // Después de guardar, puedes recargar la lista de datos
            axios.get(url)
                .then(response => {
                    datos.value = response.data;
                    // Cerrar el formulario después de guardar
                    cancelarFormulario();
                });
        })
        .catch(error => {
            // Aquí puedes manejar errores si es necesario
            console.error(error);
        });
};


// Función para editar un producto
const editarProducto = (producto) => {
    mostrarFormularioEdicion.value = true;
    productoEnEdicion.value = producto;

    // Llenar los campos del formulario con los datos del producto seleccionado
    nombreEdicion.value = producto.nombre;
    categoriaEdicion.value = producto.categoria;
    cantidadEdicion.value = producto.cantidad;
    precioEdicion.value = producto.precio;
};

// Función para guardar la edición
const guardarEdicion = () => {
    // Obtener el producto actualmente en edición
    const producto = productoEnEdicion.value;

    // Actualizar los datos del producto con los nuevos valores del formulario
    producto.nombre = nombreEdicion.value;
    producto.categoria = categoriaEdicion.value;
    producto.cantidad = cantidadEdicion.value;
    producto.precio = precioEdicion.value;

    // Realizar la solicitud PUT al endpoint de Symfony para actualizar el producto
    console.log('Datos a enviar:', producto);
    axios.put(`/prueba-list/edit/${producto.id}`, producto)
        .then(response => {
            // Aquí puedes manejar la respuesta si es necesario
            console.log(response.data);

            // Después de guardar, puedes recargar la lista de datos
            axios.get(url)
                .then(response => {
                    datos.value = response.data;
                    // Cerrar el formulario después de guardar
                    cancelarEdicion();
                });
        })
        .catch(error => {
            // Aquí puedes manejar errores si es necesario
            console.error(error);
        });
};

// Función para cancelar la edición
const cancelarEdicion = () => {
    mostrarFormularioEdicion.value = false;
    productoEnEdicion.value = null;

    // Limpiar datos del formulario de edición si es necesario
    nombreEdicion.value = '';
    categoriaEdicion.value = '';
    cantidadEdicion.value = 0;
    precioEdicion.value = 0;
};


// Función para confirmar la eliminación
const confirmarEliminacion = (producto) => {
  mostrarConfirmacion.value = true;
  productoAEliminar.value = producto;
};

// Función para realizar la eliminación
const eliminarProducto = () => {
  // Obtener el producto actualmente en eliminación
  const producto = productoAEliminar.value;

  // Realizar la solicitud DELETE al endpoint de Symfony para eliminar el producto
  axios.delete(`/prueba-list/delete/${producto.id}`)
    .then(response => {
      // Aquí puedes manejar la respuesta si es necesario
      console.log(response.data);

      // Después de eliminar, puedes recargar la lista de datos
      axios.get(url)
        .then(response => {
          datos.value = response.data;
          // Cerrar la confirmación después de eliminar
          cancelarEliminacion();
        });
    })
    .catch(error => {
      // Aquí puedes manejar errores si es necesario
      console.error(error);
    });
};

// Función para cancelar la eliminación
const cancelarEliminacion = () => {
  mostrarConfirmacion.value = false;
  productoAEliminar.value = null;
};

</script>
