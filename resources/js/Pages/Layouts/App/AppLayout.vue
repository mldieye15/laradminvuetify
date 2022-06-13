<template >
    <v-app>
        <Header/>
            <v-main class="ma-4">
                <!-- icon="mdi-twitter" -->
                <!--<v-alert v-if="$page.props.flash.message" v-model="alert" dismissible color="primary" border="left" elevation="2" colored-border>
                    {{ $page.props.flash.message }}
                </v-alert>
                <v-alert v-if="$page.props.errors.message" v-model="alert" dismissible color="red" border="left" elevation="2" colored-border>
                    {{ $page.props.errors.message }}
                </v-alert>
                 <v-alert v-if="$page.props.flash.message" type="info" >
                    {{ $page.props.flash.message }}
                </v-alert> -->
                <slot></slot>
            </v-main>
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
    //data: () => ({}),
    data () {
      return {
        alert: true,
      }
    },
}
</script>
