<template>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="input-group">
                    <input v-model="busqueda" type="text" class="form-control" placeholder="Búsqueda" >
                </div>
            </div>
            <div class="col-md-4">
                <button @click="actualizarTabla(busqueda, direccion, precio_inicio, precio_fin)" class="btn btn-primary w-100 mt-2 mt-md-0">Filtrar</button>
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
    </div>

    <table class="table mt-3">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripción</th>
                <th scope="col">Categoria</th>
                <th scope="col">Precio</th>
                <th scope="col">Operacion</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="dato in productos">
                <th scope="row">{{ dato.id }}</th>
                <td>{{ dato.pr_nombre }}</td>
                <td>{{ dato.pr_descripcion }}</td>
                <td>{{ dato.pr_categoria }}</td>
                <td>{{ dato.pr_precio }}</td>
                <td><button @click="agregarProducto(dato.id, 1)">Agregar al Carrito</button></td>
            </tr>
        </tbody>
    </table>
    <div>
        <mostrarVistaCarrito />
    </div>
</template>

<script setup>
    import { onMounted, computed } from "vue";
    import mostrarVistaCarrito from '../../../../carrito/mostrarVistaCarrito';
    import { useProductoPorCategoriaContenedor } from '../../../producto_por_categoria/productoPorCategoriaContenedor';
    import { ref } from 'vue';
    import { carritoStore  } from "../../../../carrito/carritoContenedor" 
    
    const carrito = carritoStore();
    const agregarProducto = async (id, cantidad) => {
        await carrito.agregarProducto({
            id_producto: id,
            cantidad: cantidad,
        })
    };
    const productoPorCategoriaContenedor = useProductoPorCategoriaContenedor();

    const busqueda = null;
    const atributos = ref([]);
    const direccion = null;
    const precio_inicio = null;
    const precio_fin = null;
    const categoria = ref('');
    
    const actualizarTabla = async (busqueda, direccion, precio_inicio, precio_fin) => {
        await productoPorCategoriaContenedor.getListarProductoPorCategoria(
            {
                "paramsProdList": {
                    "id": null,
                    "busqueda": busqueda ?? "",
                    "usuario_id": null
                },
                "optionsOrdenProdList": {
                    "categorias": [ categoria.value ],
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
        categoria.value = document.getElementById('producto_por_categoria_producto_listar_producto_por_categoria').getAttribute('data-categoria');
        productoPorCategoriaContenedor.getListarProductoPorCategoria({
            "optionsOrdenProdList": {
                "categorias": [ categoria.value ],
            }
        });
    });
</script>