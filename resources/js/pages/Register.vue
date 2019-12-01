<template>
    <div class="">
        <div class="h-full mx-auto flex justify-center items-center" id="login_background">
            <div class="w-96 bg-white rounded-lg shadow-xl p-6">
                <h1 class="text-black text-3xl" id="loginTitle"><img class="m-auto w-30 h-20" src="../asset/login_logo.png"></h1>

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
    computed: {
        LoadingBar
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
            if (this.validator()) {
                this.$store.commit('loading/setLoading', true)
                await this.$store.dispatch('auth/register', this.registerForm)
                this.$store.commit('loading/setLoading', false)

                this.$router.push('/photrip/home')
            }
            console.log('error出力');
        },
        validator() {
            // 空白チェック
            if (
                this.registerForm.name.trim() === '' || 
                this.registerForm.email.trim() === '' || 
                this.registerForm.password.trim() === ''
                ) 
            {
                return false
            }   

            if (this.registerForm.name.length > 10 ) {
                return false
            }
            return true
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
