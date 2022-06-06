<template >
    <!-- On peut changer v-container en div pour que l'image prend toute la page; hide-delimiters: pour enlever les poiint en bas; cycle: pour faire dérouler automatiquement -->
    <div class="block galleryBlock">
    <v-container>
      <h2 class="text-center">Gallery</h2>
      <v-row>
        <v-col v-for="item in items" :key="item.id" class="d-flex child-flex" cols="6" sm="4">
          <v-card flat tile class="d-flex">
            <v-img :src="item.src" aspect-ratio="1" class="grey lighten-2">
              <template v-slot:placeholder>
                <v-row class="fill-height ma-0" align="center" justify="center">
                  <v-progress-circular indeterminate color="grey lighten-5"></v-progress-circular>
                </v-row>
              </template>
            </v-img>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>

export default {
    name: 'Galery',
    components:{},
    data: () => ({
        items: [
            {
                id: 1,
                src: require('../../../images/01/basket-sport.jpg'),
            },
            {
                id: 2,
                src: require('../../../images/01/basket.png'),
            },
            {
                id: 3,
                src: require('../../../images/01/images.png'),
            },
            {
                id: 4,
                src: require('../../../images/01/images.jpg'),
            },
            {
                id: 5,
                src: require('../../../images/01/Ec_N2pYWAAMqBGR-455x300.jpg'),
            },
            {
                id: 6,
                src: require('../../../images/01/fed_mauritanienne_de_basket-ball.png'),
            },
            {
                id: 7,
                src: require('../../../images/01/2193314-45823610-2560-1440.jpg'),
            },
            {
                id: 8,
                src: require('../../../images/01/maison2.jpg'),
            },
            {
                id: 9,
                src: require('../../../images/01/basket-milano-dove.jpg'),
            },
        ],
    }),
}
</script>
