import axios from "axios";
import { defineStore } from 'pinia';

export const useProductoPorCategoriaContenedor = defineStore('productoPorCategoriaContenedor', {
    state: () => ({
      produtos_por_categoria: [],
    }),
    getters: {
      PRODUCTOSPORCATEGORIA(state) {return state.produtos_por_categoria},
    },
    actions: {
      async getListarProductoPorCategoria(datos) {
        try {
            const response = await axios.post('/api/producto/listar/producto/concriterios', datos);
            this.produtos_por_categoria = response.data;
        } catch (error) {
            console.log("Un error" + error.response.data)
        }
      },
    },
  });