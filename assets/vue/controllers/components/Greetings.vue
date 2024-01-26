<template>
    <div class="titulo">
      <p>Este texto tiene el color rojo.</p>
      <h1>Hola</h1>
    </div>

    <form action="" method="post">
        <label for="username">Email:</label>
        <input type="text" id="username" name="_username" value="">

        <label for="password">Password:</label>
        <input type="password" id="password" name="_password">

        <input type="hidden" name="app_prueba" value="/account">

        <button type="submit">login</button>
    </form>
</template>
  
<script>
export default {
    name: 'Greetings',
};
</script>

<style lang="scss" scoped>
    @import "assets/styles/greetings.scss";
</style>