<template >
    <v-app>
        <!--<v-container class="my-auto">
            <v-main>
                <v-row>
                    <v-col>
                        <slot></slot>
                    </v-col>
                </v-row>
            </v-main>
        </v-container>-->
       <v-app-bar
        app
        flat
        color="white"
        max-height="65"
       >
        <Header/>
       </v-app-bar>

       <slot></slot>

       <v-footer>
        <Footer />
        </v-footer>
    </v-app>
</template>

<script>
import Header from './Header.vue';
import Footer from './Footer.vue';

export default {
    name: 'SiteLayout',
    components:{
        Header,
        Footer
    },
    data: () => ({

    }),
}
</script>
