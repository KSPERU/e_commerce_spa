import axios from "axios";
import { defineStore } from 'pinia';

export const useArticuloContenedor = defineStore('articuloContenedor', {
    state: () => ({
      producto: [],
      productos_vendedor: []
    }),
    getters: {
      PRODUCTO(state) {return state.producto},
      PRODUCTOSVENDEDOR(state) {return state.productos_vendedor}
    },
    actions: {
      async getVerProductoPorId(datos) {
        try {
            const response = await axios.post('/api/producto/listar/producto/concriterios', datos);
            this.producto = response.data;
        } catch (error) {
            console.log("Un error" + error.response.data);
        }
      },
      async getVerProductoListadoVendedorPopulares(datos) {
        try {
            const response = await axios.post('/api/producto/listar/producto/concriterios', datos);
            this.productos_vendedor = response.data;
        } catch (error) {
            console.log("Un error" + error.response.data);
        }
      }
    },
  });