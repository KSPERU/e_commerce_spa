import axios from "axios";
import { defineStore } from 'pinia';

export const useInicioContenedor = defineStore('inicioContenedor', {
    state: () => ({
      productos: [],
      productos_ofertados: []
    }),
    getters: {
      PRODUCTOS(state) {return state.productos},
      PRODUCTOSOFERTADOS(state) {return state.productos_ofertados}
    },
    actions: {
      async getVerProductoListado(datos) {
        try {
            const response = await axios.post('/api/producto/listar/producto/concriterios', datos);
            this.productos = response.data;
        } catch (error) {
            console.log("Un error" + error.response.data)
        }
      },
      async getVerProductoListadoOfertados(datos) {
        try {
            const response = await axios.post('/api/producto/listar/producto/concriterios', datos);
            this.productos_ofertados = response.data;
        } catch (error) {
            console.log("Un error" + error.response.data)
        }
      },
    },
  });