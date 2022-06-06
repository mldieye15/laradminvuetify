<template >
    <SiteLayout>
       <v-content>
           <Hero/>
           <Galery/>
           <LatestPost/>
       </v-content>
    </SiteLayout>
</template>

<script>
import SiteLayout from './Layouts/Public/SiteLayout.vue';
import Hero from './Public/Hero.vue'
import Galery from './Public/Galery.vue'
import LatestPost from './Public/LatestPost.vue'

export default {
    name: 'Welcome',
    components:{
        SiteLayout,
        Hero,
        Galery,
        LatestPost,
    },
    data: () => ({

    }),
}
</script>
