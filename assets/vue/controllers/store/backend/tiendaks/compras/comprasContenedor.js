import axios from "axios";
import { defineStore } from 'pinia';

export const useComprasContenedor = defineStore('comprasContenedor', {
    state: () => ({
      compras: [],
    }),
    getters: {
      COMPRAS(state) {return state.compras},
    },
    actions: {
      async getListarComprasConCriterios(datos) {
        try {
            const response = await axios.post('/api/compras/listar/compras/concriterios', datos);
            this.compras = response.data;
        } catch (error) {
            console.log("Un error" + error.response.data)
        }
      },
    },
  });