<template>
    <div class="productos-venta-head d-flex justify-content-between">
        <div class="d-flex align-items-start align-items-md-center flex-column flex-md-row">
            <h1 class="size-22 fw-bolder m-0">Laptops</h1>
            <span class="ms-0 ms-md-3 text-secondary size-14">16 resultados</span>
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
</template>

<script>
    export default {};
</script>