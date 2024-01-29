<template>
    <div class="alert alert-primary" role="alert">
        Listado por usuario: /api/producto/listado/usuario/{usuario} 
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripción</th>
                <th scope="col">Categoria</th>
                <th scope="col">Precio</th>
                <th scope="col">Stock</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="dato in listadoPorUsuario">
                <th scope="row">{{ dato.id }}</th>
                <td>{{ dato.pr_nombre }}</td>
                <td>{{ dato.pr_descripcion }}</td>
                <td>{{ dato.pr_categoria }}</td>
                <td>{{ dato.pr_precio }}</td>
                <td> - </td>
            </tr>
        </tbody>
    </table>
</template>
  
<script setup>
    import { onMounted, computed } from "vue";
    import { useProductoModulo } from '../en_desuso/productoModulo';
    
    const productoModulo = useProductoModulo();
  
    const actualizarStock = async (idProducto, nuevoStock) => {
        console.log('No se modifico.');
    };

    const listadoPorUsuario = computed(() => {
        return productoModulo.LISTADOPORUSUARIO
    })
    onMounted(() => {
        productoModulo.getListadoPorUsuario(1)
    })
</script>