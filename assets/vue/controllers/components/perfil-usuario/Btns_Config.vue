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
    </div>
</template>

<script>
export default {};
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