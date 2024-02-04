<template lang="">
  <div v-for="product in products" :key="product.id">
    <div class="card h-100 p-2">
      <img src="../img/aspiradora.png" class="card-img-top" alt="..." />
      <div class="card-body pt-4">
        <div class="row g-2">
          <div class="col-lg-6 col-md-5 col-sm-12">
            <span class="size-18 fw-normal">S/. {{ product.price }}</span>
          </div>
          <div
            class="col-lg-6 col-md-7 col-sm-12 d-flex align-items-end d-lg-inline d-md-inline d-none"
          >
            <span
              class="size-15 text-decoration-line-through fw-normal text-body-secondary"
              >S/. {{ product.price + product.desc }}</span
            >
          </div>
          <div
            class="col-lg-4 col-md-4 col-sm-6"
            :class="{ VistaMovil: mostrarOferta }"
          >
            <span class="size-14 badge bg-dark text-wrap">{{
              mostrarOferta ? "Oferta" : "Ahorras"
            }}</span>
          </div>
          <div
            class="col-lg-8 col-md-8 col-sm-6 d-none d-lg-inline d-md-inline"
          >
            <span class="size-14 fw-normal text-start"
              >S/. {{ product.desc }}</span
            >
          </div>
          <div class="col-lg-12 col-md-12 col-12">
            <p class="size-14 custom-truncate m-0">
              {{ product.name }}
            </p>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12">
            <span
              v-for="i in product.score"
              :key="i"
              class="fa fa-star checked ms-1"
            ></span>
            <span
              v-for="j in 5 - product.score"
              :key="j"
              class="fa fa-star ms-1"
              style="color: #d9d9d9"
            ></span>
            <span
              class="ms-2 text-body-secondary d-lg-inline d-md-inline d-none"
            >
              {{ product.votes }}
            </span>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12">
            <p class="size-14">
              <span class="fw-bold">{{ product.send }}</span
              >, llega
              <span class="fw-bold">en {{ product.send_days }}+ dias</span>
            </p>
          </div>
        </div>

        <div class="buttons col-5">
          <button
            class="btn border border-black border-2 text-black bg-secondary-subtle col-12 mb-3 button-effect"
          >
            <font-awesome-icon icon="eye" class="me-1" />Ver
          </button>
          <button
            class="btn border border-black border-2 text-black bg-secondary-subtle col-12 mb-3 button-effect"
          >
            <font-awesome-icon icon="cart-shopping" class="me-1" />Agregar
          </button>
          <button
            class="btn border border-black border-2 text-black bg-secondary-subtle col-12 mb-3 button-effect"
          >
            <font-awesome-icon icon="money-bill-wave" class="me-1" />Comprar
          </button>
        </div>

        <div class="favorito col-5">
          <button class="m-0 p-0 border border-0 bg-transparent">
            <font-awesome-icon icon="star" class="fa-xl" />
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      mostrarOferta: window.innerWidth < 426.8,

      products: [
        {
          id: 1,
          name: "Shark IQ Robot Self-Empty XL Vacuum with Self-Empty Base, Home Mapping, RV1002AE, New Shark IQ Robot Self-Empty XL Vacuum with Self-Empty Base, Home Mapping, RV1002AE, New",
          price: 300.0,
          desc: 0.0,
          score: 3,
          votes: 20,
          send: "Envío gratis",
          send_days: 3,
          img: "../img/tiendaks/producto/producto-prueba.png",
        },
      ],
    };
  },
  mounted() {
    window.addEventListener("resize", this.actualizarEstado);
  },
  methods: {
    actualizarEstado() {
      this.mostrarOferta = window.innerWidth < 426.8;
    },
  },
  beforeDestroy() {
    window.removeEventListener("resize", this.actualizarEstado);
  },
};
</script>
<style scoped>
/* .button-effect {
  background: #D9D9D9;
} */
.button-effect:hover {
  background: #17172b !important;
  color: white !important;
}
.favorito {
  position: absolute;
  top: 5%;
  left: 105%;
  transform: translate(-50%, -50%);
  opacity: 0;
  transition: opacity 0.3s;
}
.card:hover .favorito {
  opacity: 1;
  background-color: transparent;
}

.buttons {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  opacity: 0;
  transition: opacity 0.3s;
}

.card:hover .buttons {
  opacity: 1;
}
.checked {
  color: #000000;
}

.card:hover {
  background-color: rgb(23, 23, 43, 0.2);
  z-index: 1;
  transition: background-color 300ms ease-out;
}

img {
  aspect-ratio: 9 / 9;
}
.card:hover img,
.card:hover span,
.card:hover p {
  opacity: 0.5;
}

.custom-truncate {
  display: -webkit-box;
  -webkit-line-clamp: 4; /* Número de líneas que deseas mostrar */
  -webkit-box-orient: vertical;
  overflow: hidden;
}
.VistaMovil span.text-wrap {
  display: inline;
}

@media (max-width: 426.8px) {
  img {
    aspect-ratio: 7 / 6;
  }
  .custom-truncate {
    -webkit-line-clamp: 2;
  }
}
</style>
