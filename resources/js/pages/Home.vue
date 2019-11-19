<template>
    <div class="bg-gray-200">
        <lb-header></lb-header>
        <div class="mt-5" id="mainContent">
            <div class="w-8/12 bg-white h-64 m-auto rounded-lg h-screen mb-30">
                <bookmark-list
                    v-for="(datum, index) in data"
                    :key="index"
                    bookmarkTitle="bookmarkTitle"
                    username="username"
                ></bookmark-list>
            </div>
        </div>
    </div>
</template>

<script>
import LbHeader from '../components/Header.vue';
import BookmarkList from '../components/BookmarkList.vue';

export default {
    components: {
        LbHeader,
        BookmarkList
    },
    data() {
        return {
            data: [
                { bookmarkTitle: 'aaa', username: 'kkk'},
                { bookmarkTitle: 'aaa', username: 'kkk'},
                { bookmarkTitle: 'aaa', username: 'kkk'}
            ]
        }
    }
}
</script>