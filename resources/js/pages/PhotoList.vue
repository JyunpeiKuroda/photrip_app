<template>
    <div class="bg-gray-200 h-full overflow-scroll">
        <lb-header></lb-header>
        <div class="pt-10" id="mainContent">
            <!-- 画像の表示 -->
            <div class="flex flex-wrap px-4">
                <div class="w-1/6 p-2" v-for="(imginfo, index) in imgData" :key="index">
                    <p class="h-8 text-gray-600">{{ imginfo.place }}</p>
                    <a @click="imgListener(imginfo)">
                        <div class="text-gray-700 text-center bg-gray-400 p-2 h-64">
                        {{ imginfo.img }}
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import LbHeader from '../components/Header.vue';
export default {
    components: {
        LbHeader
    },
    data() {
        return {
            imgData: [
                { place: '京都駅', img: 'aaa',photoId: '1111' },
                { place: '', img: 'aaa', photoId: '123' },
                { place: '', img: 'aaa', photoId: '234' },
                { place: '大阪駅', img: 'aaa', photoId: '345' },
                { place: '', img: 'aaa', photoId: '345' },
                { place: '', img: 'aaa', photoId: '345' },
                { place: '', img: 'aaa', photoId: '345' },
                { place: '', img: 'aaa', photoId: '345' }
            ]
        }
    },
    methods: {
        imgListener(data) {
            console.log(data.photoId, 'imgData')
            this.$router.push({
                path: `/photrip/photo/${data.photoId}`
            })
        }
    }
}
</script>