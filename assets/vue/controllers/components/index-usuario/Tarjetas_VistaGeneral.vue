<template lang="">
  <div id="carouselProductos" class="carousel slide">
    <div class="carousel-inner d-flex">
      <div class="carousel-item active">
        <div class="row row-cols-lg-4 row-cols-md-2 row-cols-sm-2 g-4">
          <div v-for="product in products" :key="product.id" class="col d-lg-block d-md-block d-sm-block">
              <Cards :product="product" />
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <div class="row row-cols-lg-4 row-cols-md-2 row-cols-sm-2 g-4">
            <div v-for="product in products2" :key="product.id" class="col d-lg-block d-md-block d-sm-block">
              <Cards :product="product" />
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
</template>

<script>
import Cards from "../Cards.vue";
export default {
  components: {
    Cards,
  },
  data() {
        return {
            mostrarOferta: window.innerWidth < 426.8,
            products: [
                { id: 1, name: 'Shark IQ Robot Self-Empty XL Vacuum with Self-Empty Base, Home Mapping, RV1002AE, New Shark IQ Robot Self-Empty XL Vacuum with Self-Empty Base, Home Mapping, RV1002AE, New', price: 300.00, desc: 0.00, score: 3, votes: 20, send: 'Envío gratis', send_days: 3, img: '../img/tiendaks/producto/producto-prueba.png' },
                { id: 2, name: 'Shark IQ Robot Self-Empty XL Vacuum with Self-Empty Base, Home Mapping, RV1002AE, New Shark IQ Robot Self-Empty XL Vacuum with Self-Empty Base, Home Mapping, RV1002AE, New', price: 300.00, desc: 50.00, score: 3, votes: 20, send: 'Envío gratis', send_days: 3, img: '../img/tiendaks/producto/producto-prueba.png' },
                { id: 3, name: 'Shark IQ Robot Self-Empty XL Vacuum with Self-Empty Base, Home Mapping, RV1002AE, New Shark IQ Robot Self-Empty XL Vacuum with Self-Empty Base, Home Mapping, RV1002AE, New', price: 300.00, desc: 50.00, score: 3, votes: 20, send: 'Envío gratis', send_days: 3, img: '../img/tiendaks/producto/producto-prueba.png' },
                { id: 4, name: 'Shark IQ Robot Self-Empty XL Vacuum with Self-Empty Base, Home Mapping, RV1002AE, New Shark IQ Robot Self-Empty XL Vacuum with Self-Empty Base, Home Mapping, RV1002AE, New', price: 300.00, desc: 50.00, score: 3, votes: 20, send: 'Envío gratis', send_days: 3, img: '../img/tiendaks/producto/producto-prueba.png' },
            ],
            products2: [
                { id: 6, name: 'Shark IQ Robot Self-Empty XL Vacuum with Self-Empty Base, Home Mapping, RV1002AE, New Shark IQ Robot Self-Empty XL Vacuum with Self-Empty Base, Home Mapping, RV1002AE, New', price: 300.00, desc: 0.00, score: 3, votes: 20, send: 'Envío gratis', send_days: 3, img: '../img/tiendaks/producto/producto-prueba.png' },
                { id: 7, name: 'Shark IQ Robot Self-Empty XL Vacuum with Self-Empty Base, Home Mapping, RV1002AE, New Shark IQ Robot Self-Empty XL Vacuum with Self-Empty Base, Home Mapping, RV1002AE, New', price: 300.00, desc: 50.00, score: 3, votes: 20, send: 'Envío gratis', send_days: 3, img: '../img/tiendaks/producto/producto-prueba.png' },
            ]
        };
    },
};
</script>
<style scoped>
.carousel-control-prev,
.carousel-control-next {
  width: 5%;
}
</style>
