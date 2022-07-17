<template>
    <div>
        <v-avatar size="100">
            <img :src="logo" alt="FB BRIM">  
        </v-avatar>
        Fédération BasketBall Mauritanien
    </div>
</template>

<script>
export default {
    name: 'LogoFederation',
    props:  ['breadcrumbs'],
    data() {
        return {
            drawer: true,
            logo: require('../../images/logo-fed.jpg'),
        }
    },
    computed: {
        last(){
            return Object.keys(this.breadcrumbs).length-1;
        }
    }
}
</script>

<style scoped>
    ul {
        display: inline-block;
    }
    li{
        margin-right: -25px !important;
    }
</style>
