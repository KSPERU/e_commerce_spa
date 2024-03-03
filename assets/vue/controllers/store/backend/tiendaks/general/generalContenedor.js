import axios from "axios";
import { defineStore } from 'pinia';

export const useGeneralContenedor = defineStore('generalContenedor', {
    state: () => ({
      datos_de_acceso: [],
      productos: []
    }),
    getters: {
      DATOSDEACCESO(state) {return state.datos_de_acceso},
      PRODUCTOS(state) {return state.productos}
    },
    actions: {
      async getDatosDeAcceso(datos) {
        try {
            const response = await axios.post('/api/general/acceder/general', datos);
            this.datos_de_acceso = response.data;
        } catch (error) {
            console.log("Un error" + error.response.data)
        }
      },
      async getVerProductoTarjetario(datos) {
        try {
            const response = await axios.post('/api/producto/listar/producto/concriterios', datos);
            this.productos = response.data;
        } catch (error) {
            console.log("Un error" + error.response.data);
        }
      }
    },
  });