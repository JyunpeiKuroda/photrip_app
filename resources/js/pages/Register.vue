<template>
    <div class="">
        <div class="h-full mx-auto flex justify-center items-center" id="login_background">
            <div class="w-96 bg-white rounded-lg shadow-xl p-6">
                <h1 class="text-black text-3xl" id="loginTitle"><img class="m-auto w-30 h-20" src="../asset/login_logo.png"></h1>

                <div id="errorVisble" class="border-2 border-red-500 py-4 px-4" v-if="registerErrorMsg">
                    <ul class="text-red-600">
                        <li v-for="msg in registerErrorMsg.name" :key="msg">{{ msg }}</li>
                    </ul>

                    <ul class="text-red-600">
                        <li v-for="msg in registerErrorMsg.email" :key="msg" >{{ msg }}</li>
                    </ul>

                    <ul class="text-red-600">
                        <li v-for="msg in registerErrorMsg.password" :key="msg" >{{ msg }}</li>
                    </ul>
                </div>

                <div class="">
                    <div class="">
                        <input id="name" v-model="registerForm.name" type="text" placeholder="名前" class="pt-8 w-full rounded-lg p-3 border-b focus:outline-none focus:border-blue-400" name="name" required autocomplete="name" autofocus>
                    </div>
                </div>

                <div class="">
                    <div class="">
                        <input id="email" v-model="registerForm.email" type="email" placeholder="メールアドレス" class="pt-8 w-full rounded-lg p-3 border-b focus:outline-none focus:border-blue-400" name="email" required autocomplete="email" autofocus>
                    </div>
                </div>

                <div class="">
                    <div class="">
                        <input id="password" v-model="registerForm.password" type="password" placeholder="パスワード" class="pt-8 w-full rounded-lg p-3 border-b focus:outline-none focus:border-blue-400" name="password" required autocomplete="current-password">
                    </div>
                </div>

                <div id="register" class="mt-10">
                    <button @click="register()" class="bg-blue-500 rounded-lg w-64 h-12  text-white font-hairline">登録</button>
                </div>
                <div id="loginLink" class="mt-4">
                    <router-link to="/login"><p class="text-gray-600 text-sm mx-auto">ログイン画面へ</p></router-link>
                </div>
            </div>
        </div>
        <loading-bar
        :isLoading="isLoading"
        ></loading-bar>
    </div>
</template>

<script>
import LoadingBar from '../components/LoadingBar.vue';

export default {
    components: {
        LoadingBar
    },
    created() {
        this.clearMsg()
    },
    computed: {
        isLoading() {
            return this.$store.state.loading.isLoading
        },
        registerErrorMsg() {
            return this.$store.state.auth.registerErrorMsg
        },
        apiStatus() {
            return this.$store.state.auth.apiStatus
        },
    },
    data() {
        return {
            registerForm: {
                name: '',
                email: '',
                password: ''
            }
        }
    },
    methods: {
        async register() {
            await this.$store.dispatch('auth/register', this.registerForm)

            if (this.apiStatus) {
                this.$router.push('/photrip/home')
            }       
        },
        clearMsg() {
            this.$store.commit('auth/setRegisterErrorMsg', null)
        }
    }
}
</script>

<style scoped>
::placeholder {
    font-size: 13px;
}

#name {
    width: 400px;
}

#loginTitle {
    text-align: center;    
}

#login_background {
    background-color: #FFCC66;
}

#register {
    text-align: center;
}

#loginLink p {
    text-align: center;
}
</style>
