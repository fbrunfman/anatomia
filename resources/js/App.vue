<template>
    <div id="app">
        <div class="pagina-principal d-flex">
            <div class="main-page"><MainPage></MainPage></div>
        </div>
    </div>
</template>

<script>
import MainPage from './components/Main-Page.vue'
import Sidebar from './components/Sidebar.vue'
export default {
    name: 'App',
    components: {
    'MainPage': MainPage,
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
    background-size: cover;
    overflow: hidden;
  }



</style>
