<template lang="">
    <div>
        <div class="card h-100 p-2 card-default">
          <img :src="product.img" class="card-img-top object-fit-contain" alt="..." />
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
                  class="fa fa-star checked ms-1 size-16"
                  ></span>
                  <span
                  v-for="j in 5 - product.score"
                  :key="j"
                  class="fa fa-star ms-1 size-16"
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

              <div class="buttons col-lg-5 col-md-5 col-8">
              <button
                  class="btn border border-black border-2 text-black bg-secondary-subtle col-12 mb-3 button-effect"  data-bs-toggle="modal" :data-bs-target="'#detallesModal_' + product.id">
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

    <!-- Modal detalle producto -->
    <div class="modal fade" :id="'detallesModal_'+ product.id" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Información del Producto</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row d-flex d-lg-flex flex-column-reverse flex-lg-row">
              <div class="col-12 col-lg-7 p-3">
                <div class="row">
                  <div class="col-8">
                    <div class="card p-3 h-100">
                      <img :src="product.img" alt="" class="object-fit-cover">
                    </div>
                  </div>
                  <div class="col-4">
                    <div class="row gap-2" style="height: 200px">
                      <div class="col-12 card p-3 h-100 overflow-hidden">
                        <img :src="product.img" alt="" class="object-fit-cover">
                      </div>
                      <div class="col-12 card p-3 h-100 overflow-hidden" >
                        <img :src="product.img"  alt="" class="object-fit-cover">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="text-secondary ps-3 pt-4">
                  <p class="fw-bold mb-1">Datos del vendedor:</p>
                  <p class="m-0">Roberto Manuel Perez Alcantara</p>
                  <p class="m-0">roberto.perez@gmail.com</p>
                  <p class="m-0">+51 999 888 777</p>
                </div>
              </div>
              <div class="col-12 col-lg-5 p-3">
                <div class="card p-3 px-4">
                  <div class="text-end my-2">
                      <span
                      v-for="i in product.score"
                      :key="i"
                      class="fa fa-star checked ms-1 size-16"
                      ></span>
                      <span
                      v-for="j in 5 - product.score"
                      :key="j"
                      class="fa fa-star ms-1 size-16"
                      style="color: #d9d9d9"
                      ></span>
                      <span
                      class="ms-2 text-body-secondary d-lg-inline d-md-inline d-none"
                      >
                      {{ product.votes }}
                      </span>
                  </div>
                  <div class="card-title fs-5 fw-bold lh-sm mb-3">{{product.name}}</div>
                  <span class='text-secondary text-decoration-line-through mb-1'>S/. {{product.desc}}</span>
                  <h1 class='fs-2 fw-bold text-azul-claro mb-3'>S/. {{product.price}}</h1>
                  <p class='mb-4'>{{product.description}}</p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class='d-flex align-items-center'>
                      <p class="m-0 me-2 text-secondary">Cantidad: </p>
                      <div style="width: 130px" class="d-flex justify-content-center align-items-center">
                        <button @click="decrement" class="btn btn-secondary">-</button>
                          <input type="number" v-model.number="cantidad" min="0" class="form-control rounded-0 text-center" readonly/>
                        <button @click="increment" class="btn btn-secondary rounded-end">+</button>
                      </div>
                    </div>
                    <p class="m-0 me-2 text-secondary">Stock: {{product.stock}}</p>
                  </div>
                  <div class="my-4">
                    <button class="btn btn-primary btn-lg w-100" type="button">
                      Comprar Ahora
                    </button>
                  </div>
                  <div>
                    <h6>Metodos de pago</h6>
                    <figure class='m-0 w-100 text-center'>
                      <img src="../img/metodos de pago.png" alt="" class="">
                    </figure>
                  </div>
                </div>
              </div>
            </div>
            <div class="row mt-3 ps-3">
              <h6 class="fw-bold">Otros productos del vendedor</h6>
              <div class="row row-cols-2 row-lg-cols-4">
                
                <div class="px-2" v-for="i in 4" :key="i">
                    <div class="card h-100 px-2 card-default">
                    <img :src="product.img" class="card-img-top object-fit-contain" alt="..." />
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
                            class="fa fa-star checked ms-1 size-16"
                            ></span>
                            <span
                            v-for="j in 5 - product.score"
                            :key="j"
                            class="fa fa-star ms-1 size-16"
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

                        <div class="buttons col-lg-5 col-md-5 col-8">
                        <button
                            class="btn border border-black border-2 text-black bg-secondary-subtle col-12 mb-3 button-effect"  data-bs-toggle="modal" :data-bs-target="'#detallesModal_' + product.id">
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

            
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</template>
<script>
export default {
  props: {
    product: Object,
  },
  data() {
    return {
      mostrarOferta: window.innerWidth < 426.8,
      cantidad: 0
    };
  },
  mounted() {
    window.addEventListener("resize", this.actualizarEstado);
  },
  methods: {
    actualizarEstado() {
      this.mostrarOferta = window.innerWidth < 426.8;
    }, 
    increment() {
      this.cantidad++;
    },
    decrement() {
      if (this.cantidad > 0) {
        this.cantidad--;
      }
    }
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
.card-default :hover .favorito {
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

.card-default:hover .buttons {
  opacity: 1;
}
.checked {
  color: #000000;
}

.card-default:hover {
  background-color: rgb(23, 23, 43, 0.2);
  z-index: 1;
  transition: background-color 300ms ease-out;
}

img {
  aspect-ratio: 9 / 9;
}
.card-default:hover img,
.card-default:hover span,
.card-default:hover p {
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

.buttons button{
  width: 120px;
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
