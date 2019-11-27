<template>
    <div class="bg-gray-200" id="homeBackground">
        <lb-header></lb-header>
        <div class="pt-10" id="mainContent">
            <div class="w-8/12 bg-white h-64 m-auto rounded-lg h-screen mb-30">
                <bookmark-list
                    v-for="(datum, index) in data"
                    :key="index"
                    :bookmarkTitle="datum.bookmarkTitle"
                    :username="datum.username"
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
            data: [
                { bookmarkTitle: 'aaa', username: 'kkk'},
                { bookmarkTitle: 'aaa', username: 'kkk'},
                { bookmarkTitle: 'aaa', username: 'kkk'}
            ]
        }
    },
    methods: {
        // 画面描写
        init() {
            axios.get('/api/v1/guides')
            .then(res => {
                console.log(res, 'response')
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
