<template>
    <div class="alert alert-primary" role="alert">
        Categorias: /api/compras/listar/compras/concriterios
    </div>

    <div class="container-fluid">
        <h2 class="mb-4">Tabla de Compras</h2>
        
        <div class="row">
            <div v-for="compra in compras" :key="compra.id" class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Compra #{{ compra.id }}</h5>
                        <p class="card-text">
                            <strong>Cantidad Total:</strong> {{ compra.cm_cantidadtotal }}<br>
                            <strong>Importe Total:</strong> {{ compra.cm_importetotal }}<br>
                            <strong>Fecha Compra:</strong> {{ new Date(compra.cm_fechacompra).toLocaleDateString() }}
                        </p>
                        <button
                            class="btn btn-primary w-100"
                            data-bs-toggle="collapse"
                            :data-bs-target="'#detallesCompra' + compra.id"
                            role="button"
                            aria-expanded="false"
                            aria-controls="detallesCompra"
                        >
                            Ver Detalles
                        </button>
                    </div>
                </div>

                <div :id="'detallesCompra' + compra.id" class="collapse mt-3">
                    <div class="row">
                        <div v-for="detalle in compra.detallecompras" :key="detalle.id" class="col-md-6 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <h6 class="card-title">Producto: {{ detalle.producto.pr_nombre }}</h6>
                                    <p class="card-text">
                                        <strong>Cantidad:</strong> {{ detalle.dcm_cantidad }}<br>
                                        <strong>Importe:</strong> {{ detalle.dcm_importe }}<br>
                                        <strong>Estado de Entrega:</strong>
                                        {{ detalle.dcm_estado === 0 ? 'No entregado' : 'Finalizado' }}
                                    </p>
                                    <img :src="detalle.producto.pr_imagenes[0]" alt="Producto" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import { onMounted, computed } from "vue";
    import { useComprasContenedor } from '../compras/comprasContenedor';
    import { useUsuarioContenedor } from '../usuario/usuarioContenedor';
    import { ref } from 'vue';

    const currentURL = window.location.href;
    // const segments = currentURL.split("/");
    // const usuario_id = segments[segments.length - 1];
    const comprasContenedor = useComprasContenedor();
    const usuarioContenedor = useUsuarioContenedor();
    const usuarioid = computed(() =>{
        return usuarioContenedor.IDUSUARIO
    })
    const compras = computed(() => {
        return comprasContenedor.COMPRAS
    })
    
    onMounted(async () => {
        await usuarioContenedor.obtenerIdUsuarioLogueado();
        comprasContenedor.getListarComprasConCriterios({
            "ParamsCompraList": {
            "usuario_id": usuarioid.value
            }
        });
        })
</script>