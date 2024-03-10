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
      async agregarProducto(producto) {
        try {
            const response = await axios.post('/api/producto/api/productos', producto);
            // Después de agregar el producto, actualizar la lista de productos
            console.log("Producto agregado:", response.data);
        } catch (error) {
            console.error('Error al agregar producto:', error);
        }
      },
    },
  });