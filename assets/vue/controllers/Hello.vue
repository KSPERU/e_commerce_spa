<template>
    <div>Hello amigo {{ name }}!</div>
</template>

<script setup>
    defineProps({
        name: String
    });
</script>
