<template>
    <div class="alert alert-primary" role="alert">
        Categorias: /api/producto/listado/categoria/stock 
    </div>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8">
                <div class="input-group">
                    <input v-model="busqueda" type="text" class="form-control" placeholder="Búsqueda">
                </div>
            </div>
            <div class="col-md-4">
                <button @click="actualizarTabla(categorias, atributos, modo, min, max, busqueda)" class="btn btn-primary w-100 mt-2 mt-md-0">Filtrar</button>
            </div>
        </div>
    </div>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4">
            <div class="form-check">
                <input type="checkbox" id="precio" value="precio" v-model="atributos" class="form-check-input">
                <label for="precio" class="form-check-label">Precio</label>
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
            <input v-model="modo" type="text" class="form-control" placeholder="Modo">
            </div>
            <div class="col-md-4">
            <input v-model="min" type="text" class="form-control" placeholder="Min">
            </div>
            <div class="col-md-4">
            <input v-model="max" type="text" class="form-control" placeholder="Max">
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
            <tr v-for="dato in categoriaConMenuDeFiltros">
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
    import { useProductoModulo } from '../en_desuso/productoModulo';
    import { ref } from 'vue';

    const productoModulo = useProductoModulo();

    

    const currentURL = window.location.href;
    const segments = currentURL.split("/");
    const categoria = segments[segments.length - 1];
    const categorias = [categoria];

    
    const atributos = ref([]);

    const modo = "";
    const min = null;
    const max = null;

    const busqueda = "";

    const actualizarTabla = async (categorias, atributos, modo, min, max, busqueda) => {
        const atributos_aux = [];
        atributos.forEach(element => {
            if(element == "precio"){
                const aux = [];
                aux.push(element);
                if(modo == ""){
                    aux.push("menor");
                } else {
                    aux.push(modo);
                }
                if (min == null){
                    aux.push(0);
                } else {
                    aux.push(min);
                }
                if (max == null){
                    aux.push(999999);
                } else {
                    aux.push(max);
                }
                atributos_aux.push(aux);
            }
        });
        await productoModulo.getCategoriaConMenuDeFiltros(
            {
                "categorias": categorias,
                "atributos": atributos_aux,
                "busqueda": busqueda
            }
        );
    };

    const dataDeArranque = 
    {
        "categorias": categorias,
        "atributos": [],
        "busqueda": ""
    }

    const categoriaConMenuDeFiltros = computed(() => {
        return productoModulo.CATEGORIACONMENUDEFILTROS
    })
    
    onMounted(() => {
        productoModulo.getCategoriaConMenuDeFiltros(dataDeArranque)
    })
</script>