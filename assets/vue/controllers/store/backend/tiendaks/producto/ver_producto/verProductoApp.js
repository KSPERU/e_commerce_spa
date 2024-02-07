import { createApp } from "vue";
import { createPinia } from "pinia";

const pinia = createPinia();

import verProductoProductoMostrarProductoPorId from "./componentes/verProdProdMostProdPorId/verProdProdMostProdPorId"; 
const ver_producto_producto_mostar_producto_por_id = createApp(verProductoProductoMostrarProductoPorId); 
ver_producto_producto_mostar_producto_por_id.use(pinia);
ver_producto_producto_mostar_producto_por_id.mount('#ver_producto_producto_mostar_producto_por_id');

import verProductoProductoListarProductoPorCategoria from "./componentes/verProdProdListarProdPorCat/verProdProdListarProdPorCat"; 
const ver_producto_producto_listar_producto_por_categoria = createApp(verProductoProductoListarProductoPorCategoria); 
ver_producto_producto_listar_producto_por_categoria.use(pinia);
ver_producto_producto_listar_producto_por_categoria.mount('#ver_producto_producto_listar_producto_por_categoria');
