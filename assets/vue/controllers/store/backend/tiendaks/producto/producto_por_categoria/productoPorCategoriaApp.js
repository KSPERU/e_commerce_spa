import { createApp } from "vue";
import { createPinia } from "pinia";

const pinia = createPinia();

import productoPorCategoriaProductoListarProductoPorCategoria  from "./componentes/prodPorCatListarProdPorCat/prodPorCatListarProdPorCat"; 
const producto_por_categoria_producto_listar_producto_por_categoria = createApp(productoPorCategoriaProductoListarProductoPorCategoria); 
producto_por_categoria_producto_listar_producto_por_categoria.use(pinia);
producto_por_categoria_producto_listar_producto_por_categoria.mount('#producto_por_categoria_producto_listar_producto_por_categoria');
