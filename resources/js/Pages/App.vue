<template >
    <AppLayout>
        <Breadcrumbs :breadcrumbs="items"/>
        <h2 class="text-center">Welcome,<span v-if="$page.props.user.name">{{ $page.props.user.name }}</span></h2>

    </AppLayout>
</template>

<script>
import AppLayout from './Layouts/App/AppLayout.vue';
import Breadcrumbs from '../components/Breadcrumbs.vue';
export default {
    name: 'App',
    components:{
    AppLayout,
    Breadcrumbs
},
    data () {
      return {
        items: [
            {
                text: 'Tableau de bord',
                disabled: true,
                route: 'dashboard.index',
            }
        ],
      }
    },
}
</script>
