import axios from "axios";
import { defineStore } from "pinia";
export const useUsuarioContenedor = defineStore('usuarioContenedor', {
    state: () => ({
        idusuario: [],
    }),
    getters: {
        IDUSUARIO(state) {return state.idusuario},
    },
    actions: {
        async obtenerIdUsuarioLogueado() {
            try {
                const response = await axios.get('/api/usuario/obtener/idusuario/logueado');
                this.idusuario = response.data.idusuario;
                console.log('idusuario', this.idusuario)
            } catch (error) {
                alert(error)
                console.log(error.response.data)
            }
    },
        
    },
});