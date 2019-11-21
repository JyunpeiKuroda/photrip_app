<template>
    <div class="bg-gray-200 h-full overflow-scroll">
        <lb-header></lb-header>
        <div class="pt-10" id="mainContent">
            <!-- 画像の表示 -->
            <div class="flex flex-wrap px-4">
                <div class="w-1/6 p-2" v-for="(imginfo, index) in imgData" :key="index">
                    <p class="h-8 text-gray-600">{{ imginfo.place }}</p>
                    <a @click="imgListener(imginfo)">
                        <div class="text-center bg-white h-64 shadow-lg">
                            <img :src="imginfo.imgUrl" class="object-cover h-64 w-full py-1 px-1">
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
                { place: '京都駅', imgUrl: 'https://seolaboratory.jp/wordpress/wp-content/uploads/2017/04/pho01-7.png',photoId: '1111' },
                { place: '', imgUrl: 'https://seolaboratory.jp/wordpress/wp-content/uploads/2017/04/pho05-2.png', photoId: '123' }
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