<template>
  <div>
    <ul>
      <li v-for="option in options" :key="option.value">
        <input type="radio" v-model="selectedOption" :value="option.value" @change="onOptionChange(option)" />
        <label>{{ option.text }}</label>
      </li>
    </ul>
    <button v-if="!showError" @click="confirmarCompra">Confirmar compra</button>
    <div v-if="showError" class="error-message">
      Por favor, selecciona un método de pago antes de confirmar la compra.
    </div>
  </div>
</template>

<script setup>
import { ref } from "vue";
import axios from 'axios';

const options = [
  { value: 'opcion1', text: 'Pago con tarjeta' },
  { value: 'opcion2', text: 'Pago en efectivo' },
  { value: 'opcion3', text: 'Transferencia bancaria' },
  { value: 'opcion4', text: 'yape/plin' },
];

const selectedOption = ref('');
const fd = new FormData();
const showError = ref(false);

const confirmarCompra = async () => {
  if (selectedOption.value === '') {
    showError.value = true;
  } else {
    try {
    const response = await axios.post('/api/compras/comprar/carrito', fd);
    console.log(response.data);

    if (response.data.url) {
        // Se recibió una URL, redirige a la página de compras
        const url = response.data.url;
        window.location.href = url;
    } else {
        // Se recibió un mensaje de error, maneja el error aquí
        console.error('Error al realizar la compra:', response.data.message);
        // Aquí puedes mostrar el mensaje de error en tu interfaz de usuario
        // Por ejemplo, mostrando un div con el mensaje de error
    }
} catch (error) {
    // Manejar errores aquí
    console.error('Error al realizar la compra', error);
    // Aquí puedes mostrar un mensaje de error genérico en tu interfaz de usuario
}
  }
};

function onOptionChange(option) {
  selectedOption.value = option.value;
  showError.value = false;
}

function showErrorMessage() {
  showError.value = true;
}
</script>

<style scoped>
.error-message {
  color: red;
  margin-top: 10px;
}
</style>


  