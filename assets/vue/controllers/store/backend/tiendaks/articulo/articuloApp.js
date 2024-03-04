import { createApp } from "vue";
import { createPinia } from "pinia";

const pinia = createPinia();

import articuloVerProductoPorId from "./componentes/articuloVerProductoPorId"; 
const articulo_ver_producto_por_id = createApp(articuloVerProductoPorId); 
articulo_ver_producto_por_id.use(pinia);
articulo_ver_producto_por_id.mount('#articulo_ver_producto_por_id'); 

import articuloVerProductoListadoVendedorPopulares from "./componentes/articuloVerProductoListadoVendedorPopulares"; 
const articulo_ver_producto_listado_vendedor_populares = createApp(articuloVerProductoListadoVendedorPopulares); 
articulo_ver_producto_listado_vendedor_populares.use(pinia);
articulo_ver_producto_listado_vendedor_populares.mount('#articulo_ver_producto_listado_vendedor_populares'); 