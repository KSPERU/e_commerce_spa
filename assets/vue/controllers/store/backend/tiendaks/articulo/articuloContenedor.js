import axios from "axios";
import { defineStore } from 'pinia';

export const useArticuloContenedor = defineStore('articuloContenedor', {
    state: () => ({
      producto: [],
    }),
    getters: {
      PRODUCTO(state) {return state.producto},
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
    },
  });