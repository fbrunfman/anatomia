<template>
    <div id="app" v-bind:class="{'login' : login}">
        <div class="pagina-principal d-flex">
            <div class="main-page"><MainPage></MainPage></div>
        </div>
    </div>
</template>

<script>
import MainPage from './components/Main-Page.vue'

export default {
    name: 'App',
    components: {
    MainPage
  },
  computed: {
    login() {
        return this.$store.state.login
    }
  }
}
</script>

<style lang="scss" scoped>


body {
    margin: 0;
    padding: 0;

  }
  #app {
    font-family: 'Anton', Arial, Helvetica, sans-serif;
    font-size: 1rem;
    letter-spacing: 1px;
    color: #322F42;
    width: 100%;
    min-height: 100vh;
    overflow: hidden;
    background-color: #67676794;
    background-image: url('./img/cubes.png');
    }

    .login {
        background-color: #337957 !important;
        background-image: url('./img/black-linen.png');
    }



</style>
