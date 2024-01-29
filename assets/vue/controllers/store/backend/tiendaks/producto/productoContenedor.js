import axios from "axios";
import { defineStore } from 'pinia';

export const useProductoContenedor = defineStore('productoContenedor', {
    state: () => ({
      productos: [],
    }),
    getters: {
      PRODUCTOS(state) {return state.productos},
    },
    actions: {
      async getListarProductoConCriterios(datos) {
        try {
            const response = await axios.post('/api/producto/listar/producto/concriterios', datos);
            this.productos = response.data;
        } catch (error) {
            console.log("Un error" + error.response.data)
        }
      },
    },
  });