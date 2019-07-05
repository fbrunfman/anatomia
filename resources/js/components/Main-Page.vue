<template>
    <div>
        <div class="sidebar"><Sidebar /></div>
        <div class="container col-7">
            <div class="main-content">
                <div class="">
                    <div class="card">
                        <div class="card-header">Example Component</div>
                        <div class="card-body">
                        <b-container class="bv-example-row">
                                <b-row>
                                    <b-col>1 of 3</b-col>
                                    <b-col>2 of 3</b-col>
                                    <b-col>3 of 3</b-col>
                                </b-row>
                            </b-container>
                            
                        </div>
                    </div>
                </div>
            </div>
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

</style>
