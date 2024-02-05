import axios from "axios";
import { defineStore } from 'pinia';

export const useVerProductoContenedor = defineStore('verProductoContenedor', {
    state: () => ({
      mostrar_producto_por_id: [],
      listar_producto_por_categoria: [],
    }),
    getters: {
      MOSTRARPRODUCTOPORID(state) {return state.mostrar_producto_por_id},
      LISTARPRODUCTOPORCATEGORIA(state) {return state.listar_producto_por_categoria},
    },
    actions: {
      async getMostrarProductoPorId(datos) {
        try {
            const response = await axios.post('/api/producto/listar/producto/concriterios', datos);
            this.mostrar_producto_por_id = response.data;
        } catch (error) {
            console.log("Un error" + error.response.data)
        }
      },
      async getListarProductosPorCategoria(datos) {
        try {
            const response = await axios.post('/api/producto/listar/producto/concriterios', datos);
            this.listar_producto_por_categoria = response.data;
        } catch (error) {
            console.log("Un error" + error.response.data)
        }
      },
    },
  });