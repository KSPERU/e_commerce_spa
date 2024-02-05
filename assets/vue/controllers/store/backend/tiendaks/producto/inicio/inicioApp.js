import { createApp } from "vue";
import { createPinia } from "pinia";

const pinia = createPinia();

import inicioProductoListarCategoria from "./componentes/inicioProductoListarCategoria/inicioProductoListarCategoria"; 
const inicio_producto_listar_categoria = createApp(inicioProductoListarCategoria); 
inicio_producto_listar_categoria.use(pinia);
inicio_producto_listar_categoria.mount('#inicio_producto_listar_categoria');

import inicioProductoListarProductoLimitadoACuatro from "./componentes/inicioProductoListarProductoLimitadoACuatro/inicioProductoListarProductoLimitadoACuatro"; 
const inicio_producto_listar_producto_limitado_a_cuatro = createApp(inicioProductoListarProductoLimitadoACuatro); 
inicio_producto_listar_producto_limitado_a_cuatro.use(pinia);
inicio_producto_listar_producto_limitado_a_cuatro.mount('#inicio_producto_listar_producto_limitado_a_cuatro');

import inicioProductoListarProductoOfertaLimitadoACuatro from "./componentes/inicioProductoListarProductoOfertaLimitadoACuatro/inicioProductoListarProductoOfertaLimitadoACuatro"; 
const inicio_producto_listar_producto_oferta_limitado_a_cuatro = createApp(inicioProductoListarProductoOfertaLimitadoACuatro); 
inicio_producto_listar_producto_oferta_limitado_a_cuatro.use(pinia);
inicio_producto_listar_producto_oferta_limitado_a_cuatro.mount('#inicio_producto_listar_producto_oferta_limitado_a_cuatro');

import inicioProductoListarCategoriaLimitadoACinco from "./componentes/inicioProductoListarCategoriaLimitadoACinco/inicioProductoListarCategoriaLimitadoACinco"; 
const inicio_producto_listar_categoria_limitado_a_cinco = createApp(inicioProductoListarCategoriaLimitadoACinco); 
inicio_producto_listar_categoria_limitado_a_cinco.use(pinia);
inicio_producto_listar_categoria_limitado_a_cinco.mount('#inicio_producto_listar_categoria_limitado_a_cinco');

import inicioProductoListarCategoriaMasValorada from "./componentes/inicioProductoListarCategoriaMasValorada/inicioProductoListarCategoriaMasValorada"; 
const inicio_producto_listar_categoria_mas_valorada= createApp(inicioProductoListarCategoriaMasValorada); 
inicio_producto_listar_categoria_mas_valorada.use(pinia);
inicio_producto_listar_categoria_mas_valorada.mount('#inicio_producto_listar_categoria_mas_valorada');


