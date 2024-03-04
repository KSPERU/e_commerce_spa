<template>
    <div>
      <button @click="openPopup" class="popup_carrito position-fixed bottom-0 end-0 d-flex justify-content-center align-items-center cursor-pointer border-0 text-white">
        <font-awesome-icon icon="cart-shopping" size="2x" class="popup-carrito-cart-icon"/>
        <div class="popup_carrito_cantidad">
          <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
          2
          </span>
        </div>
      </button>
      <div v-if="isOpen" class="popup-overlay">
        <Content_PopupCarrito @closePopup="closePopup" />
      </div>
    </div>
  </template>
  


  <script setup>
   import { library } from '@fortawesome/fontawesome-svg-core';
    import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
    import { faCartShopping, faAngleDown, faAngleUp, faTrash, faEnvelope, faPhoneSquare, faAngleRight, faFilter, faMobileScreen,faTv,faHeadphones,faKeyboard,faTabletAlt,faLaptop,faMoneyBillWave,faStar,faEye ,faCreditCard, faCity, faMobile, faMoneyBill} from '@fortawesome/free-solid-svg-icons';
    library.add(faCartShopping, faAngleDown, faAngleUp, faTrash, faEnvelope, faPhoneSquare, faAngleRight, faFilter,faMobileScreen,faTv,faHeadphones,faKeyboard,faTabletAlt,faLaptop,faMoneyBillWave,faStar,faEye,faCreditCard, faCity, faMobile, faMoneyBill);
    import {ref, onMounted} from 'vue';
  import Content_PopupCarrito from "./Content_PopupCarrito.vue";

  const isOpen = ref(false); // Variable reactiva para controlar la visibilidad del popup

  const openPopup = () => {
    isOpen.value = true; // Mostrar el popup
  };

  const closePopup = () => {
    isOpen.value = false; // Ocultar el popup
};
</script>
  
  <style scoped>
  .popup_carrito {
    background-color: var(--color-azul-oscuro);
    width: 90px;
    height: 90px;
    border-radius: 50%;
    margin: 50px;
    z-index: 99;
  }
  
  .popup_carrito_cantidad{
    height: 100%;
    top: 12px;
    left: 12px;
    position: relative;
  }

  @media (max-width: 575.98px) {
    .popup_carrito {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    margin: 20px;
    z-index: 99;
    }
    .popup-carrito-cart-icon{
      font-size: 24px;
    }
  }
  </style>
  