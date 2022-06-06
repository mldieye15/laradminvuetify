<template >
    <v-app>
        <Header/>
            <slot></slot>
        <Footer />
    </v-app>
</template>

<script>
import Header from './Header.vue';
import Footer from './Footer.vue';

export default {
    name: 'AppLayout',
    components:{
        Header,
        Footer
    },
    data: () => ({

    }),
}
</script>
