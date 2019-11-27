<template>
    <div class="bg-blue-300 h-full w-full pt-8">
        <div class="border-4 border-red-500 rounded-lg py-4 px-4 w-2/4 mx-auto mt-64 mb-12 bg-white">
            <p class="font-extrabold text-5xl text-center">{{ getErrorMsg }}</p>
        </div>
        <div class="m-auto bg-gray-100 text-center py-4 border-4 border-gray-300 rounded-lg w-1/4 hover:bg-gray-400 hover:text-white">
            <button v-if="isLogin" @click="$router.push('/photrip/home')" class="text-lg font-semibold">メイン画面へ</button>
            <button v-else @click="$router.push('/login')">ログイン画面へ</button>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        this.loginCheck()
    },
    data() {
        return {
            isLogin: false
        }
    },
    computed: {
        getErrorMsg() {
            if (this.$route.query.error === undefined) {
                return '不正なURLです'
            }
           return this.$route.query.error
        }
    },
    methods: {
        async loginCheck() {
            await this.$store.dispatch('auth/userinfo')

            if (this.$store.getters['auth/username']) {
                this.isLogin = true
            }
        }
    }
}
</script>