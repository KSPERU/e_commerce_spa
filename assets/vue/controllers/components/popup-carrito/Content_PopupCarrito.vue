<template>
  <div class="main-content-popup-carrito">
    <div class="content-popup-carrito position-fixed bottom-0 end-0 card border-0 rounded-3">
      <div class="card-header d-flex justify-content-between align-items-center py-3 content-popup-carrito-card-header rounded-3 rounded-bottom-0">
        <h6 class="my-0 mx-1 size-22">Carrito de compras</h6>
        <button @click="$emit('closePopup')" class="border-0 bg-transparent">
          <font-awesome-icon icon="angle-down" color="white" size="xl"/>
        </button>
      </div>
      <div class="card-body h-100">
        <div class="content-popup-carrito-card-body-products mb-2">
          <div class="overflow-hidden m-0 w-100 card-body-products-height" >
            <!--  -->
            <div v-for="producto in detallesCarrito" @some-event="productoagregado" class="popup-carrito-product row overflow-hidden d-flex align-items-center pb-3">
              <div class="col-3 h-100">
                <figure class="m-0 w-100 h-100">
                  <img class="w-100 h-100 object-fit-cover" :src="producto.prImagenes[0]" alt="producto-"/>
                </figure>
              </div>
              <div class="col-3 h-100 px-0">
                <p class="m-0 size-12-10 line-clamp-4">{{producto.prNombre}}</p>
              </div>
              <div class="col-2 h-100 d-flex flex-column align-items-center justify-content-center">
                <button id="increment" @click="stepper('increment', producto.id, producto.prStock,(producto.dcCantidad))"><font-awesome-icon icon="angle-up" color="#D9D9D9"/></button>
                <input type="number" class="input-cantidad" :value="producto.dcCantidad" :min="min" :max="max">
                <button id="decrement" @click="stepper('decrement', producto.id,producto.prStock, (producto.dcCantidad))"><font-awesome-icon icon="angle-down" color="#D9D9D9"/></button>
              </div>
              <div class="col-3 h-100 px-0 text-center">
                <span class="m-0 size-12-10">S/. {{producto.dcImporte}}</span>
              </div>
              <div class="col-1 h-100 px-0">
                <button @click="eliminarProducto(producto.id)" class="popup-carrito-product-eliminar ps-2">
                  <font-awesome-icon icon="trash" />
                </button>
              </div>
            </div>
            <!--  -->
          </div>
        </div>
        <div class="content-popup-carrito-card-body-resume size-16 pt-3">
            <div>
              <p class="float-start d-inline m-0">Subtotal</p>
              <p class="float-end d-inline m-0">S/. {{carritos.cImportetotal}}</p>
            </div>
            <div class="clearfix"></div>
            <div class="text-secondary">
              <p class="float-start d-inline m-0">Descuentos</p>
              <p class="float-end d-inline m-0">S/. {{carritos.cDescuentos}}</p>
            </div>
            <div class="clearfix"></div>
            <div class="resume-total">
              <p class="float-start d-inline m-0">TOTAL</p>
              <p class="float-end d-inline m-0">S/. {{carritos.cImportetotalFinal}}</p>
            </div>
            <div class="clearfix"></div>
            <div class="mt-3">
              <button @click="realizarCompra" class="btn btn-resume-popup-carrito">Continuar compra</button>
            </div>
        </div>
      </div>

      <svg width="1em" height="1em" viewBox="0 0 16 16" class="content-popup-carrito-tail position-absolute translate-middle mt-1" fill="#fff" xmlns="http://www.w3.org/2000/svg">
        <path d="M7.247 11.14L2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0" transform="rotate(-90 8 8)"/>
      </svg>

    </div>
  </div>
</template>

  <script setup>
  import * as bootstrap from 'bootstrap';
  import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
  import { onMounted, computed, ref } from "vue";
    import { carritoStore  } from "../../components/carritoContenedor" 
    import axios from 'axios';
    
    const carrito = carritoStore();
    const carritoAdvertencia = ref('');
    const cantidad = ref({});
    const eliminarProducto = async (id_eliminar) => {
        await carrito.eliminarProducto({
            id_detalle_carrito: id_eliminar,
        })
    };
    const stepper = async(action,id_modificar, prStock, cantidad) => {
        if (action === 'increment') {
          cantidad += 1;
        } else {
          cantidad -= 1;
        }
        await modificarProducto(id_modificar, prStock, cantidad);
    };

    const modificarProducto = async (id_modificar, prStock, cantidad) => {
        const mensaje = await carrito.modificarProducto({
            id_detalle_carrito: id_modificar,
            cantidad: cantidad
        })
        
        if (mensaje) {
            carritoAdvertencia.value = `${mensaje.error} Stock actual: ${prStock}`;
        } else {
            
            carritoAdvertencia.value = "";
        

        }
    };
    const fd = new FormData();

    const realizarCompra = async () => {
        try {
          //abrir modal
        
        const response = await axios.post('/tiendaks/carrito',fd);
        console.log(response.data);

        // Extraer la URL de la respuesta
        const url = response.data.url;

        // Redirigir a la nueva URL
        if(url === 'app_login'){
          const modal = new bootstrap.Modal(document.getElementById('exampleModal'));
          modal.show();
        }else{
          window.location.href = url;
        }
        //window.location.href = url;
        } catch (error) {
        // Manejar errores aquí
        console.error('Error al realizar la compra', error);
        }
    };
    // const closePopup = async function() {
    //     this.$emit('closePopup');
    // }

    const detallesCarrito = computed(() => {
        return carrito.DETALLESCARRITOS
    })

    const carritos = computed(() => {
        return carrito.CARRITOS
    })

    onMounted(() => {
        carrito.visualizarCarrito();
        })

  </script>
  
  <style scoped>
  .main-content-popup-carrito{
    position: relative;
    z-index: 100;
  }
  .content-popup-carrito {
    background-color: white;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    margin-right: 125px;
    margin-bottom: 70px;
    width: 380px;
  }

  .content-popup-carrito-tail{
    bottom: 10px;
    right: -18px;
  }

  .content-popup-carrito-card-header{
    background-color: var(--color-azul-oscuro);
    color: #fff;
  }

  .popup-carrito-product {
    border-bottom: 1px solid #EBEBEB;
  }

  .content-popup-carrito-card-body-resume .resume-total{
    font-weight: 700;
  }

  .content-popup-carrito-card-body-resume{
    border-top: 1px solid #EBEBEB;
  }

  .btn-resume-popup-carrito{
    background-color: var(--color-azul-oscuro);
    width: 100%;
    color: #fff;
    font-weight: 600;
    text-transform: uppercase;
    text-align: center;
    letter-spacing: 1px;
    padding: 10px;
  }

  .popup-carrito-product{
    max-height: 86px;
    min-height: 86px;
    width: 100%;
  }
  .content-popup-carrito-card-body-products{
    height: 350px;
  }

  .card-body-products-height{
    height: auto;
  }
  .line-clamp-4 {
      display: -webkit-box;
      -webkit-line-clamp: 4;
      -webkit-box-orient: vertical;
      overflow: hidden;
    } 

    /*  */    
    .input-cantidad {

      width: 54px;
      padding-left: 6px;
      text-align: center !important;
      background-color: transparent;
      /* width: 100%; */
      border: none;
      border-radius: 4px;
      font-size: 12px;
      -moz-appearance: textfield;
    }
    /*  */

    .popup-carrito-product-eliminar{
      border: 0;
      background-color: transparent;
    }

    #decrement, #increment{
      border: 0;
      background-color: transparent;
      -webkit-appearance: none;
    }


  @media (max-width: 575.98px) {
    .main-content-popup-carrito{
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100vh;
      padding: 25px !important;
      background-color: rgba(0, 0, 0, 0.7);
      z-index: 100;
    }
    .content-popup-carrito {
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: calc(100% - 24px);
    height: calc(100% - 24px);
    }
    .content-popup-carrito-card-body-products{
      height: calc(100% - 160px);
    }
    .input-cantidad{
      padding-left: 0px;
    }
   }

  @media (max-width: 767.98px) {  }


  @media (max-width: 991.98px) { }

    @media (min-width: 1199.98px) { 
      .input-cantidad {
        padding-left: 16px;
      }
     }
  </style>
    