<template>
  <div class="text-bg-dark">Hello {{ name }}!</div>
  <div class="text-bg-dark">Tipo de de papitas {{ papitas }}!</div>

  <div v-for="(papita, id) in papitas" :key="id">
    {{ papita }}
  </div>

  <p>Trabajando con objetos</p>

  {{ informacion }}

  <div v-for="(data, index) in informacion" :key="index">
    <h2>{{ data.Perdil }}</h2>
  </div>
</template>

<script>
export default {
  name: "App3",
  components: {},
  setup(props) {
    try {
      const informacion = props.informacion;
      const propiedades = Object.keys(informacion);
      for (const propiedad of propiedades) {
        console.log(propiedad, informacion[propiedad]);
      }
    } catch (error) {
      console.error(error);
    }
  },
  props: {

  },
};
</script>
