<template>
    <div class="contenedor-general">
        <div class="sidebar"><Sidebar /></div>
        <div class="container-body">
            <router-view></router-view>
        </div>
    </div>
</template>

<script>
import Sidebar from './Sidebar.vue'
    export default {
        name: 'MainPage',
        components: {
             Sidebar
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

<style lang="scss" scoped>
 @import url('https://fonts.googleapis.com/css?family=Anton');
@import url('https://use.fontawesome.com/releases/v5.8.2/css/all.css');

.sidebar {
    position: relative;
}

.contenedor-general {
    width: 100vw;
    display: grid;
    grid-template-columns: 70px auto;
}

.sidebar {
    width: 70px;
    height: calc(100vh - 10px);
}

.container-body {
    display: flex;
    justify-content: center;
}

</style>
