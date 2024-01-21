import axios from "axios";
import { defineStore } from "pinia";
export const carritoStore = defineStore('carrito', {
    state: () => ({
        carrito: [],
        detallesCarrito: [],
        productos: [],
    }),
    getters: {
        CARRITOS(state) {return state.carrito},
        PRODUCTOS(state) {return state.productos},
        DETALLESCARRITOS(state) {return state.detallesCarrito},
    },
    actions: {
        async agregarProducto(id_producto) {  //Los datos se envian como array y no por separado
            try {
                console.log(id_producto);
                const response = await axios.post('/api/carrito/agregar', id_producto);
                this.carrito = response.data.carrito;
                this.detallesCarrito = response.data.detallescarrito;
                console.log('detalle carrito ', this.detallesCarrito)
            } catch (error) {
                alert(error)
                console.log(error.response.data)
            }
    },
        async eliminarProducto(idDetalleCarrito) {
            try {
                console.log(idDetalleCarrito);
                const response = await axios.post('/api/carrito/eliminar', idDetalleCarrito);
                this.carrito = response.data.carrito;
                this.detallesCarrito = response.data.detallescarrito;
            } catch (error) {
                alert(error)
                console.log(error.response.data)
            }
        },
        async modificarProducto(idDetalleCarrito) {
            try {
                console.log(idDetalleCarrito);
                const response = await axios.post('/api/carrito/modificar', idDetalleCarrito);
                if (response.data.success) {
                    this.carrito = response.data.carrito;
                    this.detallesCarrito = response.data.detallescarrito;
                } else {
                    // Alerta del mensaje enviado por la api
                    alert(response.data.message);
                    return { error: response.data.message };
                }
            } catch (error) {
                alert(error)
                console.log(error.response.data)
            }
        },
        async visualizarCarrito() {
            try {
                const response = await axios.get('/api/carrito/visualizar');
                this.carrito = response.data.carrito;
                this.detallesCarrito = response.data.detallescarrito;
                console.log('detalle carrito ', this.detallesCarrito)
                console.log('carrito ', this.carrito)
            } catch (error) {
                alert(error)
                console.log(error.response.data)
            }
        },
        async ListarProducto() {
            try {
                const response = await axios.get('/api/producto/listado');
                this.productos = response.data;
                console.log('producto ', this.productos)
            } catch (error) {
                alert(error)
                console.log(error.response.data)
            }
        },
    },
});