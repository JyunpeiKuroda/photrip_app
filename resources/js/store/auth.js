import  { OK, UNPROCESSABLE_ENTITY, UNAUTHORIZED, CREATED }  from '../util'
import router from '../router'

const UNPROCESSABLE_ENTITY_MSG = 'メールアドレスまたはパスワードが違います'

/** データの入れ物 */
const state = {
    user: null,
    apiStatus: null,
    loginErrorMsg: null,
    registerErrorMsg: null
}

/** ステートの内容から算出される値 */
const getters = {
    check: state => !! state.user,
    username: state => state.user ? state.user.name : ''
}

/** ステートを更新する（同期処理） */
const mutations = {
    setUser (state, user) {
        state.user = user
    },
    setApiStatus (state, apiStatus) {
        state.apiStatus = apiStatus
    },
    setLoginErrorMsg (state, loginErrorMsg) {
        state.loginErrorMsg = loginErrorMsg
    },
    setRegisterErrorMsg (state, registerErrorMsg) {
        state.registerErrorMsg = registerErrorMsg
    }
}
/** ステートを更新する（非同期処理） */
const actions = {
    async register (context, data) {
        context.commit('setApiStatus', null)

        context.commit('loading/setLoading', true, { root: true })
        const response = await axios.post('/api/v1/register', data).catch(error => error.response || error)
        context.commit('loading/setLoading', false, { root: true })

        if (response.status === CREATED) {
            context.commit('setApiStatus', true)
            context.commit('setUser', response.data)  
            return false
        }

        /** 失敗 */
        context.commit('setApiStatus', false)

        if (response.status === UNPROCESSABLE_ENTITY) {
            context.commit('setRegisterErrorMsg', response.data.errors)
        }
    },

    async login(context, data) {
        context.commit('setApiStatus', null)

        context.commit('loading/setLoading', true, { root: true })
        const response = await axios.post('/api/v1/login', data).catch(error => error.response || error)
        context.commit('loading/setLoading', false, { root: true })

        /**　正常 */
        if (response.status === OK) {
            context.commit('setApiStatus', true)   
            context.commit('setUser', response.data)    
            return false
        }
        context.commit('setApiStatus', false)

        /** エラー処理 */
        if (response.status === UNPROCESSABLE_ENTITY) {
            context.commit('setLoginErrorMsg', UNPROCESSABLE_ENTITY_MSG)
        } else {
            context.commit('error/setCode', response.status, { root: true })
        }
    },

    async logout(context) {
        context.commit('loading/setLoading', true, { root: true })
        const response = await axios.post('/api/v1/logout').catch(error => error.response || error)
        context.commit('loading/setLoading', false, { root: true })

        if (response.status === OK) {
            context.commit('setApiStatus', true)
            context.commit('setUser', null)
            return false
          }
      
          context.commit('setApiStatus', false)
          context.commit('error/setCode', response.status, { root: true })
    },

    async userinfo (context) {
        context.commit('loading/setLoading', true, { root: true })
        const response = await axios.get('/api/v1/userinfo').catch(error => error.response || error)
        context.commit('loading/setLoading', false, { root: true })

        const user = response.data || null
        context.commit('setUser', user)

        // セッションが切れてたらログイン画面に遷移
        if (response.data === "") {
            router.push('/login')
        }
    }
}

export default {
    // 名前空間の有効化 
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}