<template>
    <Head_ProductosCategoria class="mt-3 mt-lg-4"/>
    <div class="productos-venta-body overflow-hidden">
        <Cards_Productos_Categoria  />
    </div>
</template>

<script>
    import Head_ProductosCategoria from './Head_ProductosCategoria.vue';
    import Cards_Productos_Categoria from './Cards_Productos_Categoria.vue';
    export default {
        components:{
            Head_ProductosCategoria,
            Cards_Productos_Categoria
        }
    };
</script>