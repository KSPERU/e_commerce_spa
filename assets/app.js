import { registerVueControllerComponents } from '@symfony/ux-vue';
import './styles/app.scss';
import './bootstrap.js';
import './bootstrap';

import { createApp } from "vue";
import { createPinia } from "pinia";

//import App2 from "./vue/controllers/App2";

import Appcarrito from "./vue/controllers/carrito"; 

import Approducto from "./vue/controllers/producto"; 
// import App from "./vue/controllers/App"; //Componente Principal en donde estarán todos los hijos.
// import App2 from "./vue/controllers/en_desuso/App2";
// import App3 from "./vue/controllers/en_desuso/App3";

// import App2 from "./vue/controllers/App2"; //Ver componente de Listar productos
// import App3 from "./vue/controllers/carrito"; //Ver componente de Listar productos
// import app from "./vue/controllers/App";

const pinia = createPinia();

//const app2 = createApp(App2); 
const appcarrito = createApp(Appcarrito); 
const approducto = createApp(Approducto); 

//app2.use(pinia);
//app2.mount('#app2');

appcarrito.use(pinia);
appcarrito.mount('#appcarrito');

// import Appcarritoglobal from "./vue/controllers/store/backend/tiendaks/carrito/mostrarVistaCarrito"; 

// const appcarritoglobal = createApp(Appcarritoglobal); 
// appcarritoglobal.use(pinia);
// appcarritoglobal.mount('#appcarritoMostrarVistaCarrito');

import productoApp from "./vue/controllers/store/backend/tiendaks/producto/productoApp";
const producto_app = createApp(productoApp);
producto_app.use(pinia);
producto_app.mount('#producto_app');

import comprasApp from "./vue/controllers/store/backend/tiendaks/compras/comprasApp";
const compras_app = createApp(comprasApp);
compras_app.use(pinia);
compras_app.mount('#compras_app');

import './vue/controllers/store/backend/tiendaks/producto/inicio/inicioApp.js';
import './vue/controllers/store/backend/tiendaks/producto/producto_por_categoria/productoPorCategoriaApp.js';
import './vue/controllers/store/backend/tiendaks/producto/ver_producto/verProductoApp.js';

const $ = require('jquery');
require('bootstrap');

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
});

registerVueControllerComponents(require.context('./vue/controllers', true, /\.vue$/));
