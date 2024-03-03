<template>
    <div class="row">
        <div v-for="producto in productos" :key="producto.id" class="col-3">
            <generalVerProductoTarjeta :producto="producto"/>
        </div>
    </div>
</template>
<script setup>
    import { onMounted, computed, ref } from "vue";
    import { useGeneralContenedor } from '../../general/generalContenedor';
    import generalVerProductoTarjeta from '../../general/componentes/generalVerProductoTarjeta';

    const generalContenedor = useGeneralContenedor();

    const categoria = ref('');

    const productos = computed(() => {
        return generalContenedor.PRODUCTOS
    });

    onMounted(() => {
        categoria.value = document.getElementById('general_ver_producto_tarjetario').getAttribute('data-categoria');
        generalContenedor.getVerProductoTarjetario({
            "optionsOrdenProdList": {
                "categorias": [ categoria.value ]
            }
        });
    });
</script>