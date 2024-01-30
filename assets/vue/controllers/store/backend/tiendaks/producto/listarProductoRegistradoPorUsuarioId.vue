<template>
    <div class="alert alert-primary" role="alert">
        Categorias: /api/producto/listar/producto/concriterios
    </div>

    <table class="table mt-3">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripción</th>
                <th scope="col">Categoria</th>
                <th scope="col">Precio</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="dato in productos">
                <th scope="row">{{ dato.id }}</th>
                <td>{{ dato.pr_nombre }}</td>
                <td>{{ dato.pr_descripcion }}</td>
                <td>{{ dato.pr_categoria }}</td>
                <td>{{ dato.pr_precio }}</td>
            </tr>
        </tbody>
    </table>
</template>
  
<script setup>
    import { onMounted, computed } from "vue";
    import { useProductoContenedor } from '../producto/productoContenedor';

    const productoContenedor = useProductoContenedor();

    const productos = computed(() => {
        return productoContenedor.PRODUCTOS
    })
    
    onMounted(() => {
        productoContenedor.getListarProductoConCriterios({
            "paramsProdList": {
                "usuario_id": 1,
            }
        })
    })
</script>