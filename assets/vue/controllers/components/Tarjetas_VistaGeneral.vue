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
              <div class="card h-100 p-2">
                <img
                  src="../img/aspiradora.png"
                  class="card-img-top"
                  alt="..."
                />
                <div class="card-body pt-4">
                  <div class="row g-2">
                    <div class="col-lg-5 col-md-5 col-sm-12">
                      <span class="size-18 fw-normal">S/. 66 255.00</span>
                    </div>
                    <div
                      class="col-lg-7 col-md-7 col-sm-12 d-flex align-items-end d-lg-inline d-md-inline d-none"
                    >
                      <span
                        class="size-15 text-decoration-line-through fw-normal text-body-secondary"
                        >S/. 250.00</span
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
                        >S/. 50.00</span
                      >
                    </div>
                    <div class="col-lg-12 col-md-12 col-12">
                      <p class="size-14 custom-truncate m-0">
                        Shark IQ Robot Self-Empty XL Vacuum with Self-Empty
                        Base, Home Mapping, RV1002AE, New Shark IQ Robot
                        Self-Empty XL Vacuum with Self-Empty Base, Home Mapping,
                        RV1002AE, New
                      </p>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <span class="fa fa-star checked ms-1"></span>
                      <span class="fa fa-star checked ms-1"></span>
                      <span class="fa fa-star checked ms-1"></span>
                      <span
                        class="fa fa-star ms-1"
                        style="color: #d9d9d9"
                      ></span>
                      <span
                        class="fa fa-star ms-1"
                        style="color: #d9d9d9"
                      ></span>

                      <span
                        class="ms-2 text-body-secondary d-lg-inline d-md-inline d-none"
                      >
                        20
                      </span>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <p class="size-14">
                        <span class="fw-bold">Envío gratis</span>, llega
                        <span class="fw-bold">en 3+ dias</span>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col d-lg-block d-md-block d-sm-block">
              <div class="card h-100 p-2">
                <img
                  src="../img/aspiradora.png"
                  class="card-img-top"
                  alt="..."
                />
                <div class="card-body pt-4">
                  <div class="row g-2">
                    <div class="col-lg-5 col-md-5 col-sm-12">
                      <span class="size-18 fw-normal">S/. 66 255.00</span>
                    </div>
                    <div
                      class="col-lg-7 col-md-7 col-sm-12 d-flex align-items-end d-lg-inline d-md-inline d-none"
                    >
                      <span
                        class="size-15 text-decoration-line-through fw-normal text-body-secondary"
                        >S/. 250.00</span
                      >
                    </div>
                    <div class="col-lg-12 col-md-12 col-12">
                      <p class="size-14 custom-truncate m-0">
                        Shark IQ Robot Self-Empty XL Vacuum with Self-Empty
                        Base, Home Mapping, RV1002AE, New Shark IQ Robot
                        Self-Empty XL Vacuum with Self-Empty Base, Home Mapping,
                        RV1002AE, New
                      </p>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <span class="fa fa-star checked ms-1"></span>
                      <span class="fa fa-star checked ms-1"></span>
                      <span class="fa fa-star checked ms-1"></span>
                      <span
                        class="fa fa-star ms-1"
                        style="color: #d9d9d9"
                      ></span>
                      <span
                        class="fa fa-star ms-1"
                        style="color: #d9d9d9"
                      ></span>

                      <span
                        class="ms-2 text-body-secondary d-lg-inline d-md-inline d-none"
                      >
                        20
                      </span>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <p class="size-14">
                        <span class="fw-bold">Envío gratis</span>, llega
                        <span class="fw-bold">en 3+ dias</span>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col d-lg-block d-md-block d-sm-block">
              <div class="card h-100 p-2">
                <img
                  src="../img/aspiradora.png"
                  class="card-img-top"
                  alt="..."
                />
                <div class="card-body pt-4">
                  <div class="row g-2">
                    <div class="col-lg-5 col-md-5 col-sm-12">
                      <span class="size-18 fw-normal">S/. 66 255.00</span>
                    </div>
                    <div
                      class="col-lg-7 col-md-7 col-sm-12 d-flex align-items-end d-lg-inline d-md-inline d-none"
                    >
                      <span
                        class="size-15 text-decoration-line-through fw-normal text-body-secondary"
                        >S/. 250.00</span
                      >
                    </div>
                    <div class="col-lg-12 col-md-12 col-12">
                      <p class="size-14 custom-truncate m-0">
                        Shark IQ Robot Self-Empty XL Vacuum with Self-Empty
                        Base, Home Mapping, RV1002AE, New Shark IQ Robot
                        Self-Empty XL Vacuum with Self-Empty Base, Home Mapping,
                        RV1002AE, New
                      </p>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <span class="fa fa-star checked ms-1"></span>
                      <span class="fa fa-star checked ms-1"></span>
                      <span class="fa fa-star checked ms-1"></span>
                      <span
                        class="fa fa-star ms-1"
                        style="color: #d9d9d9"
                      ></span>
                      <span
                        class="fa fa-star ms-1"
                        style="color: #d9d9d9"
                      ></span>

                      <span
                        class="ms-2 text-body-secondary d-lg-inline d-md-inline d-none"
                      >
                        20
                      </span>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <p class="size-14">
                        <span class="fw-bold">Envío gratis</span>, llega
                        <span class="fw-bold">en 3+ dias</span>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col d-lg-block d-md-block d-sm-block">
              <div class="card h-100 p-2">
                <img
                  src="../img/aspiradora.png"
                  class="card-img-top"
                  alt="..."
                />
                <div class="card-body pt-4">
                  <div class="row g-2">
                    <div class="col-lg-5 col-md-5 col-sm-12">
                      <span class="size-18 fw-normal">S/. 66 255.00</span>
                    </div>
                    <div
                      class="col-lg-7 col-md-7 col-sm-12 d-flex align-items-end d-lg-inline d-md-inline d-none"
                    >
                      <span
                        class="size-15 text-decoration-line-through fw-normal text-body-secondary"
                        >S/. 250.00</span
                      >
                    </div>
                    <div class="col-lg-12 col-md-12 col-12">
                      <p class="size-14 custom-truncate m-0">
                        Shark IQ Robot Self-Empty XL Vacuum with Self-Empty
                        Base, Home Mapping, RV1002AE, New Shark IQ Robot
                        Self-Empty XL Vacuum with Self-Empty Base, Home Mapping,
                        RV1002AE, New
                      </p>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <span class="fa fa-star checked ms-1"></span>
                      <span class="fa fa-star checked ms-1"></span>
                      <span class="fa fa-star checked ms-1"></span>
                      <span
                        class="fa fa-star ms-1"
                        style="color: #d9d9d9"
                      ></span>
                      <span
                        class="fa fa-star ms-1"
                        style="color: #d9d9d9"
                      ></span>

                      <span
                        class="ms-2 text-body-secondary d-lg-inline d-md-inline d-none"
                      >
                        20
                      </span>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <p class="size-14">
                        <span class="fw-bold">Envío gratis</span>, llega
                        <span class="fw-bold">en 3+ dias</span>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <div class="row row-cols-1 row-cols-md-4 g-4">
            <div class="col">
              <div class="card h-100">
                <img src="../img/Portada.png" class="card-img-top" alt="..." />
                <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">
                    This is a longer card with supporting text below as a
                    natural lead-in to additional content. This content is a
                    little bit longer.
                  </p>
                </div>
              </div>
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
export default {
  data() {
    return {
      mostrarOferta: window.innerWidth < 426.8,
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
.carousel-control-prev,
.carousel-control-next {
  width: 5%;
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

@media (max-width: 426.8px) {
  img {
    aspect-ratio: 7 / 6;
  }
  .custom-truncate {
    -webkit-line-clamp: 2;
  }
}

.VistaMovil span.text-wrap {
  display: inline;
}
</style>
