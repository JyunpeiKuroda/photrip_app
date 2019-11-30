const state = {
    isLoading: false
}

const mutations = {
    setLoading (state, isLoading) {
        state.isLoading = isLoading
    }
}

export default {
    namespaced: true,
    state,
    mutations
}