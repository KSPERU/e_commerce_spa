<template lang="">
  <div class="row align-items-start bg-white justify-content-center">
    <div
      class="col-2 d-grid justify-content-center align-content-center p-5 categorias-populares"
    >
      <div class="col-12">
        <font-awesome-icon
          id="my-icon-popular"
          icon="tv"
          class="mx-auto d-block"
        />
      </div>
      <div class="col-12">
        <p class="text-categoria-populares fw-normal text-center mt-3">
          Televisores
        </p>
      </div>
    </div>

    <div
      class="col-2 d-grid justify-content-center align-content-center p-5 categorias-populares"
    >
      <div class="col-12">
        <font-awesome-icon
          id="my-icon-popular"
          icon="mobile-screen"
          class="mx-auto d-block"
        />
      </div>
      <div class="col-12">
        <p class="text-categoria-populares fw-normal text-center mt-3">
          Celulares
        </p>
      </div>
    </div>

    <div
      class="col-2 d-grid justify-content-center align-content-center p-5 categorias-populares"
    >
      <div class="col-12">
        <font-awesome-icon
          id="my-icon-popular"
          icon="headphones"
          class="mx-auto d-block"
        />
      </div>
      <div class="col-12">
        <p class="text-categoria-populares fw-normal text-center mt-3">
          Audífonos
        </p>
      </div>
    </div>

    <div
      class="col-2 d-grid justify-content-center align-content-center p-5 categorias-populares"
    >
      <div class="col-12">
        <font-awesome-icon
          id="my-icon-popular"
          icon="keyboard"
          class="mx-auto d-block"
        />
      </div>
      <div class="col-12">
        <p class="text-categoria-populares fw-normal text-center mt-3">
          Teclados
        </p>
      </div>
    </div>

    <div
      class="col-2 d-grid justify-content-center align-content-center p-5 categorias-populares"
    >
      <div class="col-12">
        <font-awesome-icon
          id="my-icon-popular"
          icon="tablet-alt"
          class="mx-auto d-block"
        />
      </div>
      <div class="col-12">
        <p class="text-categoria-populares fw-normal text-center mt-3">
          Tablet
        </p>
      </div>
    </div>

    <div
      class="col-2 d-grid justify-content-center align-content-center p-5 categorias-populares"
    >
      <div class="col-12">
        <font-awesome-icon
          id="my-icon-popular"
          icon="laptop"
          class="mx-auto d-block"
        />
      </div>
      <div class="col-12">
        <p class="text-categoria-populares fw-normal text-center mt-3">
          Laptop
        </p>
      </div>
    </div>

    <!-- SEGUNDA FILA --> 
 
    <div
      class="col-2 d-grid justify-content-center align-content-center p-5 categorias-populares"
    >
      <div class="col-12">
        <font-awesome-icon
          id="my-icon-popular"
          icon="tv"
          class="mx-auto d-block"
        />
      </div>
      <div class="col-12">
        <p class="text-categoria-populares fw-normal text-center mt-3">
          Televisores
        </p>
      </div>
    </div>

    <div
      class="col-2 d-grid justify-content-center align-content-center p-5 categorias-populares"
    >
      <div class="col-12">
        <font-awesome-icon
          id="my-icon-popular"
          icon="mobile-screen"
          class="mx-auto d-block"
        />
      </div>
      <div class="col-12">
        <p class="text-categoria-populares fw-normal text-center mt-3">
          Celulares
        </p>
      </div>
    </div>

    <div
      class="col-2 d-grid justify-content-center align-content-center p-5 categorias-populares"
    >
      <div class="col-12">
        <font-awesome-icon
          id="my-icon-popular"
          icon="headphones"
          class="mx-auto d-block"
        />
      </div>
      <div class="col-12">
        <p class="text-categoria-populares fw-normal text-center mt-3">
          Audífonos
        </p>
      </div>
    </div>

    <div
      class="col-2 d-grid justify-content-center align-content-center p-5 categorias-populares"
    >
      <div class="col-12">
        <font-awesome-icon
          id="my-icon-popular"
          icon="keyboard"
          class="mx-auto d-block"
        />
      </div>
      <div class="col-12">
        <p class="text-categoria-populares fw-normal text-center mt-3">
          Teclados
        </p>
      </div>
    </div>

    <div
      class="col-2 d-grid justify-content-center align-content-center p-5 categorias-populares"
    >
      <div class="col-12">
        <font-awesome-icon
          id="my-icon-popular"
          icon="tablet-alt"
          class="mx-auto d-block"
        />
      </div>
      <div class="col-12">
        <p class="text-categoria-populares fw-normal text-center mt-3">
          Tablet
        </p>
      </div>
    </div>

    <div
      class="col-2 d-grid justify-content-center align-content-center p-5 categorias-populares"
    >
      <div class="col-12">
        <font-awesome-icon
          id="my-icon-popular"
          icon="laptop"
          class="mx-auto d-block"
        />
      </div>
      <div class="col-12">
        <p class="text-categoria-populares fw-normal text-center mt-3">
          Laptop
        </p>
      </div>
    </div>
  </div>
</template>
<script>
export default {};
</script>
<style scoped>
#my-icon-popular {
  color: #3483fa;
  height: 45px;
}

.categorias-populares:hover {
  background-color: rgb(6, 64, 175);
  z-index: 1;
  transition: background-color 300ms ease-out;
}

.categorias-populares:hover p {
  color: #fff;
}

.categorias-populares:hover #my-icon-popular {
  color: #fff;
}
</style>
