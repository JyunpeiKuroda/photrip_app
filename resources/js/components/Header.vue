<template>
  <header class="bg-white sm:flex sm:justify-between sm:items-center sm:px-4 sm:py-3 shadow-lg">
    <div id="headerlogo" class="my-auto inline align-middle">
      <router-link to="/photrip/home" class=""><img class="float-left w-30 h-10 my-3 mx-2" src="../asset/headerLogo.png"></router-link>
    </div>
    <div class="flex items-center justify-between px-4 py-4 sm:p-0">
      <div>
        <img class="" src="" alt="">
      </div>
      <div class="sm:hidden">
        <button @click="isOpen = !isOpen" type="button" class="block text-gray-500 hover:text-white focus:text-white focus:outline-none">
          <svg class="h-6 w-6 fill-current" viewBox="0 0 24 24">
            <path v-if="isOpen" style="fill: black;" fill-rule="evenodd" d="M18.278 16.864a1 1 0 0 1-1.414 1.414l-4.829-4.828-4.828 4.828a1 1 0 0 1-1.414-1.414l4.828-4.829-4.828-4.828a1 1 0 0 1 1.414-1.414l4.829 4.828 4.828-4.828a1 1 0 1 1 1.414 1.414l-4.828 4.829 4.828 4.828z"/>
            <path v-if="!isOpen" style="fill: black;" fill-rule="evenodd" d="M4 5h16a1 1 0 0 1 0 2H4a1 1 0 1 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2zm0 6h16a1 1 0 0 1 0 2H4a1 1 0 0 1 0-2z"/>
          </svg>
        </button>
      </div>
    </div>
    <nav :class="isOpen ? 'block' : 'hidden'" class="px-4 pt-4 sm:flex sm:p-0">
        <router-link to="/photrip/home" class="mt-1 block px-2 py-1 text-black font-semibold rounded">
            <i class="fas fa-home"></i><span class="ml-2">ホーム</span>
        </router-link>
        <router-link to="/photrip/compose/plan" class="mt-1 block px-2 py-1 text-black font-semibold rounded sm:mt-0 sm:ml-2">
            <i class="far fa-plus-square"></i><span class="ml-2">しおりを作成する</span>
        </router-link>
        <div>
          <a @click="DropIsOpen = !DropIsOpen" class="mt-1 block px-2 py-1 text-black font-semibold rounded sm:mt-0 sm:ml-2">
              <i class="fas fa-user"></i><span class="ml-2">{{ username }}さん▼</span>
          </a>
          <span class="relative block h-auto ml-3 bg-white">
              <ul v-if="DropIsOpen" class="absolute top-100 left-1 block mt-3 py-4 bg-white px-2 w-100 border border-gray-500">
                  <li>
                      <a @click="logout()" class="block text-black font-semibold">
                        <i class="fas fa-sign-out-alt"></i> ログアウト
                      </a>
                  </li>
              </ul>
              <ul v-if="!DropIsOpen"></ul>
          </span>
        </div>

    </nav>
  </header>
</template>

<script>
import  { UNPROCESSABLE_ENTITY }  from '../util';
import  { INTERNAL_SERVER_ERROR }  from '../util';

export default {
    data() {
        return {
        isOpen: false,
        DropIsOpen: false
        }
    },
    computed: {
      username() {
        return this.$store.getters['auth/username']
      },
      errorCode() {
        return this.$store.getters['error/code']
      },
      apiStatus() {
          return this.$store.state.auth.apiStatus
      },
      isLoading() {
          return this.$store.state.auth.isLoading
      }
    },
    watch: {
      errorCode: {
        handler(code) {
          if (code === INTERNAL_SERVER_ERROR) {
            this.$router.push({
              path: '/',
              query: { error: 'サーバーのエラーです' }
            })
          }
        },
        immediate: true
      },
      $route () {
        this.$store.commit('error/setCode', null)
      }
    },
    mounted() {
        this.loginCheck()
    },
    methods: {
      async logout() {
        await this.$store.dispatch('auth/logout')

        if (this.apiStatus) {
          this.$router.push('/login')
        }
      },
      async loginCheck() {
        await this.$store.dispatch('auth/userinfo')
      }
    }
}
</script>

<style scoped>
.DropIsOpen {
  display: none
}
</style>