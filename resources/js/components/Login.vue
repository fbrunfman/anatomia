<template>
    <div class="login-body">
        <div class="login-container">
            <form action="">
                <div class="login-input">
                    <div class="usuario d-flex align-items-center">
                        <div class="icono-user">
                            <i class="far fa-user"></i>
                        </div>
                        <b-form-input placeholder="Usuario" v-model="username"></b-form-input>
                    </div>
                    <div class="password my-3 d-flex align-items-center">
                        <div class="icono-password">
                            <i class="fas fa-key"></i>
                        </div>
                        <b-form-input type="password" placeholder="Contraseña" v-model="password" id="password" trim></b-form-input>
                        <div class="icono-ingresar">
                            <i class="fas fa-chevron-right" @click="login"></i>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    name: 'Login',
    data() {
        return {
            username: '',
            password: '',
        }
    },
    mounted () {
        this.$store.commit('login', true)
        this.$store.commit('paginaPrincipal', false)

    },
    methods: {
        login() {
            this.$store.dispatch('retrieveToken', {
                username: this.username,
                password: this.password
            })
            .then(response => {
                this.$router.push('/')
                this.$store.commit('login', false)
                this.$store.commit('paginaPrincipal', true)
                this.$store.commit('infoUsuario', response.data.usuario)
                localStorage.setItem('infoUsuario', JSON.stringify(response.data.usuario))

            })
        }
    }
}
</script>

<style lang="scss" scoped>
    .login-container {
        position: absolute;
        top: 50%;
        width: 30rem;
        left: 50%;
        -webkit-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
        padding: 4rem;
        padding-bottom: 8rem;
        border-radius: 7px;
        color: #525252;
        -webkit-clip-path: polygon(0% 0%, 100% 0%, 100% 75%, 75% 75%, 75% 100%, 50% 75%, 0% 75%);
        clip-path: polygon(0% 0%, 100% 0%, 100% 75%, 75% 75%, 75% 100%, 50% 75%, 0% 75%);
        background-color: #a9ceac;
        background-image: linear-gradient(90deg, transparent 79px, #abced4 79px, #abced4 81px, transparent 81px), linear-gradient(#eee 0.1em, transparent 0.1em);
        background-size: 100% 1.2em;

    }

    .boton-login {
        span {
            font-size: 1.3rem;
            background: #2e7a98;
            padding: 10px;
            color: white;
            border-radius: 6px;
            cursor: pointer;
            box-shadow: 0 5px 10px #00000078;
        }
    }

    .icono-user,
    .icono-password {
        background-color: #bbbbbb;
        color: #777777;
        height: 2.25rem;
        display: flex;
        align-items: center;
        width: 3rem;
        justify-content: center;
        border-radius: 3px 0px 0 3px;
        font-size: 1.2rem;
        box-shadow: 0 5px 10px #a7a0a0;
    }

    i.far.fa-user,
    .fa-key {
        position: relative;
        left: 1.1px;
    }

    .icono-ingresar {
        background: #58b158;
        color: #ffffff;
        height: 2.35rem;
        display: -webkit-box;
        display: flex;
        -webkit-box-align: center;
        align-items: center;
        width: 3rem;
        -webkit-box-pack: center;
        justify-content: center;
        border-radius: 0px 3px 3px 0px;
        font-size: 1.2rem;
        /* box-shadow: 0 5px 10px #a7a0a0; */
        position: absolute;
        right: 64px;
        cursor: pointer;
        i {
            position: relative;
            left: 2px;
        }
    }

    .form-control {
        border-radius: 0;
    }
</style>
