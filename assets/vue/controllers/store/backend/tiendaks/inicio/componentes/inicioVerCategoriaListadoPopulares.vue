<template>
    <div class="row align-items-start bg-white justify-content-center">
            <div v-for="categoria in categorias_populares" :key="categoria.ct_nombre" class="col-2 d-grid justify-content-center align-content-center p-5 categorias-populares">
                <a :href="'/producto/catalogo?categoria=' + categoria.ct_nombre" class="text-decoration-none text-black">
                    <div class="col-12">
                        <font-awesome-icon id="my-icon-popular" :icon="obtenerIcono(categoria.ct_nombre)"  class="mx-auto d-block" />
                    </div>
                    <div class="col-12">
                        <p class="text-categoria-populares fw-normal text-center mt-3">{{ categoria.ct_nombre.charAt(0).toUpperCase() + categoria.ct_nombre.slice(1) }}</p>
                    </div>
                </a>
            </div>
            <div v-for="categoria in categorias_populares" :key="categoria.ct_nombre" class="col-2 d-grid justify-content-center align-content-center p-5 categorias-populares">
                <a :href="'/producto/catalogo?categoria=' + categoria.ct_nombre" class="text-decoration-none text-black">
                    <div class="col-12">
                        <font-awesome-icon id="my-icon-popular" :icon="obtenerIcono(categoria.ct_nombre)" class="mx-auto d-block" />
                    </div>
                    <div class="col-12">
                        <p class="text-categoria-populares fw-normal text-center mt-3">{{ categoria.ct_nombre.charAt(0).toUpperCase() + categoria.ct_nombre.slice(1) }}</p>
                    </div>
                </a>
            </div>
    </div>
</template>
<script setup>
    import { onMounted, computed } from "vue";
    import { useInicioContenedor } from '../../inicio/inicioContenedor';
    import { library } from '@fortawesome/fontawesome-svg-core';
    import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
    import { faCartShopping, faAngleDown, faAngleUp, faTrash, faEnvelope, faPhoneSquare, faAngleRight, faFilter, faMobileScreen,faTv,faHeadphones,faKeyboard,faTabletAlt,faLaptop,faMoneyBillWave,faStar,faEye ,faCreditCard, faCity, faMobile, faMoneyBill} from '@fortawesome/free-solid-svg-icons';

    library.add(faCartShopping, faAngleDown, faAngleUp, faTrash, faEnvelope, faPhoneSquare, faAngleRight, faFilter,faMobileScreen,faTv,faHeadphones,faKeyboard,faTabletAlt,faLaptop,faMoneyBillWave,faStar,faEye,faCreditCard, faCity, faMobile, faMoneyBill);

    const inicioContenedor = useInicioContenedor();

    const icons = [
        'tv', 'mobile-screen', 'headphones', 'keyboard', 'tablet-alt', 'laptop'
    ];

    const categorias_populares = computed(() => {
        return inicioContenedor.CATEGORIASPOPULARES
    });

    const obtenerIcono = categoria => {
        const nombre = categoria.toLowerCase();

        const match = icons.find(icon => {
            const palabra = icon.toLowerCase();
            return palabra.includes(nombre.substring(0, 3)); 
        })

        return match || icons[Math.floor(Math.random() * icons.length)];
    }

    onMounted(() => {
        inicioContenedor.getVerCategoriaListadoPopulares(
            {
                "optionsOrdenCatList": {
                    "posicion_inicial": 1,
                    "cantidad_categorias": 6,
                    "valoracion": {
                        "direccion": "descendente"
                    }
                }
            }
        )
    });
</script>
<style scoped>
    #my-icon-popular {
        color: #3483fa;
        height: 45px;
    }

    .categorias-populares:hover {
        background-color: rgb(6, 64, 175);
        z-index: 1;
        transition: background-color 300ms ease-out;
    }

    .categorias-populares:hover p {
        color: #fff;
    }

    .categorias-populares:hover #my-icon-popular {
        color: #fff;
    }
</style>