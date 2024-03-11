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
                        <div class="d-flex">
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
                            <button class="btn btn-primary w-100" @click="generarFactura(compra.id)">
                                Factura
                            </button>
                        </div>
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
    import axios from 'axios';
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

    const generarFactura = async (compraId) => {
        try {
            console.log("compraid", compraId)
            const response = await axios.post('/api/compras/mostrar/compras/factura', { id_compra: compraId });
            if (response.status === 200) {
                console.log('Factura generada correctamente', response.data);
                const blob = new Blob([response.data], { type: 'application/pdf' });
                console.log('blob', blob);
                const url = URL.createObjectURL(blob);
                window.open(url, '_blank');
            } else {
                console.error('Error al obtener la factura:', response.statusText);
            }
        } catch (error) {
            console.error('Error al generar la factura:', error);
        }
    };
    
    onMounted(async () => {
        await usuarioContenedor.obtenerIdUsuarioLogueado();
        comprasContenedor.getListarComprasConCriterios({
            "ParamsCompraList": {
            "usuario_id": usuarioid.value
            }
        });
        })
</script>