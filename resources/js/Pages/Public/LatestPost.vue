<template >
    <!-- On peut changer v-container en div pour que l'image prend toute la page; hide-delimiters: pour enlever les poiint en bas; cycle: pour faire dérouler automatiquement -->
    <v-container class="heroBlock" >
        <h2 class="text-center">Latest Post</h2>
    </v-container>
</template>

<script>

export default {
    name: 'LatestPost',
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
