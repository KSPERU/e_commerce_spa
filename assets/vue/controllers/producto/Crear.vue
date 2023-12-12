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
</template>

<script setup>
import { ref, defineEmits } from 'vue';
import axios from 'axios';

const emit = defineEmits(['producto-creado']);


const nombre = ref('');
const categoria = ref('');
const cantidad = ref(0);
const precio = ref(0);

const mostrarFormulario = ref(false);

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
    axios.post('/prueba-list/create', data)
        .then(response => {
            console.log(response.data);
            emit('producto-creado', response.data);
            cancelarFormulario();
        })
        .catch(error => {
            console.error(error);
        });
};

</script>
