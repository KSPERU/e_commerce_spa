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
  


  <script>
  import Content_PopupCarrito from "./Content_PopupCarrito.vue";
  
  export default {
    components: {
      Content_PopupCarrito,
    },
    data() {
      return {
        isOpen: false,
      };
    },
    methods: {
      openPopup() {
        this.isOpen = true;
      },
      closePopup() {
        this.isOpen = false;
      },
    },
  };
  </script>
  
  <style scoped>
  .popup_carrito {
    background-color: var(--color-azul-oscuro);
    width: 90px;
    height: 90px;
    border-radius: 50%;
    margin: 50px;
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
  }
  .popup-carrito-cart-icon{
    font-size: 24px;
  }
  }
  </style>
  