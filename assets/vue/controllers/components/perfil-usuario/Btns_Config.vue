<template>
    <div>
        <div>
            <button class="btn-agregar-producto w-100 border-0 rounded-1 my-2 py-2 text-start px-4 px-md-3 px-lg-4 size-16-12 d-flex align-items-center justify-content-between" type="button" data-bs-toggle="modal" data-bs-target="#add-product">
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
    <div class="modal fade" id="add-product" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo producto</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="p-0">
            <div class="bg-azul-oscuro h-82px d-flex justify-content-center align-items-center">
                <h5 class="m-0 text-white">¡Hola!, ¿qué producto deseas vender?</h5>
            </div>
        </div>
        <div class="modal-body">

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary">Save changes</button>
        </div>
        </div>
    </div>
    </div>
</template>

<script>
export default {
    methods:{

    }
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