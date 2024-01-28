<template lang="">
  <div class="login">
    <h1>Iniciar sesion</h1>
    <form class="ui form" @submit.prevent="onLogin">
      <div class="field">
        <input
          type="text"
          placeholder="Correo electronico"
          v-model="formData.email"
        />
      </div>
      <div class="field">
        <input
          type="password"
          placeholder="Contraseña"
          v-model="formData.password"
        />
      </div>
      <button type="submit" class="ui button positive fluid">Registrar</button>
    </form>
  </div>
</template>
<script>
import { ref } from "vue";

export default {
  name: "Login",
  props: {},
  setup() {
    let formData = ref({});
    const onLogin = () => {
      console.log(formData.value);
      this.$emit("login-datos", formData.value);
    };
    return {
      formData,
      onLogin,
    };
  },
  methods: {
    onLogin() {
      // Emitimos el evento `login-datos` con los datos del formulario
      this.$emit("login-datos", this.formData.value);

      // Detenemos la ejecución del componente para que podamos depurar el código
      console.log("Deteniendo la ejecución del componente");
      debugger;
    },
  },
};
</script>
<style lang="scss" scoped></style>
