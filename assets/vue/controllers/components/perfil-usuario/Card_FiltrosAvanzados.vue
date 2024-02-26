<template>
    <div class="card card-filtros-avanzados mt-3" id="card-filtros" style="display: none;">
        <div class="card-header">
            <p class="size-16 fw-semibold m-0">Filtros Avanzados</p>
        </div>
        <div class="card-body py-1">
            <div class="my-3">
                <h5 class="size-16 my-2">Categoria</h5>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="categoria1">
                    <label class="form-check-label" for="categoria1">
                        Electrodomésticos
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="categoria2">
                    <label class="form-check-label" for="categoria2">
                        Jardinería
                    </label>
                </div>
            </div>
            <div class="my-3">
                <h5 class="size-16 my-2">Marca</h5>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="marca1">
                    <label class="form-check-label" for="marca1">
                        PHILLIPS
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="marca2">
                    <label class="form-check-label" for="marca2">
                        TOSHIBA
                    </label>
                </div>
            </div>
            <div class="my-3">
                <h5 class="size-16 my-2">Precio</h5>
                <div class="form-check" @click="filtrarPorPrecio(0, 50)">
                    <input class="form-check-input" type="checkbox" value="" id="precio1">
                    <label class="form-check-label" for="precio1">
                        S/. 0.00 - S/. 50.00
                    </label>
                </div>
                <div class="form-check" @click="filtrarPorPrecio(50, 100)">
                    <input class="form-check-input" type="checkbox" value="" id="precio2">
                    <label class="form-check-label" for="precio2">
                        S/. 50.00 - S/. 100.00
                    </label>
                </div>
                <div class="form-check" @click="filtrarPorPrecio(100, 500)">
                    <input class="form-check-input" type="checkbox" value="" id="precio3">
                    <label class="form-check-label" for="precio3">
                        S/. 100.00 - S/. 500.00
                    </label>
                </div>
                <div class="form-check" @click="filtrarPorPrecio(500, null)">
                    <input class="form-check-input" type="checkbox" value="" id="precio4">
                    <label class="form-check-label" for="precio4">
                        S/. 500.00 a más
                    </label>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <button @click="filtrar(busqueda, direccion, precio_inicio, precio_fin)" class="btn btn-primary w-100 mt-2 mt-md-0">Filtrar</button>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</template>

<script setup>
    import { ref } from "vue";

    const busqueda = ref(null);
    const direccion = ref(null);
    const precio_inicio = ref(null);
    const precio_fin = ref(null);

    const emit = defineEmits();

    const filtrarPorPrecio = (inicio, fin) => {
        precio_inicio.value = inicio;
        precio_fin.value = fin;
        console.log("inicio", inicio)
        console.log("fin", fin)
    };

    const filtrar = () => {
        emit('filtrar', {
            busqueda: busqueda.value,
            direccion: direccion.value,
            precio_inicio: precio_inicio.value,
            precio_fin: precio_fin.value
        });
        console.log('Emisor ');
        console.log('busqueda ', busqueda.value);
        console.log('direccion ', direccion.value);
        console.log('precio_inicio ', precio_inicio.value);
        console.log('precio_fin ', precio_fin.value)
    };
</script>

<style>
@media (min-width: 991.99px) {

    #card-filtros{
        display: block !important;
    }
}
</style>