import { registerVueControllerComponents } from '@symfony/ux-vue';
import './styles/app.scss';
import './bootstrap.js';
import './bootstrap';

import { createApp } from "vue";
import { createPinia } from "pinia";

import App2 from "./vue/controllers/App2";

import Appcarrito from "./vue/controllers/store/backend/tiendaks/carrito/carritoApp"; 

const pinia = createPinia();

const appcarrito = createApp(Appcarrito); 
appcarrito.use(pinia);
appcarrito.mount('#appcarrito');

import Approducto from "./vue/controllers/producto"; 
const approducto = createApp(Approducto); 
approducto.use(pinia);
approducto.mount('#approducto');

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
