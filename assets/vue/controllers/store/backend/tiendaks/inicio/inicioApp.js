import { createApp } from "vue";
import { createPinia } from "pinia";

const pinia = createPinia();

import inicioVerProductoListado from "./componentes/inicioVerProductoListado"; 
const inicio_ver_producto_listado = createApp(inicioVerProductoListado); 
inicio_ver_producto_listado.use(pinia);
inicio_ver_producto_listado.mount('#inicio_ver_producto_listado'); 

import inicioVerProductoListadoOfertados from "./componentes/inicioVerProductoListadoOfertados"; 
const inicio_ver_producto_listado_ofertados = createApp(inicioVerProductoListadoOfertados); 
inicio_ver_producto_listado_ofertados.use(pinia);
inicio_ver_producto_listado_ofertados.mount('#inicio_ver_producto_listado_ofertados'); 


import inicioVerCategoriaListadoPopulares from "./componentes/inicioVerCategoriaListadoPopulares"; 
const inicio_ver_categoria_listado_populares = createApp(inicioVerCategoriaListadoPopulares); 
inicio_ver_categoria_listado_populares.use(pinia);
inicio_ver_categoria_listado_populares.mount('#inicio_ver_categoria_listado_populares'); 