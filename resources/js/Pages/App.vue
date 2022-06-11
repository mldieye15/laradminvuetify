<template >
    <AppLayout>
       <v-main class="ma-4">
           <h2 class="text-center">Welcome,<span v-if="$page.props.user.name">{{ $page.props.user.name }}</span></h2>
       </v-main>
    </AppLayout>
</template>

<script>
import AppLayout from './Layouts/App/AppLayout.vue';
export default {
    name: 'App',
    components:{
        AppLayout
    },
    data: () => ({

    }),
}
</script>
