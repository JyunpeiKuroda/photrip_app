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
         class=""
         :currentPage="currentPage"
         :lastPage="lastPage"
         ></paginate>
    </div>
</template>

<script>
import axios from 'axios';
import LbHeader from '../components/Header.vue';
import Paginate from '../components/organisms/Paginate.vue'
import BookmarkList from '../components/organisms/BookmarkList.vue';

export default {
    components: {
        LbHeader,
        BookmarkList,
        Paginate
    },
    mounted() {
        this.init()
    },
    data() {
        return {
            guides: [],
            currentPage: 0,
            lastPage: 0
        }
    },
    methods: {
        // 画面描写
        init() {
            axios.get('/api/v1/guides')
            .then(res => {
                this.guides = res.data.data
                this.currentPage = res.data.current_page
                this.last_page = res.data.last_page
                console.log(this.guides, 'guides')
            })
            
        }
    }
}
</script>
<style scoped>
/* #homeBackground {
    background-color: #FFCC66;
} */
</style>
