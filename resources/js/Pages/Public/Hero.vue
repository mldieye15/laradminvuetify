<template >
    <!-- On peut changer v-container en div pour que l'image prend toute la page; hide-delimiters: pour enlever les poiint en bas; cycle: pour faire dérouler automatiquement -->
    <v-container class="heroBlock" >
        <v-carousel hide-delimiters cycle>
            <v-carousel-item
                v-for="(item,i) in items"
                :key="i"
                :src="item.src"
                reverse-transition="fade-transition"
                transition="fade-transition"
            >
                <!-- Titre enlevé par faute de
                    <v-row
                    class="fill-height"
                    align="center"
                    justify="center"
                >
                    <div class="text-h2">
                        {{ item.title }}
                    </div>
                </v-row>-->
            </v-carousel-item>
        </v-carousel>
    </v-container>
</template>

<script>

export default {
    name: 'Hero',
    components:{},
    data: () => ({
        items: [
            {
                src: require('../../../images/01/maison2.jpg'),
                title: "Inauguration maison du basket",
            },
            {
                src: require('../../../images/01/basket-milano-dove.jpg'),
                title: "The new Basket Statidum",
            },
            {
                src: require('../../../images/01/mauritania.jpg'),
                title: "We love",
            },
        ],
    }),
}
</script>
