<template>
  <div class="container" :class="{'show': showSidebar}">
    <div class="control">
      <i class="fas fa-angle-double-right" @click="showNav"></i>
    </div>
    <div class="navigation-icons">
        <i class="fas fa-user"></i>
        <router-link to="/">
            <i class="fas fa-home"></i>
        </router-link>
        <router-link to="create-course">
            <i class="fas fa-plus"></i>
        </router-link>
        <i class="fas fa-edit"></i>
        <i class="fas fa-headset"></i>
        <i class="fas fa-power-off" @click="logout"></i>
    </div>
    <div class="navigation-links">
      <transition-group name="fade">
        <div v-show="showLink" key="1">Perfil</div>
        <router-link to="/" key="2">
            <div v-show="showLink">Inicio</div>
        </router-link>
        <router-link to="create-course" key="4">
            <div v-show="showLink">Crear cursos</div>
        </router-link>
        <div v-show="showLink" key="5">Editar cursos</div>
        <div v-show="showLink" key="6">Soporte</div>
        <div v-show="showLink" key="7" @click="logout">Logout</div>
      </transition-group>

    </div>
  </div>
</template>

<script>
  export default {
    data: () => {
      return {
        showSidebar: false,
        showLink: false
      }
    },
    methods: {
      showNav() {
        if(this.showSidebar) {
          this.showLink = false;
          setTimeout(() => {
            this.showSidebar = false;
          }, 300);
        }
        else {
          this.showSidebar = true;
          setTimeout(() => {
            this.showLink = true;
          }, 300);
        }
      },
      logout() {
        this.$store.dispatch('destroyToken')
            .then(response => {
            this.$router.push('/login')
            this.$store.commit('login', true)
            this.$store.commit('paginaPrincipal', false)
        })
        .catch((error) => {

        })
      }
    }
  }
</script>

<style lang="scss" scoped>
  .container {
    position: fixed;
    top: 0;
    left: 0;
    width: 70px;
    padding: 10px;
    min-height: calc(100vh - 10px);
    background-color: #97b388;
    color: #3d4c4a;
    border-width: 0 1px 0 0;
    z-index: 999;
    transition: all .5s ease-in-out;
    box-shadow: 0 5px 16px #000000b8;
    .control {
      display: flex;
      justify-content: center;
      align-items: center;
      width: 50px;
      margin-bottom: 10px;
      i {
        font-size: 2rem;
        cursor: pointer;
        transition: all .5s ease-in-out;
      }
    }
    &.show {
      width: 250px;
      .control > i {
        color: #fff;
        transform: rotateZ(-180deg);
      }
      .navigation-icons {
        color: #fff;
      }
    }
    .navigation-icons {
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
      width: 50px;
      float: left;
      i {
        font-size: 2rem;
        padding: 10px 0;
        cursor: pointer;
        transition: all .5s ease-in-out;
        &:hover {
          color: #fff;
        }
      }
    }
    .navigation-links {
      padding-top: 14px;
      float: left;
      div {
        font-size: 1.35rem;
        padding-left: 10px;
        margin-bottom: 19px;
        cursor: pointer;
        &:hover {
          color: #fff;
          transition: .5s;
        }
      }
    }
  }
  @mixin nav-childs($values...) {
    @each $var in $values {
      &:nth-child(#{$var}) {
        transition: transform linear calc(.1s * #{$var}), display .5s;
      }
    }
  }
  .fade-enter-active, .fade-leave-active {
    @include nav-childs(1,2,3,4,5,6,7);
  }
  .fade-enter, .fade-leave-to {
    transform: scale(0);
  }

  a {
      color: inherit;
      text-decoration: none;
      :hover {
          text-decoration: none;
      }
  }
</style>
