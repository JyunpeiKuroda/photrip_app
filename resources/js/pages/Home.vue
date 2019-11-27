<template>
    <div class="bg-gray-200" id="homeBackground">
        <lb-header></lb-header>
        <div class="pt-10" id="mainContent">
            <div class="w-8/12 bg-white h-64 m-auto rounded-lg h-screen mb-30">
                <bookmark-list
                    v-for="(datum, index) in guides"
                    :key="index"
                    :title="datum.title"
                    :days="datum.days"
                    :username="datum.user.name"
                ></bookmark-list>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import LbHeader from '../components/Header.vue';
import BookmarkList from '../components/organisms/BookmarkList.vue';

export default {
    components: {
        LbHeader,
        BookmarkList
    },
    mounted() {
        this.init()
    },
    data() {
        return {
            guides: []
        }
    },
    methods: {
        // 画面描写
        init() {
            axios.get('/api/v1/guides')
            .then(res => {
                this.guides = res.data.data
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
