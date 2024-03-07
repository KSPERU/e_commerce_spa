<template>
    <div>
        <div>
            <button class="btn-agregar-producto w-100 border-0 rounded-1 my-2 py-2 text-start px-4 px-md-3 px-lg-4 size-16-12 d-flex align-items-center justify-content-between">
            Agregar un producto
            <font-awesome-icon icon="angle-right"/>
            </button>
        </div>
        <div>
            <button class="btn-actualizar-productos w-100 border-0 rounded-1 my-2 py-2 text-start px-4 px-md-3 px-lg-4 size-16-12 d-flex align-items-center justify-content-between">
            Actualizar mis productos
            <font-awesome-icon icon="angle-right"/>
            </button>
        </div>
        <div>
            <form @submit.prevent="submitForm">
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <input type="text" class="form-control" id="nombre" v-model="producto.pr_nombre" required>
            </div>
            <div class="form-group">
                <label for="categoria">Categoría:</label>
                <input type="text" class="form-control" id="categoria" v-model="producto.pr_categoria" required>
            </div>
            <div class="form-group">
                <label for="stock">Stock:</label>
                <input type="number" class="form-control" id="stock" v-model="producto.pr_stock" required>
            </div>
            <div class="form-group">
                <label for="precio">Precio:</label>
                <input type="number" class="form-control" id="precio" v-model="producto.pr_precio" required>
            </div>
            <div class="form-group">
                <label for="descripcion">Descripción:</label>
                <textarea class="form-control" id="descripcion" v-model="producto.pr_descripcion"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Agregar Producto</button>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import axios from 'axios';

const currentURL = window.location.href
const segments = currentURL.split("/")
const idusuario = parseInt(segments[segments.length - 1])

const producto = ref({
    pr_nombre: '',
    pr_categoria: '',
    pr_stock: null,
    pr_precio: null,
    pr_descripcion: ''
});

const submitForm = () => {
    axios.post('/api/producto/api/productos', producto.value)
        .then(response => {
        console.log(response.data);
        
        })
        .catch(error => {
        console.error('Error al agregar producto:', error);
        });
};
</script>

<style scoped>
    .btn-agregar-producto, .btn-actualizar-productos{
        background-color: var(--color-azul-oscuro);
        color: #fff;
    }
    .btn-agregar-producto:hover, .btn-actualizar-productos:hover{
        background-color: #3483FA;
        color: #fff;
    }
</style>