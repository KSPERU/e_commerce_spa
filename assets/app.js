import { registerVueControllerComponents } from '@symfony/ux-vue';
import './styles/app.scss';
import './bootstrap.js';
import './bootstrap';

import { createApp } from "vue";
import { createPinia } from "pinia";

import App2 from "./vue/controllers/App2";

import Appcarrito from "./vue/controllers/carrito"; 

import Approducto from "./vue/controllers/producto"; 

const pinia = createPinia();

const app2 = createApp(App2); 
const appcarrito = createApp(Appcarrito); 
const approducto = createApp(Approducto); 

app2.use(pinia);
app2.mount('#app2');

appcarrito.use(pinia);
appcarrito.mount('#appcarrito');

approducto.use(pinia);
approducto.mount('#approducto');

const $ = require('jquery');
require('bootstrap');

$(document).ready(function() {
    $('[data-toggle="popover"]').popover();
});

registerVueControllerComponents(require.context('./vue/controllers', true, /\.vue$/));
