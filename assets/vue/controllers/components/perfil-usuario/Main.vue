<template>
    <div class="container">
        <div class="row mt-3">
            <div class="col-12 col-sm-12 col-md-12 col-lg-3">

                <Info_PerfilUsuario />

                <Btns_Config />

                <Card_FiltrosAvanzados />

            </div>
            <div class="col-12 col-sm-12 col-md-12 col-lg-9 my-4">
                <Cards_Perfil_Usuario />
            </div>

            <div>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#productModal">
                    View Product Details
                </button>

                <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl">
                        <div class="modal-content">
                            <div class="modal-header z-3">
                                <h5 class="modal-title" id="productModalLabel">Editar</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>

                            <div class="p-0">
                                <div class="bg-azul-oscuro text-center d-flex flex-column justify-content-center align-items-center" style="height: 140px">
                                    <p class="m-0 text-white fs-5 fw-medium z-1">Modifica los campos que creas conveniente</p>
                                    <p class="m-0 text-white fw-light z-1">Actualiza y muestra tu producto</p>
                                    <div class="circle-container position-absolute">
                                        <div class="position-absolute top-0 start-0 large-circle bg-white" style="clip-path: inset(30% 0 0 0);"></div>
                                        <div class="position-absolute bottom-0 end-0 large-circle bg-white" style="clip-path: inset(0 0 30% 0);"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="modal-body">                  
                                <form>
                                    <div class="mb-3 fw-bold">Actualizar producto</div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="productName" class="form-label">Nombre</label>
                                                <input type="text" class="form-control" id="productName"
                                                    value="Televisor LG Uhd 55 4k Smart Thing IA...">
                                            </div>
                                            <div class="mb-3">
                                                <label for="productDescription" class="form-label">Descripción</label>
                                                <textarea class="form-control" id="productDescription"
                                                    rows="12">Su resolución es 4K UHD. Tecnología HDR para una calidad de imagen mejorada. Control LG Magic Remote no incluido. • Cuenta con conexión HDMI y USB. Entretenimiento y conectividad en un mismo lugar.</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="mb-3">
                                                <label for="productCategory" class="form-label">Categoría</label>
                                                <select v-model="selectedOption" class="form-select">
                                                    <!--<option disabled value="">Seleccione una opción</option>-->
                                                    <option selected>{{ selectedOption }}</option>
                                                    <option v-for="(option, index) in options" :key="index" :value="option">{{ option }}</option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="productPrice" class="form-label">Precio unitario</label>
                                                <input type="text" class="form-control" id="productPrice"
                                                    value="1500.00">
                                            </div>
                                            <div class="mb-3">
                                                <label for="productOfferPrice" class="form-label">Precio oferta
                                                    (Opcional)</label>
                                                <input type="text" class="form-control" id="productOfferPrice"
                                                    value="1399.00">
                                            </div>
                                            <div class="mb-3">
                                                <label for="productStock" class="form-label">Stock</label>
                                                <input type="text" class="form-control" id="productStock" value="4">
                                            </div>
                                            <div class="mb-3">
                                                <label for="timeEntrega" class="form-label">Tiempo de entrega
                                                    (días)</label>
                                                <input type="text" class="form-control" id="timeEntrega" value="1">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="">
                                                <label class="form-label">Imagen</label>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-8">
                                                    <div class="d-flex justify-content-center align-items-center border border-secondary-subtle rounded-1" style="width: 100%; height: 160px;">
                                                        <img v-if="image1" :src="image1" alt="Imagen 1" class="object-fit-cover rounded-1 img-inside-container">
                                                    </div>
                                                </div>
                                                <div class="col-4 d-flex flex-column">
                                                    <div class="flex-grow-1">
                                                        <div class="d-flex justify-content-center align-items-center border border-secondary-subtle rounded-1" style="width: 100%; height: 75px;">
                                                            <img v-if="image2" :src="image2" alt="Imagen 2" class="object-fit-cover rounded-1 img-inside-container">
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="d-flex justify-content-center align-items-center border border-secondary-subtle rounded-1" style="width: 100%; height: 75px;">
                                                            <img v-if="image3" :src="image3" alt="Imagen 3" class="object-fit-cover rounded-1 img-inside-container">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mb-3 input-group">
                                                <input type="file" class="form-control" id="productImage1" @change="handleFileChange(1)" :key="fileInputKey1">
                                                <button v-if="image1" @click="clearImage(1)" class="input-group-text">X</button>
                                            </div>
                                            <div class="mb-3 input-group">
                                                <input type="file" class="form-control" id="productImage2" @change="handleFileChange(2)" :key="fileInputKey2">
                                                <button v-if="image2" @click="clearImage(2)" class="input-group-text">X</button>
                                            </div>
                                            <div class="mb-3 input-group">
                                                <input type="file" class="form-control" id="productImage3" @change="handleFileChange(3)" :key="fileInputKey3">
                                                <button v-if="image3" @click="clearImage(3)" class="input-group-text">X</button>
                                            </div>
                                            <div class="mb-3">
                                                <button type="button" class="btn btn-primary w-100 p-2 sombra-button">Actualizar y guardar</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!--<div class="modal-footer">
                            </div>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import Info_PerfilUsuario from "./Info_PerfilUsuario.vue";
import Btns_Config from "./Btns_Config.vue";
import Card_FiltrosAvanzados from "./Card_FiltrosAvanzados.vue";
import Cards_Perfil_Usuario from "./Cards_Perfil_Usuario.vue";


const selectedOption = ref('Televisores');
const options = ref([]);
const image1 = ref(null);
const image2 = ref(null);
const image3 = ref(null);

const fileInputKey1 = ref(0);
const fileInputKey2 = ref(0);
const fileInputKey3 = ref(0);

// Aquí puedes inicializar tu array de opciones
options.value = ['Electrodomesticos', 'Juegos'];

const handleFileChange = (inputNumber) => {
  const inputElement = event.target;
  const file = inputElement.files[0];

  const reader = new FileReader();
  reader.onload = () => {
    const imageDataUrl = reader.result;
    switch (inputNumber) {
      case 1:
        image1.value = imageDataUrl;
        break;
      case 2:
        image2.value = imageDataUrl;
        break;
      case 3:
        image3.value = imageDataUrl;
        break;
      default:
        break;
    }
  };
  reader.readAsDataURL(file);
};

const clearImage = (inputNumber) => {
  switch (inputNumber) {
    case 1:
      image1.value = null;
      fileInputKey1.value++;
      break;
    case 2:
      image2.value = null;
      fileInputKey2.value++;
      break;
    case 3:
      image3.value = null;
      fileInputKey3.value++;
      break;
    default:
      break;
  }
};
</script>

<style scoped>
@media (min-width: 768px) {
  .modal {
    --bs-modal-width: 750px;
  }
  .large-circle {
    width: 280px;
    height: 155px;
    border-radius: 50%;
    /* clip-path: polygon(50% 0%, 100% 1000%, 100% 100%, 0% 50%); */ 
    opacity: 0.1;
    /* opacity: 1; */
    }
}
@media (max-width: 1199px) {
    .large-circle {
    visibility: hidden;
    }
}
.circle-container {
  width: 1100px;
  height: 285px;
}

.sombra-button {
    -webkit-box-shadow: 0px 7px 7px -1px rgba(171,171,171,1);
    -moz-box-shadow: 0px 7px 7px -1px rgba(171,171,171,1);
    box-shadow: 0px 7px 7px -1px rgba(171,171,171,1);
}

.img-inside-container {
    max-width: 100%; 
    max-height: 100%;
}
</style>