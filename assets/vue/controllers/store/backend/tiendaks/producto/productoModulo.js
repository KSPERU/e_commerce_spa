import axios from "axios";
import { defineStore } from 'pinia';

export const useProductoModulo = defineStore('productoModulo', {
  state: () => ({
    datos: '',
    listarProductos: [],
    listarProductosPaginados: [],
    listarProductosCategorizados: [],
    listarProductosPrecios: [],
    listarProductosOrdenado: [],
    verProducto: [],
    buscarProducto: [],
    clasificacionProducto: [],
    listadoPorUsuario: [],
  }),
  getters: {
    DATOS(state) {return state.datos}, 
    LISTARPRODUCTOS(state) {return state.listarProductos}, 
    LISTARPRODUCTOSPAGINADOS(state) {return state.listarProductosPaginados}, 
    LISTARPRODUCTOSCATEGORIZADOS(state) {return state.listarProductosCategorizados}, 
    LISTARPRODUCTOSPRECIOS(state) {return state.listarProductosPrecios}, 
    LISTARPRODUCTOSORDENADO(state) {return state.listarProductosOrdenado}, 
    VERPRODUCTO(state) {return state.verProducto}, 
    BUSCARPRODUCTO(state) {return state.buscarProducto}, 
    CLASIFICACIONPRODUCTO(state) {return state.clasificacionProducto}, 
    LISTADOPORUSUARIO(state) {return state.listadoPorUsuario}, 
  },
  actions: {
    actualizarDatos(nuevosDatos) {
        try {
            this.datos = nuevosDatos;
            console.log(nuevosDatos);
        } catch (error) {
            console.log('Error: ' + error.response.datarror);
        }
    },
    async getListarProductos() {
      try {
        const data = await axios.get('/api/producto/listado');
        this.listarProductos = data.data;
      } catch (error) {
        console.log(error);
      }
    },
    async getListarProductosPaginados(pagina, cantidad) {
      try {
        const data = await axios.get('/api/producto/listado/'+ pagina +'/total/'+ cantidad);
        this.listarProductosPaginados = data.data;
      } catch (error) {
        console.log(error);
      }
    },
    async getListarProductosCategorizados(categoria) {
      try {
        const data = await axios.get('/api/producto/listado/'+ categoria);
        this.listarProductosCategorizados = data.data;
      } catch (error) {
        console.log(error);
      }
    },
    async getListarProductosPrecios(inicio, fin) {
      try {
        const data = await axios.get('/api/producto/listado/costo/'+ inicio +'/entre/'+ fin);
        this.listarProductosPrecios = data.data;
      } catch (error) {
        console.log(error);
      }
    },
    async getListarProductosOrdenado(atributo, modo) {
      try {
        const data = await axios.get('/api/producto/listado/'+ atributo +'/ordenado/' + modo);
        this.listarProductosOrdenado = data.data;
      } catch (error) {
        console.log(error);
      }
    },
    async getVerProducto(id) {
      try {
        const data = await axios.get('/api/producto/ver/' + id);
        this.verProducto = data.data;
      } catch (error) {
        console.log(error);
      }
    },
    async getBuscarProducto(busqueda) {
      try {
        const data = await axios.get('/api/producto/buscar/' + busqueda);
        this.buscarProducto = data.data;
      } catch (error) {
        console.log(error);
      }
    },
    async getClasificacionProducto(categoria, atributo, modo, inicio, fin) {
      try {
        const data = await axios.get('/api/producto/listado/'+ categoria +'/por/'+ atributo +'/ordenado/'+ modo +'/de/'+ inicio +'/entre/' + fin);
        this.clasificacionProducto = data.data;
      } catch (error) {
        console.log(error);
      }
    },
    async getListadoPorUsuario(usuario) {
      try {
        const data = await axios.get('/api/producto/listado/usuario/' + usuario);
        this.listadoPorUsuario = data.data;
      } catch (error) {
        console.log(error);
      }
    },
  },
});