import { registerVueControllerComponents } from '@symfony/ux-vue';
import './styles/app.scss';
import './bootstrap.js';
import './bootstrap';

import { createApp } from "vue";
import { createPinia } from "pinia";


import App from "./vue/controllers/App"; //Componente Principal en donde estarán todos los hijos.
import App2 from "./vue/controllers/App2";
import App3 from "./vue/controllers/App3";
import App4 from "./vue/controllers/App4";
// import App2 from "./vue/controllers/App2"; //Ver componente de Listar productos
// import App3 from "./vue/controllers/carrito"; //Ver componente de Listar productos
// import app from "./vue/controllers/App";
import PopupCarrito from "./vue/controllers/components/Btn_PopupCarrito";
import Tarjetas_VistaGeneral from "./vue/controllers/components/Tarjetas_VistaGeneral";
import Ofertas_Index from "./vue/controllers/components/Ofertas_Index";
import carrito_vacio from "./vue/controllers/components/carrito_vacio";
import carrito from "./vue/controllers/components/carrito";


import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { faCartShopping, faAngleDown, faAngleUp, faTrash} from '@fortawesome/free-solid-svg-icons';
library.add(faCartShopping, faAngleDown, faAngleUp, faTrash);



const pinia = createPinia();


const app = createApp(App);
const app2 = createApp(App2); //Ver componentes de Listar productos
const app3 = createApp(App3); 
const app4 = createApp(App4); 

const popup_carrito = createApp(PopupCarrito); 
const TarjetasProductos = createApp(Tarjetas_VistaGeneral);
const TarjetasOfertas = createApp(Ofertas_Index);
const Carrito_vacio = createApp(carrito_vacio);
const Carrito = createApp(carrito);

app.use(pinia);
app.mount('#app');

app2.use(pinia);
app2.mount('#app2');

app3.use(pinia);
app3.mount('#app3');


app4.use(pinia);
app4.mount('#app4');

popup_carrito.use(pinia);
popup_carrito.component('font-awesome-icon', FontAwesomeIcon);
popup_carrito.mount('#popup_carrito');

TarjetasProductos.use(pinia);
TarjetasProductos.component('font-awesome-icon', FontAwesomeIcon);
TarjetasProductos.mount('#TarjetasProductos');

TarjetasOfertas.use(pinia);
TarjetasOfertas.component('font-awesome-icon', FontAwesomeIcon);
TarjetasOfertas.mount('#TarjetasOfertas');

Carrito_vacio.use(pinia);
Carrito_vacio.mount('#carrito_vacio');

Carrito.use(pinia);
Carrito.component('font-awesome-icon', FontAwesomeIcon);
Carrito.mount('#carrito');

const $ = require('jquery');
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('bootstrap');

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
});

registerVueControllerComponents(require.context('./vue/controllers', true, /\.vue$/));
