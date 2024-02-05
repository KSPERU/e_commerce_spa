<template>
    <div class="alert alert-primary" role="alert">
        Categorias: /api/producto/listar/producto/concriterios
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="input-group">
                    <input v-model="busqueda" type="text" class="form-control" placeholder="Búsqueda" >
                </div>
            </div>
            <div class="col-md-4">
                <button @click="actualizarTabla(busqueda, direccion, precio_inicio, precio_fin, categoriasSeleccionadas)" class="btn btn-primary w-100 mt-2 mt-md-0">Filtrar</button>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-md-4">
            <div class="form-check">
                <input type="checkbox" id="precio" value="precio" v-model="atributos" class="form-check-input">
                <label for="precio" class="form-check-label">Precio</label>
            </div>
            </div>

            <div class="col-md-4">
            <div class="form-check">
                <input type="checkbox" id="otro" value="categoria" v-model="atributos" class="form-check-input">
                <label for="categoria" class="form-check-label">Categoria</label>
            </div>
            </div>

            <div class="col-md-4">
            <div class="form-check">
                <input type="checkbox" id="otro" value="otro" v-model="atributos" class="form-check-input">
                <label for="otro" class="form-check-label">Otro</label>
            </div>
            </div>
        </div>

        <div class="row mt-3" v-if="atributos.includes('precio')">
            <div class="col-md-4">
                <select v-model="direccion" id="direccion" class="form-select">
                    <option value="ascendente">ASC</option>
                    <option value="descendente">DSC</option>
                </select>
            </div>
            <div class="col-md-4">
            <input v-model="precio_inicio" type="text" class="form-control" placeholder="Precio inicial">
            </div>
            <div class="col-md-4">
            <input v-model="precio_fin" type="text" class="form-control" placeholder="Precio fin">
            </div>
        </div>

        <div class="row mt-3" v-if="atributos.includes('categoria')">
        <div class="col-md-12">
            <div class="row">
            <div class="col-md-2" v-for="(categoria, index) in categorias" :key="index">
                <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" v-model="categoriasSeleccionadas" :value="categoria" :id="`categoria-${index}`">
                <label class="form-check-label" :for="`categoria-${index}`">
                    {{ categoria }}
                </label>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>

    <table class="table mt-3">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripción</th>
                <th scope="col">Categoria</th>
                <th scope="col">Precio</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="dato in productos">
                <th scope="row">{{ dato.id }}</th>
                <td>{{ dato.pr_nombre }}</td>
                <td>{{ dato.pr_descripcion }}</td>
                <td>{{ dato.pr_categoria }}</td>
                <td>{{ dato.pr_precio }}</td>
            </tr>
        </tbody>
    </table>
</template>
  
<script setup>
    import { onMounted, computed } from "vue";
    import { useProductoContenedor } from '../producto/productoContenedor';
    import { ref } from 'vue';

    const productoContenedor = useProductoContenedor();

    const currentURL = window.location.href;
    const segments = currentURL.split("/");
    const usuario_id = segments[segments.length - 1];
    const busqueda = null;
    const atributos = ref([]);
    const direccion = null;
    const precio_inicio = null;
    const precio_fin = null;
    const categorias = ref(['home-decoration', 'groceries', 'skincare', 'fragrances', 'laptops', 'smartphones']);
    const categoriasSeleccionadas = ref([]);

    const actualizarTabla = async (busqueda, direccion, precio_inicio, precio_fin, categoriasSeleccionadas) => {
        await productoContenedor.getListarProductoConCriterios(
            {
                "paramsProdList": {
                    "id": null,
                    "busqueda": null,
                    "usuario_id": usuario_id
                },
                "optionsOrdenProdList": {
                    "categorias": categoriasSeleccionadas.length > 0 ? categoriasSeleccionadas : null,
                    "precio": {
                        "precio_inicio": precio_inicio === "" || precio_inicio === null ? 0 : precio_inicio,
                        "precio_fin": precio_fin === "" || precio_fin === null ? 99999 : precio_fin,
                        "direccion": direccion
                    },
                    "stock": "si",
                    "pagina": null,
                    "cantidad_productos": null
                }
            }
        );
    };

    const productos = computed(() => {
        return productoContenedor.PRODUCTOS
    })
    
    onMounted(() => {
        productoContenedor.getListarProductoConCriterios({
            "paramsProdList": {
                "usuario_id": usuario_id,
            }
        })
    })
</script>