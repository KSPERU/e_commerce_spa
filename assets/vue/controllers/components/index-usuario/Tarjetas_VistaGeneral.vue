<template lang="">
  <div class="container mt-4">
    <div class="d-flex justify-content-start align-items-baseline mb-4">
      <span class="fs-4 fw-semibold me-2">Productos</span>
      <span><a href="#" class="fs-6 fw-semibold">Ver mas </a></span>
    </div>

    <div id="carouselProductos" class="carousel slide">
      <div class="carousel-inner d-flex">
        <div class="carousel-item active">
          <div class="row row-cols-lg-4 row-cols-md-2 row-cols-sm-2 g-4">
            <div class="col d-lg-block d-md-block d-sm-block">
              <Cards />
            </div>

            <div class="col d-lg-block d-md-block d-sm-block">
              <Cards />
            </div>

            <div class="col d-lg-block d-md-block d-sm-block">
              <Cards />
            </div>

            <div class="col d-lg-block d-md-block d-sm-block">
              <Cards />
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <div class="row row-cols-1 row-cols-md-4 g-4">
            <div class="col">
              <Cards />
            </div>
          </div>
        </div>
      </div>
      <button
        class="carousel-control-prev"
        type="button"
        data-bs-target="#carouselProductos"
        data-bs-slide="prev"
      >
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button
        class="carousel-control-next"
        type="button"
        data-bs-target="#carouselProductos"
        data-bs-slide="next"
      >
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
</template>

<script>
import Cards from "../Cards.vue";
export default {
  name: "Auth",
  components: {
    Cards,
  },
};
</script>
<style >

</style>
