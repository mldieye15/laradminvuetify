<template >
    <v-app>
       <v-app-bar
        app
        flat
        color="white"
       >
        <Header/>
       </v-app-bar>
       <v-content>
           <Hero/>
           <Galery/>
           <LatestPost/>
       </v-content>
    </v-app>
</template>

<script>
import Header from './Layouts/Public/Header.vue';
import Hero from './Public/Hero.vue'
import Galery from './Public/Galery.vue'
import LatestPost from './Public/LatestPost.vue'

export default {
    name: 'Welcome',
    components:{
        Header,
        Hero,
        Galery,
        LatestPost
    },
    data: () => ({

    }),
}
</script>
