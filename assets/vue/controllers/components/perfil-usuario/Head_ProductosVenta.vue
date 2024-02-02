<template>
    <div class="productos-venta-head d-flex justify-content-between">
        <div class="d-flex align-items-start align-items-md-center flex-column flex-md-row">
            <h1 class="size-22 fw-bolder m-0">Productos en venta</h1>
            <span class="ms-0 ms-md-3 text-secondary size-14">6 resultados</span>
        </div>
        <div class="d-flex align-items-center flex-column flex-md-row">
            <p class="m-0 text-secondary w-100 size-14 d-none d-md-block">Ordenar por:</p>
            <select class="form-select form-select-sm" aria-label=".form-select-sm example" style="min-width: 132px">
                <option selected>Más relevante</option>
                <option value="1">Menor precio</option>
                <option value="2">Mayor precio</option>
            </select>
        </div>
    </div>
    <button class="btn btn-light btn-sm d-block d-lg-none w-100 my-2" @click="toggleFiltros">
            <font-awesome-icon icon="filter" />
            Aplicar filtros avanzado
    </button>

    
</template>

<script>
import Card_FiltrosAvanzados from "./Card_FiltrosAvanzados.vue";

export default {
    components: {
        Card_FiltrosAvanzados,
    },

    methods: {
        toggleFiltros() {
            const cardFiltros = document.getElementById('card-filtros');
            if (cardFiltros.style.display === 'none') {
                cardFiltros.style.display = 'block';
            } else {
                cardFiltros.style.display = 'none';
            }
        }
    }
};
</script>