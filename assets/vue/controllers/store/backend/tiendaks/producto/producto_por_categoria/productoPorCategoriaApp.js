import { createApp } from "vue";
import { createPinia } from "pinia";

const pinia = createPinia();

import inicioProductoListarPorCategoria from "./componentes/inicioProductoListarPorCategoria/inicioProductoListarPorCategoria"; 
const inicio_producto_listar_por_categoria = createApp(inicioProductoListarPorCategoria); 
inicio_producto_listar_por_categoria.use(pinia);
inicio_producto_listar_por_categoria.mount('#inicio_producto_listar_por_categoria');
