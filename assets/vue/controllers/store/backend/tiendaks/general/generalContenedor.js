import axios from "axios";
import { defineStore } from 'pinia';

export const useGeneralContenedor = defineStore('generalContenedor', {
    state: () => ({
      datos_de_acceso: [],
    }),
    getters: {
      DATOSDEACCESO(state) {return state.datos_de_acceso},
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
    },
  });