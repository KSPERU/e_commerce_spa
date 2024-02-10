<template>
    <div class="row row-cols-2 row-cols-md-3 p-2">
        <div v-for="product in products" :key="product.id" class="p-1 p-sm-2">
            <Cards :product="product" />
        </div>
    </div>
</template>

<style scoped>
.carousel-control-prev,
.carousel-control-next {
    width: 5%;
}

.checked {
    color: #000000;
}

.card:hover {
    background-color: rgb(23, 23, 43, 0.2);
    z-index: 1;
    transition: background-color 300ms ease-out;
}

img {
    aspect-ratio: 9 / 9;
}

.card:hover img,
.card:hover span,
.card:hover p {
    opacity: 0.5;
}

.custom-truncate {
    display: -webkit-box;
    -webkit-line-clamp: 4;
    /* Número de líneas que deseas mostrar */
    -webkit-box-orient: vertical;
    overflow: hidden;
}

@media (max-width: 426.8px) {
    img {
        aspect-ratio: 7 / 6;
    }

    .custom-truncate {
        -webkit-line-clamp: 2;
    }
}

.VistaMovil span.text-wrap {
    display: inline;
}
</style>

<script>
import Cards from "../Cards.vue";

export default {
    components: {
        Cards,
    },
    data() {
        return {
            mostrarOferta: window.innerWidth < 426.8,
            products: [
                { id: 1, name: 'Shark IQ Robot Self-Empty XL Vacuum with Self-Empty Base, Home Mapping, RV1002AE, New Shark IQ Robot Self-Empty XL Vacuum with Self-Empty Base, Home Mapping, RV1002AE, New', price: 300.00, desc: 0.00, score: 3, votes: 20, send: 'Envío gratis', send_days: 3, img: '../img/tiendaks/producto/producto-laptop.png' },
                { id: 2, name: 'Shark IQ Robot Self-Empty XL Vacuum with Self-Empty Base, Home Mapping, RV1002AE, New Shark IQ Robot Self-Empty XL Vacuum with Self-Empty Base, Home Mapping, RV1002AE, New', price: 300.00, desc: 50.00, score: 3, votes: 20, send: 'Envío gratis', send_days: 3, img: '../img/tiendaks/producto/producto-laptop.png' },
                { id: 3, name: 'Shark IQ Robot Self-Empty XL Vacuum with Self-Empty Base, Home Mapping, RV1002AE, New Shark IQ Robot Self-Empty XL Vacuum with Self-Empty Base, Home Mapping, RV1002AE, New', price: 300.00, desc: 50.00, score: 3, votes: 20, send: 'Envío gratis', send_days: 3, img: '../img/tiendaks/producto/producto-laptop.png' },
                { id: 4, name: 'Shark IQ Robot Self-Empty XL Vacuum with Self-Empty Base, Home Mapping, RV1002AE, New Shark IQ Robot Self-Empty XL Vacuum with Self-Empty Base, Home Mapping, RV1002AE, New', price: 300.00, desc: 50.00, score: 3, votes: 20, send: 'Envío gratis', send_days: 3, img: '../img/tiendaks/producto/producto-laptop.png' },
            ]
        };
    },
};
</script>