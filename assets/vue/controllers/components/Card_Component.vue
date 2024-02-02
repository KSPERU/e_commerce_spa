<template>
    <div class="row row-cols-2 row-cols-md-3 p-1">
        <div v-for="product in products" :key="product.id" class="p-1 p-sm-2">
            <div class="card p-2">
                <img :src="product.img" class="card-img-top" :alt="'producto-' + product.id" />
                <div class="card-body pt-4">
                    <div class="row g-2">
                        <div class="d-flex justify-content-start align-items-end">
                            <span class="size-18 fw-semibold">S/. {{ product.price }}</span>
                            <span class="size-15 text-decoration-line-through fw-normal text-body-secondary ms-0 ms-md-3">
                                S/. {{ product.price + product.desc }}</span>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-6" :class="{ VistaMovil: mostrarOferta }">
                            <span class="size-14 badge bg-dark text-wrap">{{
                                mostrarOferta ? "Oferta" : "Ahorras"
                            }}</span>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-6 d-none d-lg-inline d-md-inline">
                            <span class="size-14 fw-normal text-start">S/. {{ product.desc }}</span>
                        </div>
                        <div class="col-lg-12 col-md-12 col-12">
                            <p class="size-14 custom-truncate m-0">{{ product.name }}</p>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <span v-for="i in product.score" :key="i" class="fa fa-star checked ms-1"></span>
                            <span v-for="j in (5 - product.score)" :key="j" class="fa fa-star ms-1"
                                style="color: #d9d9d9"></span>
                            <span class="ms-2 text-body-secondary d-lg-inline d-md-inline d-none">
                                {{ product.votes }}
                            </span>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <p class="size-14">
                                <span class="fw-bold">{{ product.send }}</span>, llega
                                <span class="fw-bold">en {{ product.send_days }}+ dias</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
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
export default {
    data() {
        return {
            mostrarOferta: window.innerWidth < 426.8,
            products: [
                { id: 1, name: 'Shark IQ Robot Self-Empty XL Vacuum with Self-Empty Base, Home Mapping, RV1002AE, New Shark IQ Robot Self-Empty XL Vacuum with Self-Empty Base, Home Mapping, RV1002AE, New', price: 300.00, desc: 0.00, score: 3, votes: 20, send: 'Envío gratis', send_days: 3, img: '../img/tiendaks/producto/producto-prueba.png' },
                { id: 1, name: 'Shark IQ Robot Self-Empty XL Vacuum with Self-Empty Base, Home Mapping, RV1002AE, New Shark IQ Robot Self-Empty XL Vacuum with Self-Empty Base, Home Mapping, RV1002AE, New', price: 300.00, desc: 50.00, score: 3, votes: 20, send: 'Envío gratis', send_days: 3, img: '../img/tiendaks/producto/producto-prueba.png' },
                { id: 1, name: 'Shark IQ Robot Self-Empty XL Vacuum with Self-Empty Base, Home Mapping, RV1002AE, New Shark IQ Robot Self-Empty XL Vacuum with Self-Empty Base, Home Mapping, RV1002AE, New', price: 300.00, desc: 50.00, score: 3, votes: 20, send: 'Envío gratis', send_days: 3, img: '../img/tiendaks/producto/producto-prueba.png' },
                { id: 1, name: 'Shark IQ Robot Self-Empty XL Vacuum with Self-Empty Base, Home Mapping, RV1002AE, New Shark IQ Robot Self-Empty XL Vacuum with Self-Empty Base, Home Mapping, RV1002AE, New', price: 300.00, desc: 50.00, score: 3, votes: 20, send: 'Envío gratis', send_days: 3, img: '../img/tiendaks/producto/producto-prueba.png' },
                { id: 1, name: 'Shark IQ Robot Self-Empty XL Vacuum with Self-Empty Base, Home Mapping, RV1002AE, New Shark IQ Robot Self-Empty XL Vacuum with Self-Empty Base, Home Mapping, RV1002AE, New', price: 300.00, desc: 50.00, score: 3, votes: 20, send: 'Envío gratis', send_days: 3, img: '../img/tiendaks/producto/producto-prueba.png' },
            ]
        };
    },
    mounted() {
        window.addEventListener("resize", this.actualizarEstado);
    },
    methods: {
        actualizarEstado() {
            this.mostrarOferta = window.innerWidth < 426.8;
        },
    },
    beforeDestroy() {
        window.removeEventListener("resize", this.actualizarEstado);
    },
};
</script>