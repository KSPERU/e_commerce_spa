<template>
    <div class="alert alert-primary" role="alert">
        Categorias: /api/producto/listado/{categoria}/stock 
    </div>
    <table class="table">
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
            <tr v-for="dato in listarProductosCategorizadosStock">
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
    import { useProductoModulo } from '../en_desuso/productoModulo';

    const productoModulo = useProductoModulo();
  
    const listarProductosCategorizadosStock = computed(() => {
        return productoModulo.LISTARPRODUCTOSCATEGORIZADOSSTOCK
    })
    onMounted(() => {
        productoModulo.getListarProductosCategorizadosStock('skincare')
    })
</script>