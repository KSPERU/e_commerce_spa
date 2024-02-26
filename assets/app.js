import './styles/app.scss';
import './bootstrap.js';
import './bootstrap';

import { registerVueControllerComponents } from '@symfony/ux-vue';
import { createApp } from "vue";
import { createPinia } from "pinia";
import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { faCartShopping, faAngleDown, faAngleUp, faTrash, faEnvelope, faPhoneSquare, faAngleRight, faFilter, faMobileScreen,faTv,faHeadphones,faKeyboard,faTabletAlt,faLaptop,faMoneyBillWave,faStar,faEye ,faCreditCard, faCity, faMobile, faMoneyBill} from '@fortawesome/free-solid-svg-icons';

import PopupCarrito from "./vue/controllers/components/popup-carrito/Btn_PopupCarrito";
import carrito_vacio from "./vue/controllers/components/carrito_vacio";
import carrito from "./vue/controllers/components/CarritoApp";
import checkout from "./vue/controllers/components/checkout.vue"
import Tarjetas_VistaGeneral from "./vue/controllers/components/index-usuario/Tarjetas_VistaGeneral";
import Tarjetas_Ofertas from "./vue/controllers/components/index-usuario/Tarjetas_Ofertas";
import Categorias_Populares from "./vue/controllers/components/index-usuario/Categorias_Populares";
import Card_PerfilUsuario from "./vue/controllers/components/perfil-usuario/Card_PerfilUsuario";
import Btns_Config from "./vue/controllers/components/perfil-usuario/Btns_Config";
import Card_Component from "./vue/controllers/components/Card_Component";
import Head_ProductosVenta from "./vue/controllers/components/perfil-usuario/Head_ProductosVenta";
import Card_FiltrosAvanzados from "./vue/controllers/components/perfil-usuario/Card_FiltrosAvanzados";
import productoApp from "./vue/controllers/store/backend/tiendaks/producto/productoApp";
import comprasApp from "./vue/controllers/store/backend/tiendaks/compras/comprasApp";
import './vue/controllers/store/backend/tiendaks/producto/inicio/inicioApp.js';
import './vue/controllers/store/backend/tiendaks/producto/producto_por_categoria/productoPorCategoriaApp.js';
import './vue/controllers/store/backend/tiendaks/producto/ver_producto/verProductoApp.js';
import './vue/controllers/store/backend/tiendaks/general/generalApp.js';
import './vue/controllers/store/backend/tiendaks/inicio/inicioApp.js';

const $ = require('jquery');
require('bootstrap');

registerVueControllerComponents(require.context('./vue/controllers', true, /\.vue$/));
library.add(faCartShopping, faAngleDown, faAngleUp, faTrash, faEnvelope, faPhoneSquare, faAngleRight, faFilter,faMobileScreen,faTv,faHeadphones,faKeyboard,faTabletAlt,faLaptop,faMoneyBillWave,faStar,faEye,faCreditCard, faCity, faMobile, faMoneyBill);

const pinia = createPinia();

//const app2 = createApp(App2); 
const appcarrito = createApp(Appcarrito); 
const approducto = createApp(Approducto); 

// const app = createApp(App);
// const app2 = createApp(App2); //Ver componentes de Listar productos
// const app3 = createApp(App3); 
// const app4 = createApp(App4); 

const popup_carrito = createApp(PopupCarrito); 
const TarjetasProductos = createApp(Tarjetas_VistaGeneral);
const TarjetasOfertas = createApp(Tarjetas_Ofertas);
const CategoriasPopulares = createApp(Categorias_Populares);  
const Carrito_vacio = createApp(carrito_vacio);
const Carrito = createApp(carrito);
const Checkout = createApp(checkout);
const card_perfil_usuario = createApp(Card_PerfilUsuario);
const btns_config_perfil_usuario = createApp(Btns_Config);
const card_component = createApp(Card_Component);
const head_productos_venta = createApp(Head_ProductosVenta);
const card_filtros_avanzados = createApp(Card_FiltrosAvanzados);
const producto_app = createApp(productoApp);
const compras_app = createApp(comprasApp);

producto_app.use(pinia);
producto_app.mount('#producto_app');
const card_filtros_avanzados = createApp(Card_FiltrosAvanzados)

appcarrito.use(pinia);
appcarrito.mount('#appcarrito');
approducto.use(pinia);
approducto.mount('#approducto');

// import Appcarritoglobal from "./vue/controllers/store/backend/tiendaks/carrito/mostrarVistaCarrito"; 

// const appcarritoglobal = createApp(Appcarritoglobal); 
// appcarritoglobal.use(pinia);
// appcarritoglobal.mount('#appcarritoMostrarVistaCarrito');

// import productoApp from "./vue/controllers/store/backend/tiendaks/producto/productoApp";
// const producto_app = createApp(productoApp);
// producto_app.use(pinia);
// producto_app.mount('#producto_app');

compras_app.use(pinia);
compras_app.mount('#compras_app');

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

card_perfil_usuario.use(pinia);
card_perfil_usuario.component('font-awesome-icon', FontAwesomeIcon);
card_perfil_usuario.mount('#card_perfil_usuario');

btns_config_perfil_usuario.use(pinia);
btns_config_perfil_usuario.component('font-awesome-icon', FontAwesomeIcon);
btns_config_perfil_usuario.mount('#btns_config_perfil_usuario');

card_component.use(pinia);
card_component.mount("#card_component");

head_productos_venta.use(pinia);
head_productos_venta.component('font-awesome-icon', FontAwesomeIcon);
head_productos_venta.mount('#head_productos_venta');

card_filtros_avanzados.use(pinia);
card_filtros_avanzados.component('font-awesome-icon', FontAwesomeIcon);
card_filtros_avanzados.mount('#card_filtros_avanzados')

