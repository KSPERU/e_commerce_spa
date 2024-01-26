<template lang="">
  <div>
    <div class="text-bg-dark">Hello {{ name }}!</div>
    <Greetings  />
    <ComponentePrueba />
    <!-- <Tarjetas_VistaGeneral /> -->
  </div>
</template>
<script>

import Tarjetas_VistaGeneral from "./components/Tarjetas_VistaGeneral.vue";
import Greetings from "./components/Greetings.vue";
import ComponentePrueba from "./components/ComponentePrueba.vue";

export default {
  components: {
    Tarjetas_VistaGeneral,
    Greetings,
    ComponentePrueba
  },
  props: {
    name: String,
  },
};
</script>
<style lang=""></style>
