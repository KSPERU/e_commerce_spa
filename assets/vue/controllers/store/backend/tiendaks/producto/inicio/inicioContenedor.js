import axios from "axios";
import { defineStore } from 'pinia';

export const useInicioContenedor = defineStore('inicioContenedor', {
    state: () => ({
      categorias: [],
      productos_limitado_a_cuatro: [],
      productos_ofertas_limitado_a_cuatro: [],
      categorias_limitado_a_cinco: [],
      categorias_mas_valoradas: [],
    }),
    getters: {
      CATEGORIAS(state) {return state.categorias},
      PRODUCTOSLIMITADOACUATRO(state) {return state.productos_limitado_a_cuatro},
      PRODUCTOSOFERTASLIMITADOACUATRO(state) {return state.productos_ofertas_limitado_a_cuatro},
      CATEGORIASLIMITADOACINCO(state) {return state.categorias_limitado_a_cinco},
      CATEGORIASMASVALORADAS(state) {return state.categorias_mas_valoradas},
    },
    actions: {
      async getListarProductoListarCategoria() {
        try {
            const response = await axios.post('/api/producto/listar/producto/listadocategorias');
            this.categorias = response.data;
        } catch (error) {
            console.log("Un error " + error.response.data)
        }
      },
      async getListarProductoLimitadoACuatro(datos) {
        try {
            const response = await axios.post('/api/producto/listar/producto/concriterios', datos);
            this.productos_limitado_a_cuatro = response.data;
        } catch (error) {
            console.log("Un error" + error.response.data)
        }
      },
      async getListarProductoOfertaLimitadoACuatro(datos) {
        try {
            const response = await axios.post('/api/producto/listar/producto/concriterios', datos);
            this.productos_ofertas_limitado_a_cuatro = response.data;
        } catch (error) {
            console.log("Un error" + error.response.data)
        }
      },
      async getListarProductoListarCategoriaLimitadoACinco(datos) {
        try {
            const response = await axios.post('/api/producto/listar/producto/listadocategorias', datos);
            this.categorias_limitado_a_cinco = response.data;
        } catch (error) {
            console.log("Un error " + error.response.data)
        }
      },
      async getListarProductoListarCategoriaMasValorada(datos) {
        try {
            const response = await axios.post('/api/producto/listar/producto/listadocategorias', datos);
            this.categorias_mas_valoradas = response.data;
        } catch (error) {
            console.log("Un error " + error.response.data)
        }
      },
    },
  });