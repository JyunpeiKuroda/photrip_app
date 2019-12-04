<template>
    <div class="bg-gray-200" id="homeBackground">
        <lb-header></lb-header>
        <div class="pt-10" id="mainContent">
            <div class="w-8/12 bg-white h-64 m-auto rounded-lg h-screen mb-30">
                <bookmark-list
                    v-for="(datum, index) in guides"
                    :guideId="datum.id"
                    :key="index"
                    :title="datum.title"
                    :days="datum.days"
                    :username="datum.user.name"
                ></bookmark-list>
            </div>
        </div>
        <paginate
         :currentPage="currentPage"
         :lastPage="lastPage"
         @nextPage="nextPage()"
         @backPage="backPage()"
         ></paginate>
         <loading-bar
         :isLoading="isLoading"
         ></loading-bar>
    </div>
</template>

<script>
import axios from 'axios';
import LbHeader from '../components/Header.vue';
import Paginate from '../components/organisms/Paginate.vue'
import BookmarkList from '../components/organisms/BookmarkList.vue';
import LoadingBar from '../components/LoadingBar.vue';

export default {
    components: {
        LbHeader,
        BookmarkList,
        Paginate,
        LoadingBar
    },
    mounted() {
        this.init()
    },
    data() {
        return {
            guides: [],
            currentPage: 1,
            lastPage: 0
        }
    },
    computed: {
        isLoading() {
            return this.$store.state.loading.isLoading
        }
    },
    methods: {
        // 画面描写
        init(params) {
            this.$store.commit('loading/setLoading', true)
            axios.get(`/api/v1/guides/?page=${this.currentPage}`)
            .then(res => {
                this.guides = res.data.data
                this.currentPage = res.data.current_page
                this.lastPage = res.data.last_page
                this.$store.commit('loading/setLoading', false)
            })
            
        },
        nextPage() {
            this.currentPage += 1
            this.init()
        },
        backPage() {
            this.currentPage -= 1
            this.init()
        }
    }
}
</script>
<style scoped>
</style>
