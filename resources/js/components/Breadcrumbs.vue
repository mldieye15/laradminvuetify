<template>
    <div>
        <ul v-for=" (item, index) in breadcrumbs" :key='index'  class="v-breadcrumbs theme--light">
            <li>
                <inertia-link :href="route(`${item.route}`)" :class="item.disabled ? 'v-breadcrumbs__item v-breadcrumbs__item--disabled' : 'v-breadcrumbs__item'">{{item.text}}</inertia-link>
                <!--<span v-if="index != Object.keys(breadcrumbs).length - 1">&nbsp;&nbsp;/</span>-->
                <span v-if="index !== last">&nbsp;&nbsp;/</span>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    name: 'Breadcrumbs',
    props:  ['breadcrumbs'],
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
