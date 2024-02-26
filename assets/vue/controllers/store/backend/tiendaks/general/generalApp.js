import { createApp } from "vue";
import { createPinia } from "pinia";

const pinia = createPinia();

import generalAccederGeneral from "./componentes/generalAccederGeneral"; 
const general_acceder_general = createApp(generalAccederGeneral); 
general_acceder_general.use(pinia);
general_acceder_general.mount('#general_acceder_general'); 

import generalVerProductoTarjeta from "./componentes/generalVerProductoTarjeta"; 
const general_ver_producto_tarjeta = createApp(generalVerProductoTarjeta); 
general_ver_producto_tarjeta.use(pinia);
general_ver_producto_tarjeta.mount('#general_ver_producto_tarjeta'); 

