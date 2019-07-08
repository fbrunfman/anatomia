<template>
  <div class="container" :class="{'show': showSidebar}">
    <div class="control">
      <i class="fas fa-angle-double-right" @click="showNav"></i>
    </div>
    <div class="navigation-icons">
        <i class="fas fa-user"></i>
        <i class="fas fa-home"></i>
        <i class="fas fa-window-restore"></i>
        <i class="fas fa-plus"></i>
        <i class="fas fa-edit"></i>
        <i class="fas fa-headset"></i>
        <i class="fas fa-power-off"></i>
    </div>
    <div class="navigation-links">
      <transition-group name="fade">
        <div v-show="showLink" key="1">Usuario</div>
        <div v-show="showLink" key="2">Inicio</div>
        <div v-show="showLink" key="3">Dashboard</div>
        <div v-show="showLink" key="4">Crear cursos</div>
        <div v-show="showLink" key="5">Editar cursos</div>
        <div v-show="showLink" key="6">Soporte</div>
        <div v-show="showLink" key="7">Logout</div>
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
    border: solid #fff;
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
</style>
