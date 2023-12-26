<template>
    <form v-if="mostrarFormularioEdicion" @submit.prevent="guardarEdicion">
        <input ref="edNombre" v-model="producto.nombre" placeholder="Nombre" required />
        <input ref="edCategoria" v-model="producto.categoria" placeholder="Categoría" required />
        <input ref="edCantidad" v-model="producto.cantidad" type="number" placeholder="Cantidad" required />
        <input ref="edPrecio" v-model="producto.precio" type="number" placeholder="Precio" required />

        <button type="submit">Guardar Edición</button>
        <button @click="cancelarEdicion">Cancelar</button>
    </form>
</template>
  
<script setup>
import { ref, defineProps, defineEmits } from 'vue';

const { producto, mostrarFormularioEdicion } = defineProps(['producto', 'mostrarFormularioEdicion']);
const { emit } = defineEmits(['list-prod', 'id-prod']);
const id = ref(0);
const edNombre = ref('');
const edCategoria = ref(''); 
const edCantidad = ref(0);
const edPrecio = ref(0);

// const productoEnEdicion = ref([]);
const guardarEdicion = () => {

    // const prod = {
    //     nombre: edNombre.value.value, 
    //     categoria: edCategoria.value.value,
    //     cantidad: edCantidad.value.value,
    //     precio: edPrecio.value.value,
    // }
    // const prod = 
    // const prod = productoEnEdicion.value;
    // const producto = emit('list-prod');
    // // Actualizar los datos del producto con los nuevos valores del formulario
    // producto.nombre = producto.nombre;
    // producto.categoria = producto.categoria;
    // producto.cantidad = producto.cantidad;
    // producto.precio = producto.precio;

    // const productoEditado = { ...listProd.value };

    // Realizar la solicitud PUT al endpoint de Symfony para actualizar el producto
    console.log('Datos a enviar:', producto);
    // axios.put(`/prueba-list/edit/${producto.id}`, prod)
    //     .then(response => {
    //         // Aquí puedes manejar la respuesta si es necesario
    //         console.log(response.data);

    //         // Después de guardar, puedes recargar la lista de datos
    //         // axios.get('/prueba-list')
    //         //     .then(response => {
    //         //         datos.value = response.data;
    //         //         // Cerrar el formulario después de guardar
    //         //         cancelarEdicion();
    //         //     });
    //     })
    //     .catch(error => {
    //         // Aquí puedes manejar errores si es necesario
    //         console.error(error);
    //     });
};

</script>
  