<template>
    <div class="">
        <div class="h-full mx-auto flex justify-center items-center" id="login_background">
            <div class="w-96 bg-white rounded-lg shadow-xl p-6">
                <h1 class="text-black text-3xl" id="loginTitle"><img class="m-auto w-30 h-20" src="../asset/login_logo.png"></h1>

                <div id="errorVisble" class="border-2 border-red-500 py-4 px-4" v-if="loginErrorMsg">
                    <p class="text-red-600">{{ loginErrorMsg }}</p>
                </div>

                <div class="mt-10 text-xl align-middle" id="loginContent">
                    <p>旅が終わればすぐに捨てるしおり。<br>
                    <strong>フォトリップ</strong>ではしおりに写真を紐付けることで<br>
                    思い出の記録として後から楽しむこともできます。</p>
                </div>

                <div class="">
                    <div class="">
                        <input id="email" v-model="loginForm.email" type="email" placeholder="メールアドレス" class="pt-8 w-full rounded-lg p-3 border-b focus:outline-none focus:border-blue-400" name="email" required autocomplete="email" autofocus>
                    </div>
                </div>

                <div class="">
                    <div class="">
                        <input id="password" v-model="loginForm.password" type="password" placeholder="パスワード" class="pt-8 w-full rounded-lg p-3 border-b focus:outline-none focus:border-blue-400" name="password" required autocomplete="current-password">
                    </div>
                </div>

                <div id="loginBtn">
                    <button @click="login()" class="bg-blue-500 rounded-lg w-64 h-12  text-white font-hairline">ログイン</button>
                </div>
                <!-- <p class="text-gray-400 font-hairline" id="loginSelectOr">or</p>
                <div class="social-auth-links bg-blue-400 rounded-lg w-64 h-12 shadow-lg" id="social-auth-wrap">
                    <div class="" id="social-auth-title">
                        <i class="fab fa-twitter text-white"></i>
                        <a href="/photrip/home" class="text-white" id="social-auth-title-link">Twitterでログイン</a>
                    </div>
                </div> -->
                <div id="registerLink" class="mt-4">
                    <router-link to="/register"><p class="text-gray-600 text-sm">まだ登録していない方はこちら</p></router-link>
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
    data() {
        return {
            loginForm: {
                email: '',
                password: ''
            }
        }
    },
    created() {
        this.clearMsg()
    },
    computed: {
        apiStatus() {
            return this.$store.state.auth.apiStatus
        },
        loginErrorMsg() {
            return this.$store.state.auth.loginErrorMsg
        },
        isLoading() {
            return this.$store.state.loading.isLoading
        }
    },
    methods: {
        async login() {
            await this.$store.dispatch('auth/login', this.loginForm)

            if (this.apiStatus) {
                this.$router.push('/photrip/home')
            }
        },
        clearMsg() {
            this.$store.commit('auth/setLoginErrorMsg', null)
        }
    }
}
</script>

<style scoped>
::placeholder {
    font-size: 13px;
}

#loginContent {
    text-align: center;
    color: #339900;
    font-family: 'Avenir','Helvetica Neue','Helvetica','Arial','Hiragino Sans','ヒラギノ角ゴシック',YuGothic,'Yu Gothic','メイリオ', Meiryo,'ＭＳ Ｐゴシック','MS PGothic' ;
}

#loginTitle {
    text-align: center;    
}

#loginSelectOr {
    text-align: center;
}

#loginBtn {
    text-align: center;
    margin-top:50px;
    margin-bottom: 20px;
}

#social-auth-wrap {
    margin: auto;
    margin-top: 20px;
}

#social-auth-title {
    margin: 0 auto;
    display:block;
    width: 60%;
    line-height: 45px;
}

#social-auth-title-link {
    text-decoration: none;
}

#login_background {
    background-color: #FFCC66;
}

#registerLink {
    text-align: center;
}
</style>
