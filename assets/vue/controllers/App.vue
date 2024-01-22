<template lang="">
  <div>
    <div class="text-bg-dark">Hello {{ name }}!</div>
    <Tarjetas_VistaGeneral />
  </div>
</template>
<script>

import Tarjetas_VistaGeneral from "./components/Tarjetas_VistaGeneral.vue";

export default {
  components: {
    Tarjetas_VistaGeneral,
  },
  props: {
    name: String,
  },
};
</script>
<style lang=""></style>
