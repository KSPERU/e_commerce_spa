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
import PopupCarrito from "./vue/controllers/components/popup-carrito/Btn_PopupCarrito";
import carrito_vacio from "./vue/controllers/components/carrito_vacio";
import carrito from "./vue/controllers/components/carrito";
import checkout from "./vue/controllers/components/checkout.vue"


// Grupo Index - Usuario
import Tarjetas_VistaGeneral from "./vue/controllers/components/index-usuario/Tarjetas_VistaGeneral";
import Tarjetas_Ofertas from "./vue/controllers/components/index-usuario/Tarjetas_Ofertas";
import Categorias_Populares from "./vue/controllers/components/index-usuario/Categorias_Populares";
 /// Fin

// Menu - Perfil Usuario Settings
import Menu from './vue/controllers/components/perfil-usuario-settings/Menu'
// Fin

import Productos_Categoria_Main from "./vue/controllers/components/productos-categoria/Main";
import Perfil_Usuario_Main from "./vue/controllers/components/perfil-usuario/Main";


import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';

import { faCartShopping, faAngleDown, faAngleUp, faTrash, faEnvelope, faPhoneSquare, faAngleRight, faFilter, faMobileScreen,faTv,faHeadphones,faKeyboard,faTabletAlt,faLaptop,faMoneyBillWave,faStar,faEye ,faCreditCard, faCity, faMobile, faMoneyBill} from '@fortawesome/free-solid-svg-icons';
library.add(faCartShopping, faAngleDown, faAngleUp, faTrash, faEnvelope, faPhoneSquare, faAngleRight, faFilter,faMobileScreen,faTv,faHeadphones,faKeyboard,faTabletAlt,faLaptop,faMoneyBillWave,faStar,faEye,faCreditCard, faCity, faMobile, faMoneyBill);


const pinia = createPinia();


const app = createApp(App);
const app2 = createApp(App2); //Ver componentes de Listar productos
const app3 = createApp(App3); 
const app4 = createApp(App4); 

const popup_carrito = createApp(PopupCarrito); 

const TarjetasProductos = createApp(Tarjetas_VistaGeneral);
const TarjetasOfertas = createApp(Tarjetas_Ofertas);
const CategoriasPopulares = createApp(Categorias_Populares);  

const Carrito_vacio = createApp(carrito_vacio);
const Carrito = createApp(carrito);
const Checkout = createApp(checkout)

const productos_categoria = createApp(Productos_Categoria_Main );
const perfil_usuario = createApp(Perfil_Usuario_Main);

const menu_perfil_usuario_settings = createApp(Menu);


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

CategoriasPopulares.use(pinia);
CategoriasPopulares.component('font-awesome-icon', FontAwesomeIcon);
CategoriasPopulares.mount('#CategoriasPopulares');

Carrito_vacio.use(pinia);
Carrito_vacio.mount('#carrito_vacio');

Carrito.use(pinia);
Carrito.component('font-awesome-icon', FontAwesomeIcon);
Carrito.mount('#carrito');

Checkout.use(pinia);
Checkout.component('font-awesome-icon', FontAwesomeIcon);
Checkout.mount('#checkout');

perfil_usuario.use(pinia);
perfil_usuario.component('font-awesome-icon', FontAwesomeIcon);
perfil_usuario.mount('#perfil_usuario');

productos_categoria.use(pinia);
productos_categoria.component('font-awesome-icon', FontAwesomeIcon);
productos_categoria.mount('#productos_categoria');

menu_perfil_usuario_settings.use(pinia);
menu_perfil_usuario_settings.component('font-awesome-icon', FontAwesomeIcon);
menu_perfil_usuario_settings.mount('#menu_perfil_usuario_settings');


const $ = require('jquery');
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('bootstrap');

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
});

registerVueControllerComponents(require.context('./vue/controllers', true, /\.vue$/));
