<template>
    <div class="container-lg">
    <div class="row">
        <div class="col-3">
            <div class="card card-perfil-usuario my-1 my-md-2 my-lg-3 text-center py-2 py-lg-4 d-flex flex-row flex-lg-column px-2 align-items-center">
                <figure class="m-0">
                    <img src="../../img/usuario-ejemplo.png" class="avatar-perfil-usuario"
                        alt="avatar-perfil-usuario" />
                </figure>
                <div class="px-2 px-sm-3 px-md-4 px-lg-1 px-xl-3 px-xxl-5">
                    <div class="my-0 my-lg-2 ">
                        <h6 class="text-start text-md-center size-22">
                            {{ usuario.u_nombres }}
                            {{ usuario.u_apepat }} {{ usuario.u_apemat }}
                        </h6>
                    </div>
                    <div class="text-start">
                        <div class="m-0 text-truncate email-phone-width-truncate d-flex align-items-center my-1">
                            <font-awesome-icon icon="envelope" />
                            <span class="mx-2 size-14 ">{{ usuario.u_correo }}</span>
                        </div>
                        <div class="m-0 text-truncate email-phone-width-truncate d-flex align-items-center my-1">
                            <font-awesome-icon icon="square-phone" />
                            <span class="mx-2 size-14 ">{{ usuario.u_telefono }}</span>
                        </div>
                    </div>
                </div>
            </div>

        <div v-if="canAccessProfile">
            <div>
            <button class="btn-agregar-producto w-100 border-0 rounded-1 my-2 py-2 text-start px-4 px-md-3 px-lg-4 size-16-12 d-flex align-items-center justify-content-between">
                Agregar un producto
                <font-awesome-icon icon="angle-right"/>
                </button>
            </div>
            <div>
                <button class="btn-actualizar-productos w-100 border-0 rounded-1 my-2 py-2 text-start px-4 px-md-3 px-lg-4 size-16-12 d-flex align-items-center justify-content-between">
                Actualizar mis productos
                <font-awesome-icon icon="angle-right"/>
                </button>
            </div>
            <div>
                <form @submit.prevent="submitForm">
                <div class="form-group">
                    <label for="nombre">Nombre:</label>
                    <input type="text" class="form-control" id="nombre" v-model="producto.pr_nombre" required>
                </div>
                <div class="form-group">
                    <label for="categoria">Categoría:</label>
                    <input type="text" class="form-control" id="categoria" v-model="producto.pr_categoria" required>
                </div>
                <div class="form-group">
                    <label for="stock">Stock:</label>
                    <input type="number" class="form-control" id="stock" v-model="producto.pr_stock" required>
                </div>
                <div class="form-group">
                    <label for="precio">Precio:</label>
                    <input type="number" class="form-control" id="precio" v-model="producto.pr_precio" required>
                </div>
                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <textarea class="form-control" id="descripcion" v-model="producto.pr_descripcion"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Agregar Producto</button>
                </form>
            </div>
        </div>

            <div class="card card-filtros-avanzados mt-3" id="card-filtros" style="display: none;">
                <div class="card-header">
                    <p class="size-16 fw-semibold m-0">Filtros Avanzados</p>
                </div>
                
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="input-group">
                                <input v-model="busqueda" type="text" class="form-control" placeholder="Búsqueda" >
                            </div>
                        </div>
                        <div class="col-md-4">
                            <button @click="actualizarTabla(busqueda, direccion, precio_inicio, precio_fin, categoria)" class="btn btn-primary w-100 mt-2 mt-md-0">Filtrar</button>
                        </div>
                    </div>
                </div>
                <div class="card-body py-1">
                    <div class="my-3">
                        <h5 class="size-16 my-2">Categoria</h5>

                        <div v-for="(categoria, index) in categorias" :key="index" class="form-check">
                            <input class="form-check-input" type="checkbox" :value="categoria" :id="'categoria' + index" @click="actualizarCategoriasSeleccionadas($event, categoria)">
                            <label class="form-check-label" :for="'categoria' + index">
                                {{ categoria }} 
                            </label>
                        </div>
                    </div>
                    <div class="my-3">
                        <h5 class="size-16 my-2">Marca</h5>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="marca1">
                            <label class="form-check-label" for="marca1">
                                PHILLIPS
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="marca2">
                            <label class="form-check-label" for="marca2">
                                TOSHIBA
                            </label>
                        </div>
                    </div>
                    <div class="my-3">
                        <h5 class="size-16 my-2">Precio</h5>
                        <div class="form-check" @change="actualizarTabla(busqueda, direccion, 0, 50, categoria)">
                            <input class="form-check-input" type="checkbox" value="" id="precio1">
                            <label class="form-check-label" for="precio1">
                                S/. 0.00 - S/. 50.00
                            </label>
                        </div>
                        <div class="form-check" @change="actualizarTabla(busqueda, direccion, 50, 100, categoria)">
                            <input class="form-check-input" type="checkbox" value="" id="precio2">
                            <label class="form-check-label" for="precio2">
                                S/. 50.00 - S/. 100.00
                            </label>
                        </div>
                        <div class="form-check" @change="actualizarTabla(busqueda, direccion, 100, 500, categoria)">
                            <input class="form-check-input" type="checkbox" value="" id="precio3">
                            <label class="form-check-label" for="precio3">
                                S/. 100.00 - S/. 500.00
                            </label>
                        </div>
                        <div class="form-check" @change="actualizarTabla(busqueda, direccion, 500, 9999, categoria)">
                            <input class="form-check-input" type="checkbox" value="" id="precio4">
                            <label class="form-check-label" for="precio4">
                                S/. 500.00 a más
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-8">
            <div class="productos-venta-head d-flex justify-content-between">
                <div class="d-flex align-items-start align-items-md-center flex-column flex-md-row">
                    <h1 class="size-22 fw-bolder m-0">Productos en venta</h1>
                    <span class="ms-0 ms-md-3 text-secondary size-14">{{ productos.length }} resultados</span>
                </div>
                <div class="d-flex align-items-center flex-column flex-md-row">
                    <p class="m-0 text-secondary w-100 size-14 d-none d-md-block">Ordenar por:</p>
                    <select v-model="direccion" @change="actualizarTabla(busqueda, direccion, precio_inicio, precio_fin, categoria)" id="direccion" class="form-select form-select-sm" aria-label=".form-select-sm example" style="min-width: 132px">
                        <option selected>Más relevante</option>
                        <option value="ascendente">Menor precio</option>
                        <option value="descendente">Mayor precio</option>
                    </select>
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
                        <input type="checkbox" id="otro" value="otro" v-model="atributos" class="form-check-input">
                        <label for="otro" class="form-check-label">Otro</label>
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
        </div>
    </div>
</div>
    
</template>

<script setup>
    import { onMounted, computed, ref, watch } from "vue";
    import axios from 'axios';
    import { useProductoPorCategoriaContenedor } from './productoPorCategoriaContenedor';
    
    const productoPorCategoriaContenedor = useProductoPorCategoriaContenedor();

    const busqueda = null;
    const atributos = ref([]);
    const direccion = null;
    const precio_inicio = null;
    const precio_fin = null;
    const categoria = ref('');
    const currentURL = window.location.href;
    const segments = currentURL.split("/");
    const idusuario = parseInt(segments[segments.length - 1]);
    const usuario = ref({})
    const canAccessProfile = ref(false);
    const categorias = ref([]);
    const categoriasOriginales = ref([]);
    const categoriasSeleccionadas = ref([]);
    
    const actualizarTabla = async (busqueda, direccion, precio_inicio, precio_fin, categoria) => {
        await productoPorCategoriaContenedor.getListarProductoPorCategoria(
            {
                "paramsProdList": {
                    "id": null,
                    "busqueda": busqueda,
                    "usuario_id": idusuario
                },
                "optionsOrdenProdList": {
                    "categorias": categoria.value,
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
        return productoPorCategoriaContenedor.PRODUCTOSPORCATEGORIA
    });
    
    onMounted(() => {
        console.log('entro aqui ', idusuario);
        obtenerPerfilUsuario(idusuario)
        verificarAccesoPerfilPropio(idusuario);
        productoPorCategoriaContenedor.getListarProductoPorCategoria({
            "paramsProdList": {
                "id": null,
                "busqueda": null,
                "usuario_id": idusuario
            },
        });
        
    });

    watch(productos, () => {
        if (categoriasOriginales.value.length === 0) {
            extraerCategorias();
        }
    });

    function actualizarCategoriasSeleccionadas(event, categoria) {
        if (event.target.checked) {
            categoriasSeleccionadas.value.push(categoria);
        } else {
            const index = categoriasSeleccionadas.value.indexOf(categoria);
            if (index !== -1) {
                categoriasSeleccionadas.value.splice(index, 1);
            }
        }
        console.log('holaa ', categoriasSeleccionadas);
        actualizarTabla(busqueda, direccion, precio_inicio, precio_fin, categoriasSeleccionadas);
    }

    function extraerCategorias() {
        const categoriasUnicas = new Set();
        for (const producto of productos.value) {
            categoriasUnicas.add(producto.pr_categoria);
        }
        categorias.value = Array.from(categoriasUnicas);
        categoriasOriginales.value = Array.from(categoriasUnicas);
        console.log('xd ', categorias);
    }

    async function verificarAccesoPerfilPropio(idusuario) {
        try {
            const response = await axios.post('/api/carrito/perfil/propio', { id_usuario: idusuario });
            canAccessProfile.value = response.data.success;
        } catch (error) {
            console.error('Error al verificar el acceso al perfil propio:', error);
        }
    }

    async function obtenerPerfilUsuario(idusuario) {
        try {
            console.log(idusuario)
            const response = await axios.post('/api/carrito/listar/usuario', { id_usuario: idusuario })
            usuario.value = response.data[0]
        } catch (error) {
            console.log(error)
        }
    }

    const producto = ref({
    pr_nombre: '',
    pr_categoria: '',
    pr_stock: null,
    pr_precio: null,
    pr_descripcion: ''
});

const submitForm = () => {
    axios.post('/api/producto/api/productos', producto.value)
        .then(response => {
        console.log(response.data);
        
        })
        .catch(error => {
        console.error('Error al agregar producto:', error);
        });
};
</script>

<style scoped>
    .btn-agregar-producto, .btn-actualizar-productos{
        background-color: var(--color-azul-oscuro);
        color: #fff;
    }
    .btn-agregar-producto:hover, .btn-actualizar-productos:hover{
        background-color: #3483FA;
        color: #fff;
    }
    .card-perfil-usuario{
    background-color: var(--color-azul-oscuro);
    color: #fff;
    }
    .avatar-perfil-usuario{
        width: auto;
    }

    .email-phone-width-truncate{
        width: auto;
        max-width: 210px;
    }

    @media (max-width: 575.98px) { 
        .avatar-perfil-usuario{
            width: 50px;
        }

        .email-phone-width-truncate{
            width: 200px;
        }
    }

    @media (max-width: 767.98px) { 
    }

    @media (max-width: 991.98px) { 
        .avatar-perfil-usuario{
            width: 80px;
        }
    }

    @media (max-width: 1199.98px) {  }

    @media (max-width: 1399.98px) {  }
</style>