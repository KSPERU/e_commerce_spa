<template>
    <div v-for="productoObj in producto">
        <div class="container mt-4">
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <td style="width: 150px">id</td>
                        <td>{{productoObj.id}}</td> 
                    </tr>
                    <tr>
                        <td>pr_nombre</td>
                        <td>{{productoObj.pr_nombre}}</td>
                    </tr>
                    <tr>
                        <td>pr_descripcion</td>
                        <td>{{productoObj.pr_descripcion}}</td>
                    </tr>
                    <tr>
                        <td>pr_categoria</td>
                        <td>{{productoObj.pr_categoria}}</td>
                    </tr>
                    <tr>
                        <td>pr_imagenes</td>
                        <td>
                            <ul>
                                <li v-for="imagen in productoObj.pr_imagenes">{{imagen}}</li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td>pr_precio</td>
                        <td>{{productoObj.pr_precio}}</td>
                    </tr>
                    <tr>
                        <td>pr_descuento</td>
                        <td>{{productoObj.pr_descuento}}</td>
                    </tr>
                    <tr>
                        <td>pr_preciofinal</td>
                        <td>{{productoObj.pr_preciofinal}}</td>
                    </tr>
                    <tr>
                        <td>valoracion</td>
                        <td>{{productoObj.valoracion}}</td>
                    </tr>
                    <tr>
                        <td>cantidadvaloracion</td>
                        <td>{{productoObj.cantidadvaloracion}}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
<script setup>
    import { ref, onMounted, computed } from 'vue';
    import { useArticuloContenedor } from '../../articulo/articuloContenedor';

    const verArticuloContenedor = useArticuloContenedor();

    const producto_id = ref('');

    const producto = computed(() => {
        return verArticuloContenedor.PRODUCTO
    });

    onMounted(() => {
        producto_id.value = document.getElementById('articulo_ver_producto_por_id').getAttribute('data-producto-id');
        verArticuloContenedor.getVerProductoPorId({
            "paramsProdList": {
                "id": producto_id.value,
            }
        });
    });
</script>